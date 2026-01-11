# Super Admin Category Module Design - IVARA Platform

## Overview
The Super Admin Category Module allows for the centralized management of independent service verticals (Categories) within the Ivara Platform. Each category (e.g., Technical, Creative, Transport) functions as a logical container for microservices, providers, and specific business logic.

## 1. Database Schema

### Table: `categories`
Stores the metadata and configuration for each service vertical.

| Column Name | Data Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT | Primary Key | Unique identifier |
| `name` | STRING | Not Null | Display name (e.g., "Transport & Travel") |
| `slug` | STRING | Unique, Index | URL-friendly identifier (e.g., `transport-travel`) |
| `description` | TEXT | Nullable | Short description of the category |
| `icon` | STRING | Nullable | FontAwesome class or Image URL |
| `status` | ENUM | 'active', 'inactive', 'maintenance' | Global visibility status |
| `microservice_endpoint` | STRING | Nullable | Base URL for the associated backend microservice |
| `settings` | JSON | Nullable | specialized config (e.g., commission_rates, required_documents) |
| `created_at` | TIMESTAMP | | |
| `updated_at` | TIMESTAMP | | |

### Table: `category_admins`
Links users to specific categories with administrative privileges.

| Column Name | Data Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT | Primary Key | |
| `user_id` | BIGINT | Foreign Key (users.id) | The admin user |
| `category_id` | BIGINT | Foreign Key (categories.id) | The managed category |
| `role_level` | STRING | 'admin', 'moderator' | Scope of access |
| `created_at` | TIMESTAMP | | |

---

## 2. API Endpoints

### Public / Client-Facing
- `GET /api/v1/categories`: List all active categories.
- `GET /api/v1/categories/{slug}`: Get details of a specific category.

### Super Admin (Protected)
- `POST /api/v1/admin/categories`: Create a new category.
- `PUT /api/v1/admin/categories/{id}`: Update metadata (name, icon, endpoint).
- `PATCH /api/v1/admin/categories/{id}/status`: Toggle enable/disable.
- `DELETE /api/v1/admin/categories/{id}`: Soft delete a category.
- `POST /api/v1/admin/categories/assign-admin`: Link a user as admin to a category.
- `GET /api/v1/admin/categories/{id}/audit`: View logs (audit) for this category.

---

## 3. Admin UI Flow

1.  **Dashboard Overview**: View Active vs Inactive categories and total Provider counts per category.
2.  **List View (Index)**:
    -   Table showing ID, Name, Status, Provider Count.
    -   Quick Actions: Toggle Status, Edit, Delete.
3.  **Create / Edit Form**:
    -   Inputs: Name, Slug (auto-generated), Description, Icon Picker.
    -   Microservice Configuration: Input Field for API Endpoint URL.
    -   Settings: JSON Editor or Form fields for Commission %.
4.  **Admin Assignment**:
    -   Select User -> Select Category -> Assign Role.

## 4. Implementation Details (Laravel)

- **Model**: `App\Models\Category`
- **Traits**: `HasFactory`, `SoftDeletes`
- **Relationships**:
    -   `category.admins()` -> `hasMany(CategoryAdmin)` or `belongsToMany(User)`
    -   `category.services()` -> `hasMany(Service)` (if Services model exists)

---
*Created by Antigravity Design Agent*
