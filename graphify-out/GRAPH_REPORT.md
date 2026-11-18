# Graph Report - toko-online  (2026-11-18)

## Corpus Check
- Corpus is ~20,474 words - fits in a single context window. You may not need a graph.

## Summary
- 585 nodes · 903 edges · 86 communities (22 shown, 64 thin omitted)
- Extraction: 95% EXTRACTED · 5% INFERRED · 0% AMBIGUOUS · INFERRED: 45 edges (avg confidence: 0.83)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- AdminProductController.php: AdminDashboardContro
- README.md: AdminOrderController.php
- 2026_11_10_091000_create_orders_tables.php: 0001
- Module package.json
- Module docker-compose.yml
- Module CheckoutController.php
- Module LoginRequest.php
- PasswordConfirmationTest.php: Illuminate\Foundat
- OrderItem.php: Category.php
- Module User.php
- Product.php: ProductController
- PasswordResetTest.php: Illuminate\Auth\Notificat
- Module CartController.php
- Module ReviewController.php
- Module composer.json
- composer.json: scripts
- Module WishlistController.php
- app.php: bootstrap/app.php
- composer.json: require-dev
- README.md: Laravel 13.40 & PHP 8.3 Stack
- AGENTS.md: Laravel Boost Guidelines (AGENTS.md)
- composer.json: pestphp/pest-plugin
- composer.json: require
- Module UserFactory.php
- EmailVerificationTest.php: Illuminate\Support\Fa
- Module ProfileTest.php
- Module AppServiceProvider.php
- Module AuthenticationTest.php
- composer.json: autoload
- PasswordUpdateTest.php: Illuminate\Support\Facad
- ExampleTest.php: PHPUnit\Framework\TestCase
- edit.blade.php: profile.partials.delete-user-for
- composer.json: autoload-dev
- composer.json: extra
- create.blade.php: products/create.blade.php
- edit.blade.php: products/edit.blade.php
- dashboard.blade.php: admin/dashboard.blade.php
- index.blade.php: admin/orders/index.blade.php
- index.blade.php: admin/products/index.blade.php
- index.blade.php: cart/index.blade.php
- create.blade.php: checkout/create.blade.php
- index.blade.php: views/orders/index.blade.php
- Module pay.blade.php
- show.blade.php: orders/show.blade.php
- index.blade.php: views/products/index.blade.php
- show.blade.php: products/show.blade.php
- index.blade.php: wishlist/index.blade.php

## God Nodes (most connected - your core abstractions)
1. `Controller` - 35 edges
2. `Order` - 25 edges
3. `Product` - 25 edges
4. `User` - 21 edges
5. `TestCase` - 18 edges
6. `Nusantara Shop E-Commerce Application` - 15 edges
7. `AdminProductController` - 12 edges
8. `LoginRequest` - 9 edges
9. `MidtransService` - 9 edges
10. `scripts` - 9 edges

## Surprising Connections (you probably didn't know these)
- `Integer Price Storage (price_cents in Rupiah)` --conceptually_related_to--> `Product`  [INFERRED]
  README.md → app/Models/Product.php
- `Laravel Breeze Email/Password Authentication` --references--> `AuthenticatedSessionController`  [INFERRED]
  README.md → app/Http/Controllers/Auth/AuthenticatedSessionController.php
- `Laravel Breeze Email/Password Authentication` --references--> `RegisteredUserController`  [INFERRED]
  README.md → app/Http/Controllers/Auth/RegisteredUserController.php
- `Product Catalog (Search, Category Filter, Sorting)` --references--> `Category`  [INFERRED]
  README.md → app/Models/Category.php
- `Buyer Product Reviews` --references--> `Review`  [INFERRED]
  README.md → app/Models/Review.php

## Import Cycles
- None detected.

## Communities (86 total, 64 thin omitted)

