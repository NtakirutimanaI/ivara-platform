"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getUsersByCategory = exports.getUserById = exports.getUsersByRoles = exports.login = exports.register = void 0;
const jsonwebtoken_1 = __importDefault(require("jsonwebtoken"));
const bcryptjs_1 = __importDefault(require("bcryptjs"));
const user_model_1 = require("../models/user.model");
const JWT_SECRET = process.env.JWT_SECRET || 'default_secret';
const register = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { username, email, password, role } = req.body;
        // Check both username and email
        const existing = yield user_model_1.User.findOne({
            $or: [{ username }, { email: email || '' }]
        });
        if (existing)
            return res.status(400).json({ error: 'User already exists' });
        // Hash password
        const hashedPassword = yield bcryptjs_1.default.hash(password, 10);
        const user = new user_model_1.User({
            username,
            email,
            password: hashedPassword,
            role: role || 'customer'
        });
        yield user.save();
        res.status(201).json({ message: 'User created successfully' });
    }
    catch (err) {
        console.error('Registration error:', err);
        res.status(500).json({ error: 'Registration failed' });
    }
});
exports.register = register;
const login = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { username, email, password } = req.body;
        // Find user by username or email
        const user = yield user_model_1.User.findOne({
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
        const isMatch = yield bcryptjs_1.default.compare(password, user.password);
        let isLaravelMatch = false;
        if (!isMatch) {
            // Also check for plain text if it was migrated from a dev environment
            // but Laravel hashes should be checked with bcrypt.
            // If the hash starts with $2y$ (Laravel standard), bcryptjs handles it by replacing $2y$ with $2a$ internally or it might just work.
            // Actually $2y$ is bcrypt.
            const laravelHash = user.password.replace(/^\$2y\$/, '$2a$');
            isLaravelMatch = yield bcryptjs_1.default.compare(password, laravelHash);
        }
        if (!isMatch && !isLaravelMatch) {
            return res.status(401).json({
                error: 'Invalid credentials',
                message: 'Password mismatch'
            });
        }
        const token = jsonwebtoken_1.default.sign({ userId: user._id, role: user.role, category: user.category }, JWT_SECRET, { expiresIn: '1d' });
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
    }
    catch (err) {
        console.error('Login error:', err);
        res.status(500).json({
            error: 'Login failed',
            message: err.message || 'Internal server error'
        });
    }
});
exports.login = login;
const getUsersByRoles = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { roles } = req.query;
        if (!roles)
            return res.status(400).json({ error: 'Roles parameter is required' });
        const roleList = roles.split(',');
        const query = { role: { $in: roleList } };
        // Isolation: If the requester is an admin/manager/supervisor, only show users from their category
        if (req.user && req.user.role !== 'super_admin' && req.user.category) {
            query.category = req.user.category;
        }
        const users = yield user_model_1.User.find(query).select('-password');
        res.json(users);
    }
    catch (err) {
        console.error('Fetch users error:', err);
        res.status(500).json({ error: 'Failed to fetch users' });
    }
});
exports.getUsersByRoles = getUsersByRoles;
const getUserById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const user = yield user_model_1.User.findById(req.params.id).select('-password');
        if (!user)
            return res.status(404).json({ error: 'User not found' });
        res.json(user);
    }
    catch (err) {
        console.error('Fetch user by ID error:', err);
        res.status(500).json({ error: 'Failed to fetch user' });
    }
});
exports.getUserById = getUserById;
const getUsersByCategory = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { category } = req.query;
        if (!category)
            return res.status(400).json({ error: 'Category parameter is required' });
        // Normalize category name (some might come with underscores from Laravel)
        const normalizedCategory = category.replace(/_/g, '-');
        const users = yield user_model_1.User.find({ category: normalizedCategory }).select('-password');
        res.json(users);
    }
    catch (err) {
        console.error('Fetch users by category error:', err);
        res.status(500).json({ error: 'Failed to fetch users' });
    }
});
exports.getUsersByCategory = getUsersByCategory;
