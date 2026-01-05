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
const mongoose_1 = __importDefault(require("mongoose"));
const bcrypt_1 = __importDefault(require("bcrypt"));
const dotenv_1 = __importDefault(require("dotenv"));
dotenv_1.default.config();
// User Schema
const UserSchema = new mongoose_1.default.Schema({
    name: { type: String, required: true },
    username: { type: String, required: true, unique: true },
    email: { type: String, required: true, unique: true },
    password: { type: String, required: true },
    role: { type: String, required: true },
    category: { type: String },
    isActive: { type: Boolean, default: true },
}, { timestamps: true });
const User = mongoose_1.default.model('User', UserSchema);
const seedUsers = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const mongoUri = process.env.MONGODB_URI || 'mongodb://127.0.0.1:27017/ivara';
        yield mongoose_1.default.connect(mongoUri);
        console.log('✅ Connected to MongoDB');
        // Drop indexes and clear users
        try {
            yield User.collection.dropIndexes();
        }
        catch (e) { }
        yield User.deleteMany({});
        console.log('🗑️  Cleared existing users');
        const hashedPassword = yield bcrypt_1.default.hash('password', 10);
        // Define Categories
        const categories = [
            { id: 'technical-repair', name: 'Technical & Repair' },
            { id: 'creative-lifestyle', name: 'Creative & Lifestyle' },
            { id: 'transport-travel', name: 'Transport & Travel' },
            { id: 'food-fashion', name: 'Food, Events & Fashion' },
            { id: 'education-knowledge', name: 'Education & Knowledge' },
            { id: 'agriculture-environment', name: 'Agriculture & Environment' },
            { id: 'media-entertainment', name: 'Media & Entertainment' },
            { id: 'legal-professional', name: 'Legal & Professional' },
            { id: 'other-services', name: 'Other Services' }
        ];
        const users = [
            // SYSTEM ADMIN
            {
                name: 'Super Admin',
                email: 'ivara.superadmin@gmail.com',
                password: hashedPassword,
                role: 'super_admin',
                isActive: true,
            }
        ];
        // Generate 3 Admins per category (Total 27)
        categories.forEach(cat => {
            let slug = cat.id.split('-')[0]; // simple slug like 'tech', 'creative'
            if (slug === 'technical')
                slug = 'tech'; // Use 'tech' instead of 'technical' to match documentation
            // 1. Admin
            users.push({
                name: `${cat.name} Admin`,
                email: `${slug}.admin@ivara.com`,
                password: hashedPassword,
                role: 'admin',
                category: cat.id,
                isActive: true
            });
            // 2. Manager
            users.push({
                name: `${cat.name} Manager`,
                email: `${slug}.manager@ivara.com`,
                password: hashedPassword,
                role: 'manager',
                category: cat.id,
                isActive: true
            });
            // 3. Supervisor
            users.push({
                name: `${cat.name} Supervisor`,
                email: `${slug}.supervisor@ivara.com`,
                password: hashedPassword,
                role: 'supervisor',
                category: cat.id,
                isActive: true
            });
        });
        // Add some sample Technicians and Users for each category to test isolation
        categories.forEach(cat => {
            const slug = cat.id.split('-')[0];
            users.push({
                name: `${cat.name} Provider`,
                email: `provider.${slug}@ivara.com`,
                password: hashedPassword,
                role: 'technician',
                category: cat.id,
                isActive: true
            });
            users.push({
                name: `${cat.name} Client`,
                email: `client.${slug}@ivara.com`,
                password: hashedPassword,
                role: 'user',
                category: cat.id,
                isActive: true
            });
        });
        // Add usernames and insert
        const usersToInsert = users.map(u => (Object.assign(Object.assign({}, u), { username: u.email.split('@')[0] })));
        yield User.insertMany(usersToInsert);
        console.log(`✅ Successfully seeded ${usersToInsert.length} users.`);
        process.exit(0);
    }
    catch (error) {
        console.error('❌ Seeding failed:', error);
        process.exit(1);
    }
});
seedUsers();