### Community 0 - "AdminProductController.php: AdminDashboardContro"
Cohesion: 0.06
Nodes (18): AdminDashboardController, AdminProductController, AuthenticatedSessionController, ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, GoogleAuthController, {closure#1}() (+10 more)

### Community 1 - "README.md: AdminOrderController.php"
Cohesion: 0.07
Nodes (17): AdminOrderController, OrderController, PaymentController, Order, MidtransService, {closure#1}(), NotificationService, Admin Panel (/admin, is_admin = true) (+9 more)

### Community 2 - "2026_11_10_091000_create_orders_tables.php: 0001"
Cohesion: 0.07
Nodes (22): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+14 more)

### Community 3 - "Module package.json"
Cohesion: 0.08
Nodes (28): devDependencies, alpinejs@^3.4.2, autoprefixer@^10.4.2, concurrently@^10.0.3, laravel-vite-plugin@^3.1, postcss@^8.4.31, tailwindcss@^3.1.0, @tailwindcss/forms@^0.5.2 (+20 more)

### Community 4 - "Module docker-compose.yml"
Cohesion: 0.07
Nodes (26): build, container_name, env_file, environment, expose, networks, restart, volumes (+18 more)

### Community 5 - "Module CheckoutController.php"
Cohesion: 0.11
Nodes (4): CheckoutController, {closure#3}(), DatabaseSeeder, ProductSeeder

### Community 7 - "PasswordConfirmationTest.php: Illuminate\Foundat"
Cohesion: 0.20
Nodes (4): PasswordConfirmationTest, RegistrationTest, ExampleTest, TestCase

### Community 8 - "OrderItem.php: Category.php"
Cohesion: 0.21
Nodes (3): Category, OrderItem, Review

### Community 10 - "Product.php: ProductController"
Cohesion: 0.24
Nodes (3): ProductController, Product, Product Catalog (Search, Category Filter, Sorting)

### Community 14 - "Module composer.json"
Cohesion: 0.22
Nodes (8): description, keywords, license, minimum-stability, name, prefer-stable, $schema, type

### Community 15 - "composer.json: scripts"
Cohesion: 0.22
Nodes (9): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+1 more)

### Community 17 - "Module WishlistController.php"
Cohesion: 0.29
Nodes (3): WishlistController, WishlistItem, Product Wishlist

### Community 18 - "app.php: bootstrap/app.php"
Cohesion: 0.32
Nodes (3): {closure#1}(), {closure#2}(), {closure#3}()

### Community 19 - "composer.json: require-dev"
Cohesion: 0.25
Nodes (8): require-dev, fakerphp/faker, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision, phpunit/phpunit

### Community 20 - "README.md: Laravel 13.40 & PHP 8.3 Stack"
Cohesion: 0.29
Nodes (8): Laravel 13.40 & PHP 8.3 Stack, Laravel Breeze Email/Password Authentication, Nusantara Shop E-Commerce Application, Integer Price Storage (price_cents in Rupiah), SQLite Database (database.sqlite), Tailwind CSS Styling, Laravel Test Suite (php artisan test), Robots.txt Open Crawler Policy (User-agent: *)

### Community 21 - "AGENTS.md: Laravel Boost Guidelines (AGENTS.md)"
Cohesion: 0.29
Nodes (7): Laravel Boost Guidelines (AGENTS.md), Laravel Boost Agent Setup (boost:install), php.new Cross-Platform PHP Installer, PHP 8.5 & Composer Prerequisites, Laravel Boost Guidelines (CLAUDE.md), Laravel Boost Agent Setup (CLAUDE.md), PHP 8.5 & Composer Prerequisites (CLAUDE.md)

### Community 23 - "composer.json: pestphp/pest-plugin"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 24 - "composer.json: require"
Cohesion: 0.29
Nodes (7): require, laravel/breeze, laravel/framework, laravel/socialite, laravel/tinker, midtrans/midtrans-php, php

### Community 30 - "composer.json: autoload"
Cohesion: 0.40
Nodes (5): autoload, psr-4, App\\, Database\\Factories\\, Database\\Seeders\\

### Community 35 - "edit.blade.php: profile.partials.delete-user-for"
Cohesion: 0.50
Nodes (3): profile.partials.delete-user-form, profile.partials.update-password-form, profile.partials.update-profile-information-form

### Community 37 - "composer.json: autoload-dev"
Cohesion: 0.67
Nodes (3): autoload-dev, psr-4, Tests\\

### Community 38 - "composer.json: extra"
Cohesion: 0.67
Nodes (3): extra, laravel, dont-discover

## Knowledge Gaps
- **24 isolated node(s):** `layouts.app`, `layouts.app`, `layouts.app`, `admin.products._form`, `layouts.app` (+19 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 260 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **64 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `User` connect `Module User.php` to `AdminProductController.php: AdminDashboardContro`, `PasswordUpdateTest.php: Illuminate\Support\Facad`, `Module LoginRequest.php`, `PasswordConfirmationTest.php: Illuminate\Foundat`, `PasswordResetTest.php: Illuminate\Auth\Notificat`, `Module UserFactory.php`, `EmailVerificationTest.php: Illuminate\Support\Fa`, `Module ProfileTest.php`, `Module AuthenticationTest.php`?**
  _High betweenness centrality (0.103) - this node is a cross-community bridge._
- **Are the 2 inferred relationships involving `Product` (e.g. with `Integer Price Storage (price_cents in Rupiah)` and `Product Catalog (Search, Category Filter, Sorting)`) actually correct?**
  _`Product` has 2 INFERRED edges - model-reasoned connections that need verification._
- **What connects `layouts.app`, `layouts.app`, `layouts.app` to the rest of the system?**
  _24 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `AdminProductController.php: AdminDashboardContro` be split into smaller, more focused modules?**
  _Cohesion score 0.05630834086118639 - nodes in this community are weakly interconnected._
- **Why does `Controller` connect `AdminProductController.php: AdminDashboardContro` to `README.md: AdminOrderController.php`, `Module CheckoutController.php`, `Product.php: ProductController`, `Module CartController.php`, `Module ReviewController.php`, `Module WishlistController.php`?**
  _High betweenness centrality (0.060) - this node is a cross-community bridge._
- **Should `README.md: AdminOrderController.php` be split into smaller, more focused modules?**
  _Cohesion score 0.06568832983927324 - nodes in this community are weakly interconnected._
- **Why does `Order` connect `README.md: AdminOrderController.php` to `AdminProductController.php: AdminDashboardContro`, `Module CheckoutController.php`, `OrderItem.php: Category.php`, `Module ReviewController.php`, `Product.php: Order.php`?**
  _High betweenness centrality (0.051) - this node is a cross-community bridge._