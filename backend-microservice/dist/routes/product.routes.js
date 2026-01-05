"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const product_controller_1 = require("../controllers/product.controller");
const router = express_1.default.Router();
// Public routes - IMPORTANT: Specific routes BEFORE generic /:id
router.get('/', product_controller_1.getAllProducts);
router.get('/category/:category', product_controller_1.getProductsByCategory);
router.get('/seller/:sellerId', product_controller_1.getSellerProducts);
router.get('/:id', product_controller_1.getProductById); // This must be LAST among GET routes
// Seller routes (add auth middleware in production)
router.post('/', product_controller_1.createProduct);
router.put('/:id', product_controller_1.updateProduct);
router.delete('/:id', product_controller_1.deleteProduct);
exports.default = router;
