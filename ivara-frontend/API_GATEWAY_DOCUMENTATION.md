# API Gateway Documentation
## Database-Agnostic Architecture

## 📋 Overview

This API Gateway is built with a **database-agnostic architecture** using the **Repository Pattern** and **Service Layer**. This means:

✅ **Works with MySQL right now** (current setup)  
✅ **Will work with MongoDB later** (zero code changes needed)  
✅ **Switch databases by changing one line** in `.env`

---

## 🏗️ Architecture

```
┌─────────────────────────────────────────────────────────┐
│                    API Gateway Layer                     │
│                                                          │
│  ┌────────────────────────────────────────────────┐    │
│  │  UserApiController                             │    │
│  │  - RESTful endpoints                           │    │
│  │  - JSON responses                              │    │
│  │  - Works with ANY database                     │    │
│  └──────────────────┬─────────────────────────────┘    │
│                     │                                    │
│                     ↓                                    │
│  ┌────────────────────────────────────────────────┐    │
│  │  UserService (Business Logic)                  │    │
│  │  - Validation                                  │    │
│  │  - Data transformation                         │    │
│  │  - Database-agnostic                           │    │
│  └──────────────────┬─────────────────────────────┘    │
│                     │                                    │
│                     ↓                                    │
│  ┌────────────────────────────────────────────────┐    │
│  │  UserRepositoryInterface                       │    │
│  │  - Abstract database operations                │    │
│  └──────────────────┬─────────────────────────────┘    │
│                     │                                    │
│         ┌───────────┴───────────┐                       │
│         ↓                       ↓                       │
│  ┌──────────────┐      ┌──────────────┐               │
│  │ MySQL Repo   │      │ MongoDB Repo │               │
│  │ (Active Now) │      │ (Ready)      │               │
│  └──────────────┘      └──────────────┘               │
│         │                       │                       │
│         ↓                       ↓                       │
│  ┌──────────────┐      ┌──────────────┐               │
│  │ MySQL DB     │      │ MongoDB      │               │
│  │ (Current)    │      │ (Future)     │               │
│  └──────────────┘      └──────────────┘               │
└─────────────────────────────────────────────────────────┘
```

---

## 📁 File Structure

```
app/
├── Contracts/
│   └── Repositories/
│       └── UserRepositoryInterface.php    # Abstract interface
│
├── Repositories/
│   ├── MySQL/
│   │   └── MySQLUserRepository.php        # MySQL implementation (active)
│   └── MongoDB/
│       └── MongoDBUserRepository.php      # MongoDB implementation (ready)
│
├── Services/
│   └── UserService.php                    # Business logic layer
│
├── Http/Controllers/Api/
│   └── UserApiController.php              # RESTful API endpoints
│
└── Providers/
    └── RepositoryServiceProvider.php      # Auto-binds correct repository
```

---

## 🔄 How Database Switching Works

### Current Setup (MySQL):
```env
# .env
DB_CONNECTION=mysql
```

The `RepositoryServiceProvider` automatically binds:
```php
UserRepositoryInterface → MySQLUserRepository → MySQL Database
```

### Future Setup (MongoDB):
```env
# .env
DB_CONNECTION=mongodb
```

The `RepositoryServiceProvider` automatically binds:
```php
UserRepositoryInterface → MongoDBUserRepository → MongoDB Database
```

**That's it!** No code changes needed. All API endpoints work exactly the same.

---

## 🚀 API Endpoints

### Base URL
```
http://127.0.0.1:8000/api
```

### User Management Endpoints

#### 1. Get All Users
```http
GET /api/users
```

**Query Parameters:**
- `role` - Filter by role (admin, manager, supervisor, technician, user)
- `status` - Filter by status (active, inactive, suspended)
- `search` - Search in name, email, username

**Example:**
```bash
curl http://127.0.0.1:8000/api/users?role=admin&status=active
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@gmail.com",
      "username": "admin",
      "role": "admin",
      "status": "active"
    }
  ],
  "count": 1
}
```

---

#### 2. Get User by ID
```http
GET /api/users/{id}
```

**Example:**
```bash
curl http://127.0.0.1:8000/api/users/1
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Admin",
    "email": "admin@gmail.com",
    "username": "admin",
    "role": "admin",
    "status": "active"
  }
}
```

---

#### 3. Create User
```http
POST /api/users
```

**Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "username": "johndoe",
  "password": "password123",
  "role": "user",
  "status": "active",
  "phone": "+1234567890",
  "country_code": "+1",
  "location": "New York"
}
```

**Example:**
```bash
curl -X POST http://127.0.0.1:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password123"}'
```

**Response:**
```json
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "id": 2,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "user",
    "status": "active"
  }
}
```

---

#### 4. Update User
```http
PUT /api/users/{id}
PATCH /api/users/{id}
```

**Body:** (all fields optional)
```json
{
  "name": "John Doe Updated",
  "email": "john.updated@example.com",
  "role": "manager",
  "status": "active"
}
```

**Example:**
```bash
curl -X PUT http://127.0.0.1:8000/api/users/2 \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe Updated","role":"manager"}'
```

**Response:**
```json
{
  "success": true,
  "message": "User updated successfully",
  "data": {
    "id": 2,
    "name": "John Doe Updated",
    "email": "john@example.com",
    "role": "manager",
    "status": "active"
  }
}
```

---

#### 5. Delete User
```http
DELETE /api/users/{id}
```

**Example:**
```bash
curl -X DELETE http://127.0.0.1:8000/api/users/2
```

**Response:**
```json
{
  "success": true,
  "message": "User deleted successfully"
}
```

---

#### 6. Get Users by Role
```http
GET /api/users/role/{role}
```

**Example:**
```bash
curl http://127.0.0.1:8000/api/users/role/admin
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@gmail.com",
      "role": "admin"
    }
  ],
  "count": 1
}
```

---

#### 7. Get User Statistics
```http
GET /api/users/statistics
```

**Example:**
```bash
curl http://127.0.0.1:8000/api/users/statistics
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total": 10,
    "by_role": {
      "admin": 2,
      "manager": 3,
      "user": 5
    },
    "by_status": {
      "active": 8,
      "inactive": 2
    }
  }
}
```

---

#### 8. Search Users
```http
GET /api/users/search?q={query}&fields[]={field}
```

**Query Parameters:**
- `q` - Search query (required)
- `fields[]` - Fields to search in (default: name, email, username)

**Example:**
```bash
curl "http://127.0.0.1:8000/api/users/search?q=john&fields[]=name&fields[]=email"
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 2,
      "name": "John Doe",
      "email": "john@example.com"
    }
  ],
  "count": 1
}
```

---

### Order Management Endpoints

#### 1. Get All Orders
```http
GET /api/orders
```

**Query Parameters:**
- `status` - Filter by status (Pending, Completed, etc.)
- `user_id` - Filter by user ID

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "order_number": "ORD-2024-001",
      "total_amount": 150.00,
      "status": "Pending"
    }
  ],
  "count": 1
}
```

#### 2. Get Order by ID
```http
GET /api/orders/{id}
```

#### 3. Create Order
```http
POST /api/orders
```

**Body:**
```json
{
  "user_id": 1,
  "order_number": "ORD-2024-002",
  "total_amount": 299.99,
  "status": "Pending",
  "payment_status": "Unpaid"
}
```

#### 4. Update Order
```http
PUT /api/orders/{id}
```

**Body:**
```json
{
  "status": "Completed",
  "payment_status": "Paid"
}
```

#### 5. Delete Order
```http
DELETE /api/orders/{id}
```

---

## 🔐 Error Responses

All endpoints return consistent error responses:

### Validation Error (422)
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email has already been taken."],
    "password": ["The password must be at least 8 characters."]
  }
}
```

### Not Found (404)
```json
{
  "success": false,
  "message": "User not found"
}
```

### Server Error (500)
```json
{
  "success": false,
  "message": "Failed to fetch users",
  "error": "Database connection error"
}
```

---

## 🧪 Testing the API

### Using cURL:
```bash
# Get all users
curl http://127.0.0.1:8000/api/users

# Create a user
curl -X POST http://127.0.0.1:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@example.com","password":"password123"}'

# Update a user
curl -X PUT http://127.0.0.1:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"Updated Name"}'

# Delete a user
curl -X DELETE http://127.0.0.1:8000/api/users/1
```

### Using Postman:
1. Import the collection (see `postman_collection.json`)
2. Set base URL: `http://127.0.0.1:8000/api`
3. Test all endpoints

---

## 🔄 Switching from MySQL to MongoDB

When you're ready to switch to MongoDB:

### Step 1: Install MongoDB Extension
```powershell
.\install-mongodb-extension.ps1
```

### Step 2: Install Laravel MongoDB Package
```bash
composer require mongodb/laravel-mongodb:^3.9
```

### Step 3: Update .env
```env
DB_CONNECTION=mongodb
DB_URI=mongodb+srv://admin:Admin123@cluster0.lkfwclx.mongodb.net/ivara_platform
```

### Step 4: Update User Model
```php
// app/Models/User.php
use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    // ... rest stays the same
}
```

### Step 5: Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan serve
```

### Step 6: Test API
```bash
curl http://127.0.0.1:8000/api/users
# Should work exactly the same!
```

---

## ✅ Benefits of This Architecture

1. **Database Agnostic** - Switch databases with one line change
2. **Clean Code** - Separation of concerns (Controller → Service → Repository)
3. **Testable** - Easy to mock repositories for unit tests
4. **Maintainable** - Business logic in one place
5. **Scalable** - Add new databases easily
6. **Future-Proof** - Ready for MongoDB migration

---

## 📝 Next Steps

1. ✅ **Currently Using MySQL** - All endpoints work
2. ⏳ **Install MongoDB Extension** - When ready
3. ⏳ **Switch to MongoDB** - Change `.env` only
4. ✅ **API Keeps Working** - Zero code changes

---

## 🆘 Support

If you encounter any issues:
1. Check `.env` - Ensure `DB_CONNECTION` is set correctly
2. Clear caches - Run `php artisan config:clear`
3. Check logs - `storage/logs/laravel.log`
4. Test database connection - `php artisan tinker` → `DB::connection()->getPdo()`

---

**Last Updated:** 2025-12-25  
**Version:** 1.0.0  
**Database:** MySQL (MongoDB-ready)
