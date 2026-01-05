// src/migration/fullMigrate.ts
import mongoose from 'mongoose';
import mysql from 'mysql2/promise';
import dotenv from 'dotenv';

dotenv.config();

// MySQL connection config (same as before)
const mysqlConfig = {
    host: process.env.MYSQL_HOST!,
    port: Number(process.env.MYSQL_PORT || 3306),
    user: process.env.MYSQL_USER!,
    password: process.env.MYSQL_PASSWORD || '',
    database: process.env.MYSQL_DB!,
};

async function getAllTables(conn: mysql.Connection): Promise<string[]> {
    const [result] = await conn.query('SHOW TABLES');
    const rows = result as any[];
    if (rows.length === 0) {
        return [];
    }
    const key = Object.keys(rows[0])[0];
    return rows.map(r => r[key]);
}




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

    const tables = await getAllTables(mysqlConn);
    console.log('📋 Tables to migrate:', tables.join(', '));

    for (const table of tables) {
        const rows = await fetchAll(mysqlConn, table);
        if (rows.length === 0) {
            console.log(`⚪ No rows in ${table}, skipping`);
            continue;
        }
        // Use native driver collection to avoid needing a Mongoose model
        const collection = mongoose.connection.collection(table);
        await collection.insertMany(rows);
        console.log(`✅ Migrated ${rows.length} records from ${table} to MongoDB collection '${table}'`);
    }

    await mysqlConn.end();
    await mongoose.disconnect();
    console.log('✅ Full migration completed');
}

migrate().catch(err => {
    console.error('❌ Migration error:', err);
    process.exit(1);
});
