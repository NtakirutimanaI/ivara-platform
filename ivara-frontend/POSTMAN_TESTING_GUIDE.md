# 🧪 Postman Testing Guide
## IVARA Platform - User Management API

## 📥 Step 1: Import the Postman Collection

### Option A: Import from File
1. Open **Postman**
2. Click **Import** (top left)
3. Click **Upload Files**
4. Select `postman_collection.json` from the project root
5. Click **Import**

### Option B: Import from Raw JSON
1. Open **Postman**
2. Click **Import** (top left)
3. Click **Raw text**
4. Copy and paste the entire content of `postman_collection.json`
5. Click **Continue** → **Import**

---

## ⚙️ Step 2: Configure Environment (Optional but Recommended)

### Create a New Environment:
1. Click the **Environments** icon (left sidebar)
2. Click **+** to create a new environment
3. Name it: `IVARA Local`
4. Add this variable:
   - **Variable:** `base_url`
   - **Initial Value:** `http://127.0.0.1:8000/api`
   - **Current Value:** `http://127.0.0.1:8000/api`
5. Click **Save**
6. Select **IVARA Local** from the environment dropdown (top right)

---

## 🧪 Step 3: Test the API Endpoints

### ✅ Test 1: Get All Users

**Endpoint:** `GET /api/users`

1. Open the **"Get All Users"** request
2. Click **Send**

**Expected Response (200 OK):**
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
      "status": "active",
      "phone": "",
      "country_code": "",
      "location": null,
      "created_at": "2025-12-26T00:18:31.000000Z",
      "updated_at": "2025-12-26T00:18:31.000000Z"
    }
  ],
  "count": 1
}
```

✅ **Success Criteria:**
- Status code: `200 OK`
- Response has `success: true`
- `data` array contains at least 1 user (the admin)
- `count` equals the number of users

---

### ✅ Test 2: Get User by ID

**Endpoint:** `GET /api/users/1`

1. Open the **"Get User by ID"** request
2. Click **Send**

**Expected Response (200 OK):**
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

✅ **Success Criteria:**
- Status code: `200 OK`
- Response has `success: true`
- `data` object contains the user details

**Test with Invalid ID:**
1. Change the URL to `/api/users/999`
2. Click **Send**

**Expected Response (404 Not Found):**
```json
{
  "success": false,
  "message": "User not found"
}
```

---

### ✅ Test 3: Create a New User

**Endpoint:** `POST /api/users`

1. Open the **"Create User"** request
2. Review the JSON body (already filled with example data)
3. **Important:** Change the email to something unique (e.g., `john.doe.test@example.com`)
4. Click **Send**

**Expected Response (201 Created):**
```json
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "id": 2,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "username": "johndoe",
    "role": "user",
    "status": "active",
    "phone": "+1234567890",
    "country_code": "+1",
    "location": "New York, USA",
    "created_at": "2025-12-26T00:30:00.000000Z",
    "updated_at": "2025-12-26T00:30:00.000000Z"
  }
}
```

✅ **Success Criteria:**
- Status code: `201 Created`
- Response has `success: true`
- `data` object contains the newly created user with an `id`

**Test Validation Errors:**
1. Remove the `email` field from the body
2. Click **Send**

**Expected Response (422 Unprocessable Entity):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": [
      "The email field is required."
    ]
  }
}
```

**Test Duplicate Email:**
1. Try to create another user with the same email
2. Click **Send**

**Expected Response (422 Unprocessable Entity):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}
```

---

### ✅ Test 4: Update User

**Endpoint:** `PUT /api/users/2`

1. Open the **"Update User"** request
2. Make sure the user ID in the URL matches a user you created (e.g., `/api/users/2`)
3. Modify the JSON body as needed
4. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "message": "User updated successfully",
  "data": {
    "id": 2,
    "name": "John Doe Updated",
    "email": "john.doe@example.com",
    "role": "manager",
    "status": "active",
    "location": "San Francisco, USA"
  }
}
```

✅ **Success Criteria:**
- Status code: `200 OK`
- Response has `success: true`
- `data` object shows the updated values

---

### ✅ Test 5: Get Users by Role

**Endpoint:** `GET /api/users/role/admin`

1. Open the **"Get Users by Role"** request
2. Click **Send**

**Expected Response (200 OK):**
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

**Test Different Roles:**
- Change URL to `/api/users/role/manager`
- Change URL to `/api/users/role/user`

✅ **Success Criteria:**
- Status code: `200 OK`
- `data` array contains only users with the specified role

---

### ✅ Test 6: Get User Statistics

**Endpoint:** `GET /api/users/statistics`

1. Open the **"Get User Statistics"** request
2. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "total": 2,
    "by_role": {
      "admin": 1,
      "user": 1
    },
    "by_status": {
      "active": 2
    }
  }
}
```

✅ **Success Criteria:**
- Status code: `200 OK`
- `data.total` matches the total number of users
- `data.by_role` shows count for each role
- `data.by_status` shows count for each status

---

### ✅ Test 7: Search Users

**Endpoint:** `GET /api/users/search?q=john`

1. Open the **"Search Users"** request
2. Modify the `q` parameter to search for something (e.g., `john`, `admin`, `example.com`)
3. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "data": [
    {
      "id": 2,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "username": "johndoe"
    }
  ],
  "count": 1
}
```

✅ **Success Criteria:**
- Status code: `200 OK`
- `data` array contains users matching the search query

