# MongoDB Migration Plan
# From MySQL to MongoDB for Laravel Frontend Authentication

## Current Status
- ✅ Laravel frontend using MySQL for authentication
- ✅ Node.js microservice using MongoDB Atlas
- ❌ PHP MongoDB extension not installed

## Migration Steps

### Phase 1: Install MongoDB Extension (MANUAL - You need to do this)

1. **Download the Extension**
   - Go to: https://windows.php.net/downloads/pecl/releases/mongodb/
   - Download: `php_mongodb-8.3-ts-x64.dll` (latest version)
   - Save to your Downloads folder

2. **Run the Installation Script**
   ```powershell
   # Open PowerShell as Administrator
   # Navigate to the project folder
   cd "a:/MAKE IT SOLUTIONS ACTIONS/Projects/ivara-platform/ivara-frontend"
   
   # Run the installation script
   .\install-mongodb-extension.ps1
   ```

3. **Verify Installation**
   ```powershell
   # Close and reopen PowerShell
   php -m | findstr mongodb
   # You should see: mongodb
   ```

### Phase 2: Install Laravel MongoDB Package (AUTOMATED)

Once the extension is installed, I will run:

```powershell
composer require mongodb/laravel-mongodb:^3.9
```

### Phase 3: Update Configuration Files (AUTOMATED)

I will update these files:

1. **.env**
   ```env
   DB_CONNECTION=mongodb
   DB_DATABASE=ivara_platform
   DB_USERNAME=admin
   DB_PASSWORD=Admin123@
   DB_AUTHENTICATION_DATABASE=admin
   DB_URI=mongodb+srv://admin:Admin123@cluster0.lkfwclx.mongodb.net/ivara_platform?retryWrites=true&w=majority
   ```

2. **config/database.php**
   ```php
   'default' => env('DB_CONNECTION', 'mongodb'),
   
   'connections' => [
       'mongodb' => [
           'driver' => 'mongodb',
           'dsn' => env('DB_URI'),
           'database' => env('DB_DATABASE', 'ivara_platform'),
       ],
   ],
   ```

3. **config/auth.php**
   ```php
   'providers' => [
       'users' => [
           'driver' => 'mongodb',
           'model' => App\Models\User::class,
       ],
   ],
   ```

4. **app/Models/User.php**
   ```php
   use MongoDB\Laravel\Auth\User as Authenticatable;
   
   class User extends Authenticatable
   {
       protected $connection = 'mongodb';
       protected $collection = 'users';
       // ... rest of the model
   }
   ```

### Phase 4: Migrate Data (AUTOMATED)

I will:
1. Export existing MySQL users
2. Seed them into MongoDB
3. Verify authentication works

### Phase 5: Clean Up (AUTOMATED)

I will:
1. Remove MySQL configuration
2. Delete MySQL database (optional)
3. Clear all Laravel caches
4. Restart the server

## Expected Result

After migration:
- ✅ Laravel frontend uses MongoDB Atlas for authentication
- ✅ Node.js microservice uses MongoDB Atlas for data
- ✅ Single database (MongoDB) for entire platform
- ✅ No SQL dependencies

## Rollback Plan

If something goes wrong:
1. Change `.env`: `DB_CONNECTION=mysql`
2. Run: `php artisan config:clear`
3. Restart server
4. MySQL data is still intact

## Your Action Required

**YOU MUST DO THIS FIRST:**

1. Download `php_mongodb-8.3-ts-x64.dll` from:
   https://windows.php.net/downloads/pecl/releases/mongodb/

2. Run the installation script:
   ```powershell
   # As Administrator
   .\install-mongodb-extension.ps1
   ```

3. Verify it worked:
   ```powershell
   php -m | findstr mongodb
   ```

4. Tell me when it's done, and I'll handle the rest automatically!

---

## Quick Reference

**PHP Info:**
- Version: 8.3.24
- Thread Safety: Enabled (TS)
- Architecture: x64
- php.ini: C:\Program Files\php-8.3.24\php.ini

**Required DLL:**
- Name: php_mongodb-8.3-ts-x64.dll
- Destination: C:\Program Files\php-8.3.24\ext\php_mongodb.dll

**MongoDB Atlas:**
- Connection: mongodb+srv://admin:Admin123@cluster0.lkfwclx.mongodb.net/ivara_platform
- Database: ivara_platform
- Collection: users
