# B2B Wholesale Marketplace Implementation Plan

## Overview
Create a dedicated B2B marketplace for wholesale companies and enterprises to connect buyers and sellers for bulk transactions.

## Key Differences from B2C Marketplace
1. **Bulk Pricing**: Volume-based pricing tiers
2. **MOQ (Minimum Order Quantity)**: Required minimum quantities
3. **RFQ System**: Request for Quotation functionality
4. **Company Verification**: Business registration verification
5. **Negotiation**: Price negotiation features
6. **Credit Terms**: Payment terms (NET 30, NET 60, etc.)
7. **Business Documents**: Upload invoices, purchase orders, contracts

## Backend Models (MongoDB)

### 1. B2BCompany Model
```typescript
{
    companyId: string (auto-generated)
    userId: ObjectId (ref User)
    companyName: string
    businessType: enum ['Manufacturer', 'Distributor', 'Wholesaler', 'Retailer']
    registrationNumber: string
    taxId: string
    address: {
        street, city, state, country, zipCode
    }
    contactPerson: {
        name, email, phone
    }
    verificationStatus: enum ['Pending', 'Verified', 'Rejected']
    verificationDocuments: string[]
    creditLimit: number
    paymentTerms: string[]
    createdAt, updatedAt
}
```

### 2. B2BProduct Model
```typescript
{
    productId: string
    sellerId: ObjectId (ref B2BCompany)
    name: string
    category: string
    description: string
    images: string[]
    specifications: Map
    moq: number (Minimum Order Quantity)
    pricingTiers: [{
        minQuantity: number
        maxQuantity: number
        pricePerUnit: number
    }]
    stockQuantity: number
    leadTime: string
    status: enum ['Active', 'Inactive']
}
```

### 3. RFQ (Request for Quotation) Model
```typescript
{
    rfqId: string
    buyerId: ObjectId (ref B2BCompany)
    productName: string
    category: string
    description: string
    quantity: number
    targetPrice: number
    deadline: Date
    attachments: string[]
    status: enum ['Open', 'Closed', 'Awarded']
    quotations: [{
        sellerId: ObjectId
        pricePerUnit: number
        totalPrice: number
        leadTime: string
        notes: string
        submittedAt: Date
    }]
}
```

### 4. B2BOrder Model
```typescript
{
    orderId: string
    buyerId: ObjectId (ref B2BCompany)
    sellerId: ObjectId (ref B2BCompany)
    items: [{
        productId, quantity, pricePerUnit, subtotal
    }]
    totalAmount: number
    paymentTerms: string
    deliveryAddress: object
    shippingMethod: string
    notes: string
    status: enum ['Draft', 'Pending', 'Confirmed', 'Shipped', 'Delivered', 'Cancelled']
    invoiceUrl: string
    poNumber: string
}
```

## API Endpoints

### Companies
- POST /api/b2b/companies - Register company
- GET /api/b2b/companies/:id - Get company details
- PUT /api/b2b/companies/:id - Update company
- GET /api/b2b/companies/:id/verify - Verify company

### B2B Products
- GET /api/b2b/products - List all B2B products
- GET /api/b2b/products/:id - Get product details
- POST /api/b2b/products - Create product
- PUT /api/b2b/products/:id - Update product
- GET /api/b2b/products/seller/:sellerId - Get seller products

### RFQ (Request for Quotation)
- POST /api/b2b/rfq - Create RFQ
- GET /api/b2b/rfq - List RFQs
- GET /api/b2b/rfq/:id - Get RFQ details
- POST /api/b2b/rfq/:id/quote - Submit quotation
- PUT /api/b2b/rfq/:id/award - Award RFQ to seller

### B2B Orders
- POST /api/b2b/orders - Create order
- GET /api/b2b/orders/buyer/:buyerId - Get buyer orders
- GET /api/b2b/orders/seller/:sellerId - Get seller orders
- PUT /api/b2b/orders/:id/status - Update order status

## Frontend Pages

### 1. B2B Landing Page (`/b2b`)
- Hero section explaining B2B marketplace
- Features showcase
- Register company CTA
- Browse products section
- Create RFQ section
- Statistics (products, companies, transactions)

### 2. Company Registration (`/b2b/register`)
- Multi-step form
- Company details
- Verification documents upload
- Business type selection

### 3. B2B Product Listing (`/b2b/products`)
- Grid view with MOQ
- Price tiers display
- Advanced filters
- Bulk inquiry button

### 4. RFQ Page (`/b2b/rfq`)
- Create RFQ form
- Browse open RFQs
- Submit quotations
- Manage received quotations

### 5. B2B Dashboard (`/b2b/dashboard`)
- Company profile
- Product management
- Order management
- RFQ management
- Analytics

## Implementation Steps
1. ✅ Create implementation plan
2. ⏳ Create backend models
3. ⏳ Create controllers and routes
4. ⏳ Create frontend landing page
5. ⏳ Link from header

## Next Action
Start with creating the B2B landing page and basic backend structure.
