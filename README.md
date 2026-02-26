# Laravel API using modern repository architecture design pattern

A **Laravel 12 API project** demonstrating clean architecture using **Controller → DTO → Service → Repository/Interface → Model → Routes**.  
Designed for beginners to learn **OOP, layered architecture, and API best practices**.

---

## 🔹 Project Description

This project is a **template for building maintainable and scalable Laravel APIs**.  
It separates concerns into layers:

- **Controller**: Handles HTTP requests and responses.  
- **DTO (Data Transfer Object)**: Validates and types input data.  
- **Service**: Contains business logic and handles success/error using `prewk/result`.  
- **Repository / Interface**: Handles database operations; interface allows dependency injection.  
- **Model**: Eloquent ORM representing database tables.  
- **Routes**: Versioned API routes (`/api/v1/...`).

This architecture ensures your code is **clean, testable, and beginner-friendly**.

---

## 🔹 Installation

```bash

# 1️⃣ Clone the repository
git clone https://github.com/your-username/my-app-controller-dto-service-interface-implementation-model-route.git

# 2️⃣ Move into the project directory
cd my-app

# 3️⃣ Install PHP dependencies
composer install

# 4️⃣ Copy .env example
cp .env.example .env

# 5️⃣ Generate application key
php artisan key:generate

# 6️⃣ Run database migrations
php artisan migrate

# 7️⃣ Start the development server
php artisan serve 