**Test with No Results:**
1. Change `q` to something that doesn't exist (e.g., `q=nonexistent`)
2. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "data": [],
  "count": 0
}
```

---

### ✅ Test 8: Filter Users

**Endpoint:** `GET /api/users?role=admin&status=active`

1. Open the **"Get All Users (Filtered)"** request
2. Modify the query parameters as needed
3. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@gmail.com",
      "role": "admin",
      "status": "active"
    }
  ],
  "count": 1
}
```

**Test Different Filters:**
- `?role=user`
- `?status=active`
- `?role=manager&status=active`
- `?search=john`

---

### ✅ Test 9: Delete User

**Endpoint:** `DELETE /api/users/2`

1. Open the **"Delete User"** request
2. Make sure the user ID in the URL matches a user you want to delete
3. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "message": "User deleted successfully"
}
```

✅ **Success Criteria:**
- Status code: `200 OK`
- Response has `success: true`

**Verify Deletion:**
1. Try to get the deleted user: `GET /api/users/2`
2. Should return `404 Not Found`

---

### ✅ Test 10: Create an Order

**Endpoint:** `POST /api/orders`

1. Open the **"Create Order"** request
2. Ensure `user_id` matches an existing user (e.g., 1)
3. Ensure `order_number` is unique
4. Click **Send**

**Expected Response (201 Created):**
```json
{
  "success": true,
  "message": "Order created successfully",
  "data": {
    "id": 1,
    "order_number": "ORD-2024-001",
    "status": "Pending"
  }
}
```

### ✅ Test 11: Get All Orders

**Endpoint:** `GET /api/orders`

1. Open the **"Get All Orders"** request
2. Click **Send**

**Expected Response (200 OK):**
```json
{
  "success": true,
  "data": [...],
  "count": 1
}
```

### ✅ Test 12: Update Order Status

**Endpoint:** `PUT /api/orders/1`

1. Open the **"Update Order"** request
2. Set body to `{"status": "Completed"}`
3. Click **Send**

---

## 📊 Complete Test Checklist

### ✅ Basic CRUD Operations:
- [ ] Get all users
- [ ] Get user by ID
- [ ] Create new user
- [ ] Update user (PUT)
- [ ] Update user (PATCH)
- [ ] Delete user

### ✅ Advanced Features:
- [ ] Get users by role
- [ ] Get user statistics
- [ ] Search users
- [ ] Filter users (role, status, search)

### ✅ Error Handling:
- [ ] Get non-existent user (404)
- [ ] Create user with missing required fields (422)
- [ ] Create user with duplicate email (422)
- [ ] Update non-existent user (404)
- [ ] Delete non-existent user (404)

### ✅ Edge Cases:
- [ ] Search with no results
- [ ] Filter with no matches
- [ ] Create user with minimal fields
- [ ] Update user with single field

---

## 🎯 Expected Test Results

### All Tests Should Pass:
- ✅ **Status Codes:** 200, 201, 404, 422, 500
- ✅ **Response Format:** Consistent JSON structure
- ✅ **Success Responses:** `{ "success": true, ... }`
- ✅ **Error Responses:** `{ "success": false, "message": "..." }`
- ✅ **Data Integrity:** Created/updated data persists
- ✅ **Validation:** Invalid data is rejected

---

## 🐛 Troubleshooting

### Issue: Connection Refused
**Solution:** Make sure the Laravel server is running:
```bash
php artisan serve
```

### Issue: 404 Not Found on All Endpoints
**Solution:** Clear route cache:
```bash
php artisan route:clear
php artisan config:clear
```

### Issue: 500 Internal Server Error
**Solution:** Check Laravel logs:
```bash
# View logs
cat storage/logs/laravel.log

# Or tail logs in real-time
tail -f storage/logs/laravel.log
```

### Issue: Validation Errors
**Solution:** Check the request body format:
- Content-Type header must be `application/json`
- Body must be valid JSON
- Required fields must be present

---

## 📝 Sample Test Scenarios

### Scenario 1: Create a Complete User Workflow
1. **Create** a new user (POST /users)
2. **Get** the user by ID (GET /users/{id})
3. **Update** the user's role (PUT /users/{id})
4. **Search** for the user (GET /users/search?q=...)
5. **Delete** the user (DELETE /users/{id})
6. **Verify** deletion (GET /users/{id} → 404)

### Scenario 2: Test User Roles
1. **Create** users with different roles (admin, manager, user)
2. **Get** users by role (GET /users/role/{role})
3. **Get** statistics (GET /users/statistics)
4. **Verify** counts match

### Scenario 3: Test Validation
1. **Try** to create user without email → 422
2. **Try** to create user with duplicate email → 422
3. **Try** to create user with short password → 422
4. **Try** to create user with invalid email → 422

---

## 🎉 Success Indicators

You'll know the API is working correctly when:
- ✅ All 12 requests in the collection return expected responses
- ✅ Created users appear in "Get All Users"
- ✅ Updated users show new values
- ✅ Deleted users return 404
- ✅ Statistics reflect actual user counts
- ✅ Search finds matching users
- ✅ Filters return correct subsets

---

## 📞 Next Steps

After testing with Postman:
1. ✅ Verify all endpoints work
2. ✅ Document any issues found
3. ✅ Continue development with confidence
4. ✅ When ready, switch to MongoDB (endpoints stay the same!)

---

**Happy Testing!** 🚀

If you encounter any issues, check:
- Laravel logs: `storage/logs/laravel.log`
- Server is running: `php artisan serve`
- Database connection: `.env` file
