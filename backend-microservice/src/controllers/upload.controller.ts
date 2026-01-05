import { Request, Response } from 'express';

// Upload file
export const uploadFile = (req: Request, res: Response) => {
    try {
        if (!req.file) {
            return res.status(400).json({ success: false, message: 'No file uploaded' });
        }

        // Return path relative to server root
        const filePath = `uploads/profile_photos/${req.file.filename}`;

        res.status(200).json({
            success: true,
            message: 'File uploaded successfully',
            data: {
                filename: req.file.filename,
                path: filePath,
                url: `/${filePath}`
            }
        });
    } catch (error) {
        console.error('Upload error:', error);
        res.status(500).json({ success: false, message: 'Failed to upload file' });
    }
};

// Legacy support for single file under 'profilePhoto' key or generic 'file'
// The middleware 'upload.single()' determines the key. 
