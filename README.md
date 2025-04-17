# Mini Inventory Management System API

A Laravel-based REST API for managing inventory with user authentication and multi-tenancy.

## Requirements
- PHP >= 8.1
- Composer
- MySQL or any supported database
- Node.js (optional for Swagger)

## Setup Instructions
1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd inventory-management-api

2. **Install Dependencies**

composer instal

3. **Configure Environment**

Copy .env.example to .env:

cp .env.example .env


Update .env with your database credentials and run:

php artisan key:generate
php artisan jwt:secret

4. **Run Migrations**

5.**php artisan migrate**

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



GET /api/products/statistics - Get inventory statistics



Categories:


GET /api/categories - List categories



POST /api/categories - Create a category



GET /api/categories/{id} - Show a category



PUT /api/categories/{id} - Update a category



DELETE /api/categories/{id} - Delete a category

7. ## Swagger Documentation
- use this postman link for the api documentation 
https://documenter.getpostman.com/view/15373925/2sB2cd3xWx