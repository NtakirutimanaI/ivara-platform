import { Request, Response } from 'express';
import { Payment } from '../models/payment.model';

export const getAllPayments = async (req: Request, res: Response) => {
    try {
        const page = parseInt(req.query.page as string) || 1;
        const limit = parseInt(req.query.limit as string) || 10;
        const search = req.query.search as string || '';
        const skip = (page - 1) * limit;

        const query: any = {};
        if (search) {
            query.$or = [
                { userName: { $regex: search, $options: 'i' } },
                { userEmail: { $regex: search, $options: 'i' } },
                { transactionId: { $regex: search, $options: 'i' } }
            ];
        }

        const total = await Payment.countDocuments(query);
        const payments = await Payment.find(query)
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(limit);

        res.json({
            payments,
            pagination: {
                total,
                page,
                limit,
                pages: Math.ceil(total / limit)
            }
        });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch payments' });
    }
};

export const getPaymentStats = async (req: Request, res: Response) => {
    try {
        const totalRevenue = await Payment.aggregate([
            { $match: { status: 'completed' } },
            { $group: { _id: null, total: { $sum: '$amount' } } }
        ]);

        const businessRevenue = await Payment.aggregate([
            { $match: { status: 'completed', accountType: 'business' } },
            { $group: { _id: null, total: { $sum: '$amount' } } }
        ]);

        const individualRevenue = await Payment.aggregate([
            { $match: { status: 'completed', accountType: 'individual' } },
            { $group: { _id: null, total: { $sum: '$amount' } } }
        ]);

        res.json({
            total: totalRevenue[0]?.total || 0,
            business: businessRevenue[0]?.total || 0,
            individual: individualRevenue[0]?.total || 0
        });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch stats' });
    }
};

export const updatePaymentStatus = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const { status } = req.body;

        if (!['completed', 'pending', 'failed', 'refunded'].includes(status)) {
            return res.status(400).json({ error: 'Invalid status' });
        }

        const payment = await Payment.findByIdAndUpdate(id, { status }, { new: true });
        if (!payment) return res.status(404).json({ error: 'Payment not found' });

        res.json(payment);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update payment status' });
    }
};

export const deletePayment = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const payment = await Payment.findByIdAndDelete(id);
        if (!payment) return res.status(404).json({ error: 'Payment not found' });
        res.json({ message: 'Payment deleted successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete payment' });
    }
};

export const exportPayments = async (req: Request, res: Response) => {
    try {
        const { startDate, endDate } = req.query;
        const query: any = { status: 'completed' };

        if (startDate && endDate) {
            query.createdAt = {
                $gte: new Date(startDate as string),
                $lte: new Date(new Date(endDate as string).setHours(23, 59, 59, 999))
            };
        }

        const payments = await Payment.find(query).sort({ createdAt: -1 });

        // Transform for CSV
        const data = payments.map(p => ({
            TransactionID: p.transactionId,
            UserName: p.userName,
            UserEmail: p.userEmail,
            Amount: p.amount,
            Method: p.paymentMethod,
            AccountType: p.accountType,
            Status: p.status,
            Date: p.createdAt.toISOString().split('T')[0]
        }));

        res.json(data);
    } catch (err) {
        res.status(500).json({ error: 'Failed to export payments' });
    }
};
