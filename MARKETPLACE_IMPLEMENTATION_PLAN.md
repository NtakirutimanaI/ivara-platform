# IVARA Marketplace Implementation Plan

## Overview
Build a complete multi-category marketplace system with product listings, cart functionality, order management, and notifications.

## System Architecture

### 9 Marketplace Categories
1. Technical & Repair
2. Creative & Lifestyle
3. Transport & Travel
4. Food & Fashion
5. Education & Knowledge
6. Agriculture & Environment
7. Media & Entertainment
8. Legal & Professional
9. Other Services

## Phase 1: Backend API (MongoDB)

### 1.1 Database Models

#### Product Model
```typescript
- productId: string (unique)
- name: string
- category: string (one of 9 categories)
- price: number
- currency: string (default: "FRW")
- stockQuantity: number
- stockStatus: enum ['In Stock', 'Low Stock', 'Out of Stock']
- description: string
- images: string[] (URLs)
- variants: [{
    name: string (e.g., "Color", "Size"),
    options: string[]
  }]
- seller: ObjectId (ref: User)
- status: enum ['Active', 'Inactive']
- createdAt: Date
- updatedAt: Date
```

#### Cart Model
```typescript
- userId: ObjectId (ref: User)
- items: [{
    productId: ObjectId (ref: Product),
    quantity: number,
    variant: object,
    price: number
  }]
- totalAmount: number
- createdAt: Date
- updatedAt: Date
```

#### Order Model
```typescript
- orderId: string (unique)
- buyerId: ObjectId (ref: User)
- sellerId: ObjectId (ref: User)
- items: [{
    productId: ObjectId (ref: Product),
    productName: string,
    quantity: number,
    variant: object,
    price: number,
    subtotal: number
  }]
- totalAmount: number
- currency: string
- status: enum ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled']
- paymentStatus: enum ['Pending', 'Paid', 'Failed', 'Refunded']
- shippingAddress: object
- notes: string
- createdAt: Date
- updatedAt: Date
```

### 1.2 API Endpoints

#### Products
- `GET /api/products` - Get all products (with filters)
- `GET /api/products/category/:category` - Get products by category
- `GET /api/products/:id` - Get single product
- `POST /api/products` - Create product (seller only)
- `PUT /api/products/:id` - Update product (seller only)
- `DELETE /api/products/:id` - Delete product (seller only)

#### Cart
- `GET /api/cart/:userId` - Get user cart
- `POST /api/cart/add` - Add item to cart
- `PUT /api/cart/update` - Update cart item quantity
- `DELETE /api/cart/remove/:itemId` - Remove item from cart
- `DELETE /api/cart/clear/:userId` - Clear entire cart

#### Orders
- `GET /api/orders/buyer/:userId` - Get buyer orders
- `GET /api/orders/seller/:userId` - Get seller orders
- `GET /api/orders/:orderId` - Get single order
- `POST /api/orders/create` - Create order from cart
- `PUT /api/orders/:orderId/status` - Update order status
- `PUT /api/orders/:orderId/cancel` - Cancel order

#### Notifications
- `GET /api/notifications/:userId` - Get user notifications
- `POST /api/notifications/create` - Create notification
- `PUT /api/notifications/:id/read` - Mark as read

## Phase 2: Frontend Pages

### 2.1 Marketplace Page (`/market/{category}`)
**Features:**
- Grid layout of products
- Product card showing:
  - Product image
  - Name
  - Price (FRW)
  - Stock status
  - "Add to Cart" button
  - "View Details" button
- Category filter
- Search functionality
- Pagination

### 2.2 Product Detail Page (`/product/{id}`)
**Features:**
- Full product images (gallery/slider)
- Product name & description
- Price & currency
- Stock availability
- Variant selection (size, color, etc.)
- Quantity selector
- "Add to Cart" button
- Seller information
- Related products

### 2.3 Cart Page (`/cart`)
**Features:**
- List of cart items
- Quantity adjustment
- Remove item option
- Subtotal per item
- Total amount
- "Continue Shopping" button
- "Proceed to Checkout" button (requires login)

### 2.4 Checkout Page (`/checkout`)
**Features:**
- Login/Register prompt if not authenticated
- Shipping address form
- Order summary
- Payment method selection
- Order notes
- "Place Order" button

### 2.5 Order Management

#### Buyer Orders (`/my-orders`)
- List of orders with status
- Order details view
- Track order option
- Cancel order (if pending)

#### Seller Orders (`/seller/orders`)
- List of received orders
- Order details with buyer info
- Update order status
- Order notifications
- Revenue summary

## Phase 3: Features

### 3.1 Authentication Guard
- Check if user is logged in before checkout
- Redirect to login with return URL
- Store cart in session for guest users

### 3.2 Notifications
- New order notification (to seller)
- Order status update (to buyer)
- Product added to cart confirmation
- Order confirmed notification
- Real-time notification badge

### 3.3 Security
- CSRF protection
- Input validation
- SQL injection prevention (using MongoDB)
- XSS protection
- Authentication middleware
- Role-based access (buyer/seller)

### 3.4 Seed Data
Create sample products for each category:
- 5-10 products per category
- Various price ranges
- Different stock statuses
- Multiple images per product
- Sample variants

## Phase 4: Integration

### 4.1 API Documentation
Update `documentation.txt` with:
- All endpoint details
- Request/Response examples
- Authentication requirements
- Error codes

### 4.2 Testing Checklist
- [ ] Browse marketplace by category
- [ ] View product details
- [ ] Add products to cart
- [ ] Update cart quantities
- [ ] Remove items from cart
- [ ] Login requirement before checkout
- [ ] Place order successfully
- [ ] Seller receives order notification
- [ ] Seller can update order status
- [ ] Buyer receives status update notification
- [ ] View order history

## Implementation Order

1. ✅ Create backend models (Product, Cart, Order)
2. ✅ Create backend controllers
3. ✅ Create backend routes
4. ✅ Seed sample products
5. ✅ Update frontend marketplace page
6. ✅ Create product detail page
7. ✅ Implement cart functionality
8. ✅ Create checkout flow with auth check
9. ✅ Build order management for sellers
10. ✅ Implement notification system
11. ✅ Update API documentation
12. ✅ Test all features

## Notes
- Use IVARA brand colors (#0A1128 navy, #ffb700 gold)
- All prices in FRW (Rwandan Francs)
- Mobile-responsive design
- Loading states for API calls
- Error handling for all operations
- Success messages for user actions
