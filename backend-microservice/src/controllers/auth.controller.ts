// src/controllers/auth.controller.ts
import { Request, Response } from 'express';
import jwt from 'jsonwebtoken';
import bcrypt from 'bcryptjs';
import { User } from '../models/user.model';

const JWT_SECRET = process.env.JWT_SECRET || 'default_secret';

export const register = async (req: Request, res: Response) => {
    try {
        const { username, email, password, role } = req.body;

        // Check both username and email
        const existing = await User.findOne({
            $or: [{ username }, { email: email || '' }]
        });

        if (existing) return res.status(400).json({ error: 'User already exists' });

        // Hash password
        const hashedPassword = await bcrypt.hash(password, 10);

        const user = new User({
            username,
            email,
            password: hashedPassword,
            role: role || 'customer'
        });

        await user.save();
        res.status(201).json({ message: 'User created successfully' });
    } catch (err) {
        console.error('Registration error:', err);
        res.status(500).json({ error: 'Registration failed' });
    }
};

export const login = async (req: Request, res: Response) => {
    try {
        const { username, email, password } = req.body;

        // Find user by username or email
        const user = await User.findOne({
            $or: [
                { username: username || '' },
                { email: email || username || '' } // If email is passed as username
            ]
        });

        if (!user) {
            return res.status(401).json({
                error: 'Invalid credentials',
                message: `User not found for: ${username || email}`
            });
        }

        // Check password
        const isMatch = await bcrypt.compare(password, user.password);
        let isLaravelMatch = false;

        if (!isMatch) {
            // Also check for plain text if it was migrated from a dev environment
            // but Laravel hashes should be checked with bcrypt.
            // If the hash starts with $2y$ (Laravel standard), bcryptjs handles it by replacing $2y$ with $2a$ internally or it might just work.
            // Actually $2y$ is bcrypt.
            const laravelHash = user.password.replace(/^\$2y\$/, '$2a$');
            isLaravelMatch = await bcrypt.compare(password, laravelHash);
        }

        if (!isMatch && !isLaravelMatch) {
            return res.status(401).json({
                error: 'Invalid credentials',
                message: 'Password mismatch'
            });
        }

        const token = jwt.sign(
            { userId: user._id, role: user.role, category: user.category },
            JWT_SECRET,
            { expiresIn: '1d' }
        );

        res.json({
            token,
            user: {
                id: user._id,
                username: user.username,
                email: user.email,
                role: user.role,
                name: user.name,
                category: user.category,
                profilePhoto: user.profilePhoto
            }
        });
    } catch (err: any) {
        console.error('Login error:', err);
        res.status(500).json({
            error: 'Login failed',
            message: err.message || 'Internal server error'
        });
    }
};

export const getUsersByRoles = async (req: any, res: Response) => {
    try {
        const { roles } = req.query;
        if (!roles) return res.status(400).json({ error: 'Roles parameter is required' });

        const roleList = (roles as string).split(',');
        const query: any = { role: { $in: roleList } };

        // Isolation: If the requester is an admin/manager/supervisor, only show users from their category
        if (req.user && req.user.role !== 'super_admin' && req.user.category) {
            query.category = req.user.category;
        }

        const users = await User.find(query).select('-password');
        res.json(users);
    } catch (err) {
        console.error('Fetch users error:', err);
        res.status(500).json({ error: 'Failed to fetch users' });
    }
};

export const getUserById = async (req: Request, res: Response) => {
    try {
        const user = await User.findById(req.params.id).select('-password');
        if (!user) return res.status(404).json({ error: 'User not found' });
        res.json(user);
    } catch (err) {
        console.error('Fetch user by ID error:', err);
        res.status(500).json({ error: 'Failed to fetch user' });
    }
};

export const getUsersByCategory = async (req: Request, res: Response) => {
    try {
        const { category } = req.query;
        if (!category) return res.status(400).json({ error: 'Category parameter is required' });

        // Normalize category name (some might come with underscores from Laravel)
        const normalizedCategory = (category as string).replace(/_/g, '-');

        const users = await User.find({ category: normalizedCategory }).select('-password');
        res.json(users);
    } catch (err) {
        console.error('Fetch users by category error:', err);
        res.status(500).json({ error: 'Failed to fetch users' });
    }
};
