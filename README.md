# Backend Demo (Laravel + MySQL)

A simple **User CRUD REST API** built with Laravel 11 and MySQL.  
Prepared as a backend development demo project, including database caching and clean migration-based setup.

---

## 🚀 Installation

### Requirements
- PHP 8.2+
- Composer
- MySQL (local or via Docker/XAMPP)

### Setup
```bash
**```# Clone the repo
git clone https://github.com/yigitcihat/backend-demo-laravel.git
cd backend-demo-laravel

**```# Copy environment file
cp .env.example .env
Configure DB in .env (example)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=backend_demo
DB_USERNAME=root
DB_PASSWORD=
```
Generate app key
```
php artisan key:generate
```
Run migrations
```
php artisan migrate
```
Start development server
```
php artisan serve
```


Server will run on:
👉 http://127.0.0.1:8000

🔗 API Endpoints
List users

```
GET /api/users
```

Create user
```
POST /api/users
Content-Type: application/json


{
  "name": "Ada",
  "email": "ada@example.com"
}
```
Get single user
```
GET /api/users/{id}
```
Update user
```
PUT /api/users/{id}
Content-Type: application/json

{
  "name": "Ada Lovelace"
}
```
Delete user
```
DELETE /api/users/{id}
```
🗄️ Caching

GET /api/users responses are cached (database driver by default).

Cache is invalidated automatically when users are created, updated, or deleted.

Switch .env to Redis for production caching.

🛠️ Stack

-Laravel 11

-MySQL

-Eloquent ORM

-Database/Redis cache

📌 Notes

-Password field is currently nullable, only name and email are required.

-Authentication can be added later by enabling hashed password in the model and controller.
