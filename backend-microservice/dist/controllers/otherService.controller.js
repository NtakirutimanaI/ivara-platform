"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.remove = exports.update = exports.create = exports.getById = exports.getAll = void 0;
const otherService_model_1 = require("../models/otherService.model");
const getAll = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const items = yield otherService_model_1.OtherService.find();
        res.json(items);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch records' });
    }
});
exports.getAll = getAll;
const getById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const item = yield otherService_model_1.OtherService.findById(req.params.id);
        if (!item)
            return res.status(404).json({ error: 'Not found' });
        res.json(item);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch record' });
    }
});
exports.getById = getById;
const create = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const newItem = new otherService_model_1.OtherService(req.body);
        yield newItem.save();
        res.status(201).json(newItem);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to create record' });
    }
});
exports.create = create;
const update = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const updated = yield otherService_model_1.OtherService.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updated)
            return res.status(404).json({ error: 'Not found' });
        res.json(updated);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to update record' });
    }
});
exports.update = update;
const remove = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const deleted = yield otherService_model_1.OtherService.findByIdAndDelete(req.params.id);
        if (!deleted)
            return res.status(404).json({ error: 'Not found' });
        res.json({ message: 'Deleted' });
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to delete record' });
    }
});
exports.remove = remove;
