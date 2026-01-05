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
// src/migration/fullMigrate.ts
const mongoose_1 = __importDefault(require("mongoose"));
const promise_1 = __importDefault(require("mysql2/promise"));
const dotenv_1 = __importDefault(require("dotenv"));
dotenv_1.default.config();
// MySQL connection config (same as before)
const mysqlConfig = {
    host: process.env.MYSQL_HOST,
    port: Number(process.env.MYSQL_PORT || 3306),
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD || '',
    database: process.env.MYSQL_DB,
};
function getAllTables(conn) {
    return __awaiter(this, void 0, void 0, function* () {
        const [result] = yield conn.query('SHOW TABLES');
        const rows = result;
        if (rows.length === 0) {
            return [];
        }
        const key = Object.keys(rows[0])[0];
        return rows.map(r => r[key]);
    });
}
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
        const tables = yield getAllTables(mysqlConn);
        console.log('📋 Tables to migrate:', tables.join(', '));
        for (const table of tables) {
            const rows = yield fetchAll(mysqlConn, table);
            if (rows.length === 0) {
                console.log(`⚪ No rows in ${table}, skipping`);
                continue;
            }
            // Use native driver collection to avoid needing a Mongoose model
            const collection = mongoose_1.default.connection.collection(table);
            yield collection.insertMany(rows);
            console.log(`✅ Migrated ${rows.length} records from ${table} to MongoDB collection '${table}'`);
        }
        yield mysqlConn.end();
        yield mongoose_1.default.disconnect();
        console.log('✅ Full migration completed');
    });
}
migrate().catch(err => {
    console.error('❌ Migration error:', err);
    process.exit(1);
});
