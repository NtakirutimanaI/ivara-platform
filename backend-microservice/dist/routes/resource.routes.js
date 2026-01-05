"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const resource_controller_1 = require("../controllers/resource.controller");
const router = (0, express_1.Router)();
// Public Routes
router.get('/featured', resource_controller_1.getFeaturedResources); // For Menu
router.get('/faqs', resource_controller_1.getFaqs);
router.get('/:type', resource_controller_1.getResourcesByType); // /api/resources/blog, /api/resources/guide
router.get('/item/:slug', resource_controller_1.getResourceBySlug); // /api/resources/item/my-slug
exports.default = router;
