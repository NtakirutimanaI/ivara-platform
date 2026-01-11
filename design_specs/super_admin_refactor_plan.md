# Super Admin Architecture Refactor Plan - IVARA Platform

## Objective
Establish a professional, enterprise-level Super Admin interface for managing 9 independent service categories using a single, reusable, and scalable architecture.

## Section 1: UI Layout & Component Strategy

### 1.1 Unified Layout Structure
Instead of ad-hoc views for each page, we will enforce a strict layout inheritance:
-   **Master Layout:** `layouts.app` (Handles Sidebar, Topbar, Flash Messages).
-   **Context Wrapper:** `layouts.category_context` (Optional) - A wrapper that validates the specific category slug and provides category-specific breadcrumbs/header stats automatically.

### 1.2 Reusable Blade Components
We will replace hardcoded HTML with standardized Blade Components to ensure consistency across all 9 categories.

| Component | usage |
| :--- | :--- |
| `<x-admin-header title="" subtitle="" :actions="[]" />` | Standardized page header with action buttons. |
| `<x-admin-kpi-grid :metrics="[]" />` | Responsive 4-column KPI grid (Bootstrap `col-xl-3`). |
| `<x-admin-card title="" icon="">...</x-admin-card>` | The standard glass/white card container. |
| `<x-admin-table :headers="[]" :rows="[]" />` | Standardized data table with pagination and status badges. |
| `<x-status-badge status="" />` | Consistent coloring for Active/Inactive/Pending. |

## Section 2: Functional Data Flow

### 2.1 Category Context Pattern
All category-specific routes will follow the pattern:
`GET /super_admin/categories/{category_slug}/{module}`

-   **Middleware:** A middleware `CheckCategoryExists` will run on this group to validate the slug and share the `$category` model globally with all views.
-   **Controller:** `CategoryModuleController` will handle sub-modules (Services, Providers) dynamically based on the slug.

### 2.2 Backend API Connection
-   **Routing:** `routes/modules/super_admin.php` will be organized into a 'Category Context' group.
-   **Data Fetching:** Controllers will scope queries by the category.
    -   *Example:* `Service::where('category_slug', $slug)->get()`

## Section 3: Role-Based Access Control (RBAC)
-   **Policies:** Use Laravel Policies (`CategoryPolicy`) to ensure only `super_admin` can perform sensitive actions (Delete, Pause).
-   **Blade Directives:** `@can('update', $category)` wrappers around "Edit" buttons.

---

## Proposed Roadmap (Step-by-Step)

1.  **Approval Phase:** Review this plan.
2.  **Phase 1 (Foundation):** Create the Reusable Blade Components (`resources/views/components/admin/...`).
3.  **Phase 2 (Dashboard):** Refactor `categories.show` to use these components (proving the layout).
4.  **Phase 3 (Sub-Modules):** Implement the Services and Providers lists using the dynamic category context.

*Pending Approval to proceed to Phase 1.*
