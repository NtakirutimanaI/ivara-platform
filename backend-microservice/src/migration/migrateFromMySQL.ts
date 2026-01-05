// src/migration/migrateFromMySQL.ts
import mongoose from 'mongoose';
import mysql from 'mysql2/promise';
import dotenv from 'dotenv';
dotenv.config();

/* ---------- Mongoose models (import existing ones) ---------- */
import { User } from '../models/user.model';
import { TechnicalRepair } from '../models/technicalRepair.model';
import { CreativeLifestyle } from '../models/creativeLifestyle.model';
import { TransportTravel } from '../models/transportTravel.model';
import { FoodEventsFashion } from '../models/foodEventsFashion.model';
import { EducationKnowledge } from '../models/educationKnowledge.model';
import { AgricultureEnvironment } from '../models/agricultureEnvironment.model';
import { OtherService } from '../models/otherService.model';

/* ---------- MySQL connection config (read from .env) ---------- */
const mysqlConfig = {
    host: process.env.MYSQL_HOST!,
    port: Number(process.env.MYSQL_PORT || 3306),
    user: process.env.MYSQL_USER!,
    password: process.env.MYSQL_PASSWORD || '',
    database: process.env.MYSQL_DB!,
};

async function fetchAll(conn: mysql.Connection, table: string) {
    const [rows] = await conn.execute(`SELECT * FROM \`${table}\``);
    return rows as any[];
}

async function migrate() {
    // Connect to MongoDB
    await mongoose.connect(process.env.MONGODB_URI!);
    console.log('✅ Connected to MongoDB');

    // Connect to MySQL
    const mysqlConn = await mysql.createConnection(mysqlConfig);
    console.log('✅ Connected to MySQL');

    // ---- Users ----
    console.log('⏳ Migrating Users...');
    const userRows = await fetchAll(mysqlConn, 'users');
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
    await User.deleteMany({});
    await User.insertMany(userDocs);
    console.log(`✅ Migrated ${userDocs.length} users`);

    // ---- Technical & Repair ----
    console.log('⏳ Migrating TechnicalRepair...');
    const techRows = await fetchAll(mysqlConn, 'technical_repair_services');
    const techDocs = techRows.map(r => ({
        ...r,
        technician_id: r.technician_id?.toString() ?? '',
    }));
    await TechnicalRepair.deleteMany({});
    await TechnicalRepair.insertMany(techDocs);
    console.log(`✅ Migrated ${techDocs.length} TechnicalRepair records`);

    // ---- Creative, Lifestyle & Wellness ----
    console.log('⏳ Migrating CreativeLifestyle...');
    const creativeRows = await fetchAll(mysqlConn, 'creative_lifestyle_services');
    const creativeDocs = creativeRows.map(r => ({
        ...r,
        provider_id: r.provider_id?.toString() ?? '',
    }));
    await CreativeLifestyle.deleteMany({});
    await CreativeLifestyle.insertMany(creativeDocs);
    console.log(`✅ Migrated ${creativeDocs.length} CreativeLifestyle records`);

    // ---- Transport, Travel & Hospitality ----
    console.log('⏳ Migrating TransportTravel...');
    const travelRows = await fetchAll(mysqlConn, 'transport_travel_services');
    const travelDocs = travelRows.map(r => ({
        ...r,
        provider_id: r.provider_id?.toString() ?? '',
    }));
    await TransportTravel.deleteMany({});
    await TransportTravel.insertMany(travelDocs);
    console.log(`✅ Migrated ${travelDocs.length} TransportTravel records`);

    // ---- Food, Events & Fashion ----
    console.log('⏳ Migrating FoodEventsFashion...');
    const foodRows = await fetchAll(mysqlConn, 'food_fashion_services');
    const foodDocs = foodRows.map(r => ({
        ...r,
        vendor_id: r.vendor_id?.toString() ?? '',
    }));
    await FoodEventsFashion.deleteMany({});
    await FoodEventsFashion.insertMany(foodDocs);
    console.log(`✅ Migrated ${foodDocs.length} FoodEventsFashion records`);

    // ---- Education & Knowledge ----
    console.log('⏳ Migrating EducationKnowledge...');
    const eduRows = await fetchAll(mysqlConn, 'education_knowledge_courses');
    const eduDocs = eduRows.map(r => ({
        ...r,
        instructor_id: r.instructor_id?.toString() ?? '',
    }));
    await EducationKnowledge.deleteMany({});
    await EducationKnowledge.insertMany(eduDocs);
    console.log(`✅ Migrated ${eduDocs.length} EducationKnowledge records`);

    // ---- Agriculture, Farming & Environment ----
    console.log('⏳ Migrating AgricultureEnvironment...');
    const agriRows = await fetchAll(mysqlConn, 'agriculture_environment_services');
    const agriDocs = agriRows.map(r => ({
        ...r,
        provider_id: r.provider_id?.toString() ?? '',
    }));
    await AgricultureEnvironment.deleteMany({});
    await AgricultureEnvironment.insertMany(agriDocs);
    console.log(`✅ Migrated ${agriDocs.length} AgricultureEnvironment records`);

    // ---- Other Services ----
    console.log('⏳ Migrating OtherService...');
    const otherRows = await fetchAll(mysqlConn, 'other_services_services');
    const otherDocs = otherRows.map(r => ({
        ...r,
        provider_id: r.provider_id?.toString() ?? '',
    }));
    await OtherService.deleteMany({});
    await OtherService.insertMany(otherDocs);
    console.log(`✅ Migrated ${otherDocs.length} OtherService records`);

    await mysqlConn.end();
    await mongoose.disconnect();
    console.log('✅ Migration completed');
}

migrate().catch(err => {
    console.error('❌ Migration error:', err);
    process.exit(1);
});
