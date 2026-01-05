"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const cors_1 = __importDefault(require("cors"));
const dotenv_1 = __importDefault(require("dotenv"));
const mongoose_1 = __importDefault(require("mongoose"));
const category_routes_1 = __importDefault(require("./routes/category.routes"));
const health_routes_1 = __importDefault(require("./routes/health.routes"));
const auth_routes_1 = __importDefault(require("./routes/auth.routes"));
const technicalRepair_routes_1 = __importDefault(require("./routes/technicalRepair.routes"));
const transportTravel_routes_1 = __importDefault(require("./routes/transportTravel.routes"));
const creativeLifestyle_routes_1 = __importDefault(require("./routes/creativeLifestyle.routes"));
const foodEventsFashion_routes_1 = __importDefault(require("./routes/foodEventsFashion.routes"));
const superAdmin_routes_1 = __importDefault(require("./routes/superAdmin.routes"));
const extraEntities_routes_1 = __importDefault(require("./routes/extraEntities.routes"));
const profile_routes_1 = __importDefault(require("./routes/profile.routes"));
const technician_routes_1 = __importDefault(require("./routes/technician.routes"));
const booking_routes_1 = __importDefault(require("./routes/booking.routes"));
const educationKnowledge_routes_1 = __importDefault(require("./routes/educationKnowledge.routes"));
const agricultureEnvironment_routes_1 = __importDefault(require("./routes/agricultureEnvironment.routes"));
const mediaEntertainment_routes_1 = __importDefault(require("./routes/mediaEntertainment.routes"));
const legalProfessional_routes_1 = __importDefault(require("./routes/legalProfessional.routes"));
const otherServices_routes_1 = __importDefault(require("./routes/otherServices.routes"));
const pricing_routes_1 = __importDefault(require("./routes/pricing.routes"));
const resource_routes_1 = __importDefault(require("./routes/resource.routes"));
const setting_routes_1 = __importDefault(require("./routes/setting.routes"));
const portfolio_routes_1 = __importDefault(require("./routes/portfolio.routes"));
const notification_routes_1 = __importDefault(require("./routes/notification.routes"));
const testimonial_routes_1 = __importDefault(require("./routes/testimonial.routes"));
const clientStat_routes_1 = __importDefault(require("./routes/clientStat.routes"));
const newsletter_routes_1 = __importDefault(require("./routes/newsletter.routes"));
const product_routes_1 = __importDefault(require("./routes/product.routes"));
const cart_routes_1 = __importDefault(require("./routes/cart.routes"));
const order_routes_1 = __importDefault(require("./routes/order.routes"));
const contact_routes_1 = __importDefault(require("./routes/contact.routes"));
dotenv_1.default.config();
const app = (0, express_1.default)();
const PORT = process.env.PORT || 5001;
app.use((0, cors_1.default)());
app.use(express_1.default.json());
// Translation middleware - must be after express.json()
const translationMiddleware_1 = __importDefault(require("./middleware/translationMiddleware"));
app.use(translationMiddleware_1.default);
// Connect to MongoDB
const mongoUri = process.env.MONGODB_URI || '';
if (!mongoUri) {
    console.error('MONGODB_URI not defined in .env');
    process.exit(1);
}
mongoose_1.default
    .connect(mongoUri)
    .then(() => console.log('✅ Connected to MongoDB'))
    .catch((err) => {
    console.error('❌ MongoDB connection error:', err);
    process.exit(1);
});
const activity_routes_1 = __importDefault(require("./routes/activity.routes"));
// API routes
app.use('/api/auth', auth_routes_1.default);
app.use('/api/activities', activity_routes_1.default);
app.use('/api/categories', category_routes_1.default);
app.use('/api/health', health_routes_1.default);
app.use('/api/technical-repair', technicalRepair_routes_1.default);
app.use('/api/transport-travel', transportTravel_routes_1.default);
app.use('/api/creative-lifestyle', creativeLifestyle_routes_1.default);
app.use('/api/food-fashion', foodEventsFashion_routes_1.default);
app.use('/api/super-admin', superAdmin_routes_1.default);
app.use('/api/extras', extraEntities_routes_1.default);
app.use('/api/profile', profile_routes_1.default);
app.use('/api/technician', technician_routes_1.default);
app.use('/api/pricing', pricing_routes_1.default);
app.use('/api/resources', resource_routes_1.default);
app.use('/api/settings', setting_routes_1.default);
app.use('/api/portfolio', portfolio_routes_1.default);
app.use('/api/booking', booking_routes_1.default);
app.use('/api/notifications', notification_routes_1.default);
app.use('/api/testimonials', testimonial_routes_1.default);
app.use('/api/client-stats', clientStat_routes_1.default);
app.use('/api/newsletter', newsletter_routes_1.default);
app.use('/api/products', product_routes_1.default);
app.use('/api/cart', cart_routes_1.default);
app.use('/api/orders', order_routes_1.default);
app.use('/api/contact', contact_routes_1.default);
app.use('/api/education-knowledge', educationKnowledge_routes_1.default);
app.use('/api/agriculture-environment', agricultureEnvironment_routes_1.default);
app.use('/api/media-entertainment', mediaEntertainment_routes_1.default);
app.use('/api/legal-professional', legalProfessional_routes_1.default);
app.use('/api/other-services', otherServices_routes_1.default);
// Serve uploaded files statically
app.use('/uploads', express_1.default.static('uploads'));
app.get('/', (req, res) => {
    res.send('Backend Microservice is running');
});
app.listen(PORT, () => {
    console.log(`🚀 Server listening on http://localhost:${PORT}`);
});
