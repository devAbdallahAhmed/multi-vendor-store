#🛒 Multi Vendor Store - E-Commerce Platform

A full-featured multi vendor e-commerce platform built with Laravel, following clean architecture principles and MVC structure.
The system allows multiple vendors to sell their products on the same platform, with separate vendor dashboards, admin control, and a complete customer shopping experience.

🚀 This project was built completely from scratch using Laravel, including authentication, authorization, vendor management, and order workflows.
---

## 📌 Project Overview
Multi Vendor Store is a marketplace system that allows:
- Customers to browse products from multiple vendors
- Vendors to manage their own stores, products, and orders.
- Admins to control the entire platform, vendors, users, and settings.
-A complete shopping flow from browsing to checkout and payment.
  -Separation of roles (Customer / Vendor / Admin / Super Admin).
  
---

## 🛠️ Tech Stack

- *Laravel*
- *PHP (OOP & MVC)*
- *MySQL*
- *Blade Templates*
- *Stripe Integration* for payment handling, including redirect to Stripe payment gateway after booking
- *Session & Token-based Authentication & Authorization*
- *Service and Repository Pattern*
- *Pagination and File Upload Services*

---

## 🎯 Key Features

### 🎟️ Ticket Booking & Cinema Management
-Each vendor has a dedicated dashboard.
-Vendors can:
  -    Manage their products (CRUD).
  -  Upload product images.
  -  Cinemas
  -   Track orders and sales.
- Products from different vendors can exist in the same customer cart.


### 🛍️ Shopping & Orders System
- Add to cart functionality.
- Checkout process with order creation.
- Orders are split automatically per vendor.
- Order status tracking (Pending, Paid, Shipped, Completed).
- Stripe payment integration.

### 👥 User Management System
- Complete CRUD operations for users.
- Role-based access (Customer / Vendor / Admin / Super Admin).
- Block & Unblock users with reason tracking.
- Vendor approval system by Admin.
  
### 📂 File Upload System
- Centralized upload service.
- Supports single and multiple file uploads.
- Used for product images, vendor logos, and user profiles.
  
### 📑 Pagination
- Implemented using reusable pagination helpers.
- Applied to products, orders, vendors, and users listings.

---

### 🔐 Authentication & Authorization

### The system follows Area-based architecture:
- /Admin/ → Platform management.
- /Vendor/ → Vendor dashboard.
- /Customer/ → Shopping & account management.
  
###  Authentication System:
- Built using Laravel Breeze & Fortify.
- Includes:
  - User registration & login
  - Password reset with email verification
  - Profile management
  - Account deletion (Customers only)

### Role-based access using Gates & Policies:
- Customers can manage their accounts and orders.
- Vendors can manage only their own products and orders.
- Admins manage vendors, categories, and users.
- Regular users (Customers) can fully manage their accounts including profile picture updates and account deletion.
  
  
### Access Restrictions:
- Admin & Super Admin accounts cannot be deleted.
- Vendors can be suspended or approved only by Admin.
- Customers can fully manage their profiles and orders.

---

## 🧱 Project Architecture

app/
│
├── Http/                         # Presentation Layer
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── ProductController.php
│   │   │   ├── StoreController.php
│   │   │   └── TagController.php
│   │   │
│   │   ├── Vendor/
│   │   │   ├── ProductController.php
│   │   │   └── OrderController.php
│   │   │
│   │   ├── Front/
│   │   │   ├── HomeController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   └── ProfileController.php
│   │   │
│   │   ├── Api/
│   │   └── Auth/
│   │
│   ├── Requests/                # ViewModels (Validation)
│   │   ├── StoreProductRequest.php
│   │   ├── UpdateProductRequest.php
│   │   ├── StoreCategoryRequest.php
│   │   ├── UpdateCategoryRequest.php
│   │   ├── StoreStoreRequest.php
│   │   └── UpdateStoreRequest.php
│   │
│   └── Middleware/
│       ├── CheckUserType.php
│       ├── CheckApiToken.php
│       └── UpdateUserLastActive.php
│
├── Models/                      # Entities
│   ├── User.php
│   ├── Admin.php
│   ├── Store.php
│   ├── Product.php
│   ├── Category.php
│   ├── Tag.php
│   ├── Cart.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Payment.php
│   └── Profile.php
│
├── Services/                    # BLL
│   ├── Contracts/
│   │   ├── ProductServiceInterface.php
│   │   ├── CategoryServiceInterface.php
│   │   ├── OrderServiceInterface.php
│   │   ├── CartServiceInterface.php
│   │   ├── StoreServiceInterface.php
│   │   └── PaymentServiceInterface.php
│   │
│   └── Implementations/
│       ├── ProductService.php
│       ├── CategoryService.php
│       ├── OrderService.php
│       ├── CartService.php
│       ├── StoreService.php
│       └── PaymentService.php
│
├── Repositories/                # DAL
│   ├── Contracts/
│   │   ├── ProductRepositoryInterface.php
│   │   ├── CategoryRepositoryInterface.php
│   │   ├── OrderRepositoryInterface.php
│   │   ├── CartRepositoryInterface.php
│   │   ├── StoreRepositoryInterface.php
│   │   └── PaymentRepositoryInterface.php
│   │
│   └── Eloquent/
│       ├── ProductRepository.php
│       ├── CategoryRepository.php
│       ├── OrderRepository.php
│       ├── CartRepository.php
│       ├── StoreRepository.php
│       └── PaymentRepository.php
│
├── Enums/
│   ├── UserType.php        # Admin / Vendor / Customer
│   └── OrderStatus.php     # Pending / Paid / Shipped / Completed
│
├── Policies/
│   ├── ProductPolicy.php
│   ├── OrderPolicy.php
│   └── StorePolicy.php
│
├── Observers/
│   ├── OrderObserver.php
│   └── UserObserver.php
│
└── Providers/
    ├── RepositoryServiceProvider.php
    └── AppServiceProvider.php

