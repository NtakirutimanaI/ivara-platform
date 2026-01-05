import express from 'express';
import cors from 'cors';
import dotenv from 'dotenv';
import mongoose from 'mongoose';
import categoryRouter from './routes/category.routes';
import healthRouter from './routes/health.routes';
import authRouter from './routes/auth.routes';
import technicalRepairRouter from './routes/technicalRepair.routes';
import transportTravelRouter from './routes/transportTravel.routes';
import creativeLifestyleRouter from './routes/creativeLifestyle.routes';
import foodEventsFashionRouter from './routes/foodEventsFashion.routes';
import superAdminRouter from './routes/superAdmin.routes';
import extraEntitiesRouter from './routes/extraEntities.routes';
import profileRouter from './routes/profile.routes';
import technicianRouter from './routes/technician.routes';
import bookingRouter from './routes/booking.routes';
import educationKnowledgeRouter from './routes/educationKnowledge.routes';
import agricultureEnvironmentRouter from './routes/agricultureEnvironment.routes';
import mediaEntertainmentRouter from './routes/mediaEntertainment.routes';
import legalProfessionalRouter from './routes/legalProfessional.routes';
import otherServicesRouter from './routes/otherServices.routes';

import pricingRouter from './routes/pricing.routes';
import resourceRouter from './routes/resource.routes';
import settingRouter from './routes/setting.routes';
import portfolioRouter from './routes/portfolio.routes';
import notificationRouter from './routes/notification.routes';
import testimonialRouter from './routes/testimonial.routes';
import clientStatRouter from './routes/clientStat.routes';
import newsletterRouter from './routes/newsletter.routes';
import productRouter from './routes/product.routes';
import cartRouter from './routes/cart.routes';
import orderRouter from './routes/order.routes';
import contactRouter from './routes/contact.routes';
import uploadRouter from './routes/upload.routes';
import deviceRouter from './routes/device.routes';

dotenv.config();

const app = express();
const PORT = process.env.PORT || 5001;

app.use(cors());
app.use(express.json());

// Translation middleware - must be after express.json()
import translationMiddleware from './middleware/translationMiddleware';
app.use(translationMiddleware);


// Connect to MongoDB
const mongoUri = process.env.MONGODB_URI || '';
if (!mongoUri) {
  console.error('MONGODB_URI not defined in .env');
  process.exit(1);
}

mongoose
  .connect(mongoUri)
  .then(() => console.log('✅ Connected to MongoDB'))
  .catch((err) => {
    console.error('❌ MongoDB connection error:', err);
    process.exit(1);
  });

import activityRouter from './routes/activity.routes';

// API routes
app.use('/api/auth', authRouter);
app.use('/api/activities', activityRouter);
app.use('/api/categories', categoryRouter);
app.use('/api/health', healthRouter);
app.use('/api/technical-repair', technicalRepairRouter);
app.use('/api/transport-travel', transportTravelRouter);
app.use('/api/creative-lifestyle', creativeLifestyleRouter);
app.use('/api/food-fashion', foodEventsFashionRouter);
app.use('/api/super-admin', superAdminRouter);
app.use('/api/extras', extraEntitiesRouter);
app.use('/api/profile', profileRouter);
app.use('/api/technician', technicianRouter);
app.use('/api/pricing', pricingRouter);
app.use('/api/resources', resourceRouter);
app.use('/api/settings', settingRouter);
app.use('/api/portfolio', portfolioRouter);
app.use('/api/booking', bookingRouter);
app.use('/api/notifications', notificationRouter);
app.use('/api/testimonials', testimonialRouter);
app.use('/api/client-stats', clientStatRouter);
app.use('/api/newsletter', newsletterRouter);
app.use('/api/products', productRouter);
app.use('/api/cart', cartRouter);
app.use('/api/orders', orderRouter);
app.use('/api/devices', deviceRouter);
app.use('/api/contact', contactRouter);
app.use('/api/upload', uploadRouter);
app.use('/api/education-knowledge', educationKnowledgeRouter);
app.use('/api/agriculture-environment', agricultureEnvironmentRouter);
app.use('/api/media-entertainment', mediaEntertainmentRouter);
app.use('/api/legal-professional', legalProfessionalRouter);
app.use('/api/other-services', otherServicesRouter);


// Serve uploaded files statically
app.use('/uploads', express.static('uploads'));

app.get('/', (req, res) => {
  res.send('Backend Microservice is running');
});

app.listen(PORT, () => {
  console.log(`🚀 Server listening on http://localhost:${PORT}`);
});
