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
// src/migration/migrateFromMySQL.ts
const mongoose_1 = __importDefault(require("mongoose"));
const promise_1 = __importDefault(require("mysql2/promise"));
const dotenv_1 = __importDefault(require("dotenv"));
dotenv_1.default.config();
/* ---------- Mongoose models (import existing ones) ---------- */
const user_model_1 = require("../models/user.model");
const technicalRepair_model_1 = require("../models/technicalRepair.model");
const creativeLifestyle_model_1 = require("../models/creativeLifestyle.model");
const transportTravel_model_1 = require("../models/transportTravel.model");
const foodEventsFashion_model_1 = require("../models/foodEventsFashion.model");
const educationKnowledge_model_1 = require("../models/educationKnowledge.model");
const agricultureEnvironment_model_1 = require("../models/agricultureEnvironment.model");
const otherService_model_1 = require("../models/otherService.model");
/* ---------- MySQL connection config (read from .env) ---------- */
const mysqlConfig = {
    host: process.env.MYSQL_HOST,
    port: Number(process.env.MYSQL_PORT || 3306),
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD || '',
    database: process.env.MYSQL_DB,
};
function fetchAll(conn, table) {
    return __awaiter(this, void 0, void 0, function* () {
        const [rows] = yield conn.execute(`SELECT * FROM \`${table}\``);
        return rows;
    });
}
function migrate() {
    return __awaiter(this, void 0, void 0, function* () {
        // Connect to MongoDB
        yield mongoose_1.default.connect(process.env.MONGODB_URI);
        console.log('✅ Connected to MongoDB');
        // Connect to MySQL
        const mysqlConn = yield promise_1.default.createConnection(mysqlConfig);
        console.log('✅ Connected to MySQL');
        // ---- Users ----
        console.log('⏳ Migrating Users...');
        const userRows = yield fetchAll(mysqlConn, 'users');
        const userDocs = userRows.map(r => ({
            username: r.username || r.email.split('@')[0],
            email: r.email,
            password: r.password, // This will be the Laravel hash
            role: r.role || 'customer',
            name: r.name,
            phone: r.phone,
            address: r.location,
            profilePhoto: r.profile_photo
        }));
        // Clear existing users to avoid unique constraint errors if re-running
        yield user_model_1.User.deleteMany({});
        yield user_model_1.User.insertMany(userDocs);
        console.log(`✅ Migrated ${userDocs.length} users`);
        // ---- Technical & Repair ----
        console.log('⏳ Migrating TechnicalRepair...');
        const techRows = yield fetchAll(mysqlConn, 'technical_repair_services');
        const techDocs = techRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { technician_id: (_b = (_a = r.technician_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield technicalRepair_model_1.TechnicalRepair.deleteMany({});
        yield technicalRepair_model_1.TechnicalRepair.insertMany(techDocs);
        console.log(`✅ Migrated ${techDocs.length} TechnicalRepair records`);
        // ---- Creative, Lifestyle & Wellness ----
        console.log('⏳ Migrating CreativeLifestyle...');
        const creativeRows = yield fetchAll(mysqlConn, 'creative_lifestyle_services');
        const creativeDocs = creativeRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { provider_id: (_b = (_a = r.provider_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield creativeLifestyle_model_1.CreativeLifestyle.deleteMany({});
        yield creativeLifestyle_model_1.CreativeLifestyle.insertMany(creativeDocs);
        console.log(`✅ Migrated ${creativeDocs.length} CreativeLifestyle records`);
        // ---- Transport, Travel & Hospitality ----
        console.log('⏳ Migrating TransportTravel...');
        const travelRows = yield fetchAll(mysqlConn, 'transport_travel_services');
        const travelDocs = travelRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { provider_id: (_b = (_a = r.provider_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield transportTravel_model_1.TransportTravel.deleteMany({});
        yield transportTravel_model_1.TransportTravel.insertMany(travelDocs);
        console.log(`✅ Migrated ${travelDocs.length} TransportTravel records`);
        // ---- Food, Events & Fashion ----
        console.log('⏳ Migrating FoodEventsFashion...');
        const foodRows = yield fetchAll(mysqlConn, 'food_fashion_services');
        const foodDocs = foodRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { vendor_id: (_b = (_a = r.vendor_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield foodEventsFashion_model_1.FoodEventsFashion.deleteMany({});
        yield foodEventsFashion_model_1.FoodEventsFashion.insertMany(foodDocs);
        console.log(`✅ Migrated ${foodDocs.length} FoodEventsFashion records`);
        // ---- Education & Knowledge ----
        console.log('⏳ Migrating EducationKnowledge...');
        const eduRows = yield fetchAll(mysqlConn, 'education_knowledge_courses');
        const eduDocs = eduRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { instructor_id: (_b = (_a = r.instructor_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield educationKnowledge_model_1.EducationKnowledge.deleteMany({});
        yield educationKnowledge_model_1.EducationKnowledge.insertMany(eduDocs);
        console.log(`✅ Migrated ${eduDocs.length} EducationKnowledge records`);
        // ---- Agriculture, Farming & Environment ----
        console.log('⏳ Migrating AgricultureEnvironment...');
        const agriRows = yield fetchAll(mysqlConn, 'agriculture_environment_services');
        const agriDocs = agriRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { provider_id: (_b = (_a = r.provider_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield agricultureEnvironment_model_1.AgricultureEnvironment.deleteMany({});
        yield agricultureEnvironment_model_1.AgricultureEnvironment.insertMany(agriDocs);
        console.log(`✅ Migrated ${agriDocs.length} AgricultureEnvironment records`);
        // ---- Other Services ----
        console.log('⏳ Migrating OtherService...');
        const otherRows = yield fetchAll(mysqlConn, 'other_services_services');
        const otherDocs = otherRows.map(r => {
            var _a, _b;
            return (Object.assign(Object.assign({}, r), { provider_id: (_b = (_a = r.provider_id) === null || _a === void 0 ? void 0 : _a.toString()) !== null && _b !== void 0 ? _b : '' }));
        });
        yield otherService_model_1.OtherService.deleteMany({});
        yield otherService_model_1.OtherService.insertMany(otherDocs);
        console.log(`✅ Migrated ${otherDocs.length} OtherService records`);
        yield mysqlConn.end();
        yield mongoose_1.default.disconnect();
        console.log('✅ Migration completed');
    });
}
migrate().catch(err => {
    console.error('❌ Migration error:', err);
    process.exit(1);
});
