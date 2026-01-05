import mongoose from 'mongoose';
import { Product } from './src/models/product.model';
import dotenv from 'dotenv';

dotenv.config();

const sampleProducts = [
    {
        name: 'Laptop Repair Service',
        description: 'Professional laptop repair and maintenance service. We fix all brands including HP, Dell, Lenovo, and more.',
        price: 50000,
        category: 'technical',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439011'), // Sample seller ID
        images: ['https://placehold.co/400x300/0A1128/FFF?text=Laptop+Repair'],
        stockQuantity: 10,
        stockStatus: 'In Stock',
        status: 'Active',
        specifications: {
            serviceType: 'Repair',
            warranty: '30 days',
            turnaroundTime: '2-3 days'
        }
    },
    {
        name: 'Phone Screen Replacement',
        description: 'Quick and professional phone screen replacement service for all smartphone brands.',
        price: 30000,
        category: 'technical',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439011'),
        images: ['https://placehold.co/400x300/162447/FFF?text=Phone+Repair'],
        stockQuantity: 15,
        stockStatus: 'In Stock',
        status: 'Active'
    },
    {
        name: 'Fashion Design Course',
        description: 'Learn professional fashion design from industry experts. 3-month comprehensive course.',
        price: 100000,
        category: 'food-fashion',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439012'),
        images: ['https://placehold.co/400x300/ffb700/000?text=Fashion+Course'],
        stockQuantity: 20,
        stockStatus: 'In Stock',
        status: 'Active'
    },
    {
        name: 'Traditional Rwandan Cuisine',
        description: 'Delicious traditional Rwandan meals prepared fresh daily. Catering available.',
        price: 5000,
        category: 'food-fashion',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439013'),
        images: ['https://placehold.co/400x300/28a745/FFF?text=Rwandan+Food'],
        stockQuantity: 50,
        stockStatus: 'In Stock',
        status: 'Active'
    },
    {
        name: 'City Transport Service',
        description: 'Reliable city transport service. Safe and comfortable rides across Kigali.',
        price: 2000,
        category: 'transport',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439014'),
        images: ['https://placehold.co/400x300/007bff/FFF?text=Transport'],
        stockQuantity: 5,
        stockStatus: 'Low Stock',
        status: 'Active'
    },
    {
        name: 'English Tutoring',
        description: 'Professional English tutoring for all levels. One-on-one and group sessions available.',
        price: 15000,
        category: 'education',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439015'),
        images: ['https://placehold.co/400x300/6f42c1/FFF?text=English+Tutor'],
        stockQuantity: 10,
        stockStatus: 'In Stock',
        status: 'Active'
    },
    {
        name: 'Organic Vegetables',
        description: 'Fresh organic vegetables grown locally. Delivered to your door.',
        price: 8000,
        category: 'agriculture',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439016'),
        images: ['https://placehold.co/400x300/28a745/FFF?text=Organic+Veggies'],
        stockQuantity: 100,
        stockStatus: 'In Stock',
        status: 'Active'
    },
    {
        name: 'Photography Service',
        description: 'Professional photography for events, weddings, and portraits.',
        price: 75000,
        category: 'creative',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439017'),
        images: ['https://placehold.co/400x300/fd7e14/000?text=Photography'],
        stockQuantity: 3,
        stockStatus: 'Low Stock',
        status: 'Active'
    },
    {
        name: 'Legal Consultation',
        description: 'Expert legal consultation for business and personal matters.',
        price: 50000,
        category: 'legal',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439018'),
        images: ['https://placehold.co/400x300/dc3545/FFF?text=Legal+Service'],
        stockQuantity: 10,
        stockStatus: 'In Stock',
        status: 'Active'
    },
    {
        name: 'Video Production',
        description: 'Professional video production and editing services for businesses and events.',
        price: 120000,
        category: 'media',
        seller: new mongoose.Types.ObjectId('507f1f77bcf86cd799439019'),
        images: ['https://placehold.co/400x300/e83e8c/FFF?text=Video+Production'],
        stockQuantity: 5,
        stockStatus: 'Low Stock',
        status: 'Active'
    }
];

async function createSampleProducts() {
    try {
        console.log('Connecting to MongoDB...');
        await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/ivara');
        console.log('✅ Connected to MongoDB');

        // Check if products already exist
        const existingCount = await Product.countDocuments();
        console.log(`Found ${existingCount} existing products`);

        if (existingCount > 0) {
            console.log('\n⚠️  Products already exist in database.');
            console.log('Do you want to:');
            console.log('1. Keep existing and add new samples');
            console.log('2. Delete all and create fresh samples');
            console.log('\nTo delete all: await Product.deleteMany({})');
            console.log('Then run this script again.\n');
        }

        // Create sample products
        console.log('\nCreating sample products...');
        const created = await Product.insertMany(sampleProducts);
        console.log(`✅ Created ${created.length} sample products`);

        // Display created products
        console.log('\n📦 Sample Products Created:');
        created.forEach((product, index) => {
            console.log(`${index + 1}. ${product.name} (${product.category}) - ${product.price} FRW - ID: ${product._id}`);
        });

        console.log('\n✅ Done! You can now view products at:');
        console.log('   http://localhost:8000/marketplace');

        await mongoose.disconnect();
        process.exit(0);
    } catch (error: any) {
        console.error('❌ Error:', error.message);
        await mongoose.disconnect();
        process.exit(1);
    }
}

createSampleProducts();
