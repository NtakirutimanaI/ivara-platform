"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const clientStat_controller_1 = require("../controllers/clientStat.controller");
const router = express_1.default.Router();
// Public routes
router.get('/', clientStat_controller_1.getClientStats);
// Admin routes (add authentication middleware later)
router.post('/', clientStat_controller_1.createClientStat);
router.put('/:id', clientStat_controller_1.updateClientStat);
router.delete('/:id', clientStat_controller_1.deleteClientStat);
exports.default = router;
