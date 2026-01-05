---
description: Add a new category route and sidebar menu entry
---

## Workflow: Add a New Category (Route + Sidebar)

1. **Create the route block**
   - Open `routes/web.php`.
   - Add a new route group for the category (replace `your-category` and controller as needed):
   ```php
   // routes/web.php
   use App\Modules\YourCategory\Controllers\YourController;

   Route::middleware([
       'web',
       'auth',
       'ivara_role:admin,manager,supervisor',
       'category_access:your-category',
   ])
   ->prefix('admin/your-category')
   ->name('admin.your-category.')
   ->group(function () {
       Route::get('/', [YourController::class, 'index'])
           ->name('index'); // /admin/your-category

       // Add additional routes here, e.g.:
       // Route::get('/services', [YourController::class, 'services'])
       //     ->name('services');
   });
   ```

2. **Add a sidebar entry**
   - Open `config/sidebar.php` (create it if it does not exist).
   - Append a new array entry for the menu item:
   ```php
   // config/sidebar.php
   return [
       // ... existing items ...
       [
           'label'      => 'Your Category',
           'icon'       => 'heroicon-o-cog', // choose any heroicon
           'route'      => 'admin.your-category.index',
           'middleware' => [
               'ivara_role:admin,manager,supervisor',
               'category_access:your-category',
           ],
       ],
   ];
   ```

3. **Clear Laravel caches** (so the new middleware alias and routes are loaded).
   // turbo
   ```bash
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   php artisan cache:clear
   ```

4. **(Optional) Restart the dev server** if you are using `php artisan serve`.
   // turbo
   ```bash
   # Stop the running server (Ctrl+C) and start it again
   php artisan serve
   ```

5. **Test the new menu**
   - Log in as a user with the appropriate role and category.
   - Verify the new link appears in the sidebar.
   - Click the link; it should load the controller action without a 403/404.
   - Test with a user lacking the role/category – the link should be hidden and direct access should be blocked.

---

**Notes**
- The `category_access` middleware expects the category slug (e.g., `technical-repair`). Ensure the slug you pass matches the value stored on the user model (`$user->category`).
- If you need to add more complex permissions, consider using Laravel Policies or Spatie's permission package alongside the middleware.
- Keep the sidebar configuration DRY by extracting the middleware‑check logic into a helper if the Blade file becomes large.
