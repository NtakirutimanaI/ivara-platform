import express from 'express';
import { getPortfolios, getPortfolioBySlug } from '../controllers/portfolio.controller';

const router = express.Router();

// Public Routes
router.get('/', getPortfolios);
router.get('/:slug', getPortfolioBySlug);

export default router;
