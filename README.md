# Laravel API using modern repository architecture design pattern with PHP Unit testing

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

`````

---

## 🔹 API Routes

**All API endpoints are versioned under `/api/v1/`.**  

| Method | Endpoint                  | Action           |
|--------|---------------------------|----------------|
| POST   | `/v1/item/create`      | Create item     |
| GET    | `/v1/items`            | List items      |
| GET    | `/v1/items/{id}`       | Show single item|
| PUT    | `/v1/items/{id}`       | Update item     |
| DELETE | `/v1/items/{id}`       | Delete item     |

**Headers for API requests:**

```text
Content-Type: application/json
Accept: application/json

```
## 🔹 API Flow Diagram

```
Client Request (POST /v1/items)
           │
           ▼
     ┌───────────────┐
     │   Controller  │  <- Handles HTTP & calls Service
     └───────────────┘
           │
           ▼
     ┌───────────────┐
     │     DTO       │  <- Validated, typed data
     └───────────────┘
           │
           ▼
     ┌───────────────┐
     │    Service    │  <- Business logic + Result (Ok/Err)
     └───────────────┘
           │
           ▼
     ┌───────────────┐
     │  Repository   │  <- DB operations only
     └───────────────┘
           │
           ▼
     ┌───────────────┐
     │     Model     │  <- Eloquent ORM
     └───────────────┘
           │
           ▼
      Response JSON
```

## 🔹 Example Request (Create Item)

```

POST /v1/item/create
Content-Type: application/json
Accept: application/json

{
  "name": "MacBook Pro",
  "description": "Laptop for developers",
  "price": 2500
}

```
###  Response (Success)

```
{
  "success": true,
  "message": "Item created successfully",
}

```

### Response (Error)

```
{
  "success": false,
  "code": "ITEM_CREATION_FAILED",
  "message": "Duplicate entry for name"
}

```

## 🔹 Project Structure

```

my-app/
├─ app/
│  ├─ Http/
│  │  └─ Controllers/Api/V1/Item/ItemController.php       # Handles HTTP requests and responses
│  ├─ DTO/Api/V1/ItemDTO.php                              # Data Transfer Object for validated input
│  ├─ Services/Api/V1/ItemService.php                     # Business logic and Result handling
│  ├─ Repositories/Interfaces/ItemRepositoryInterface.php # Interface defining repository methods
│  ├─ Repositories/ItemRepository.php                     # Concrete repository implementation for database
│  ├─ Models/Item.php                                     # Eloquent model representing the database table
├─ routes/api_v1.php                                      # API v1 routes

```

