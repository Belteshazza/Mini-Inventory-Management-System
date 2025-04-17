# Mini Inventory Management System API

A Laravel-based REST API for managing inventory with user authentication and multi-tenancy.

## Requirements
- PHP >= 8.3
- Composer
- laaravel >= 11
- MySQL or any supported database
- RESTful JSON API

 ## Setup Instructions
 **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd inventorymanagement

# Initial Set Up

1. Install dependencies

```
composer install
```

2. Create .env file by running; create .env.example file manually if not found

```
cp .env.example .env
```

3. Update .env with your database details

```
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

4. Generate laravel application key

```
php artisan key:generate
```


Update .env with your database credentials and run:

```
php artisan jwt:secret
```

4. **Run Migrations**

```
php artisan migrate
```

Serve the Application:

php artisan serve


6. **Test the API**


Use Postman or cURL to test endpoints like:


POST http://localhost:8000/api/register



POST http://localhost:8000/api/login



GET http://localhost:8000/api/products



GET http://localhost:8000/api/products?category=electronics



GET http://localhost:8000/api/products/statistics

API Endpoints

Auth User:


POST /api/register - Register a new user



POST /api/login - Login and get JWT token



POST /api/logout - Logout (requires token)



Products:


GET /api/products - List products (supports ?category, ?quantity, ?price_min, ?price_max)



POST /api/products - Create a product



GET /api/products/{id} - Show a product



PUT /api/products/{id} - Update a product



DELETE /api/products/{id} - Delete a product




Categories:


GET /api/categories - List categories



POST /api/categories - Create a category



GET /api/categories/{id} - Show a category



PUT /api/categories/{id} - Update a category



DELETE /api/categories/{id} - Delete a category

7. ## Swagger Documentation
- Use this postman link for the api documentation as all the documentation can be found here 
https://documenter.getpostman.com/view/15373925/2sB2cd3xWx
