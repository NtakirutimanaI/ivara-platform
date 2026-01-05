"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const portfolio_controller_1 = require("../controllers/portfolio.controller");
const router = express_1.default.Router();
// Public Routes
router.get('/', portfolio_controller_1.getPortfolios);
router.get('/:slug', portfolio_controller_1.getPortfolioBySlug);
exports.default = router;
