# 🛒 Supermarket POS System

A comprehensive point-of-sale (POS) and inventory management system for supermarkets and retail stores. Built with Laravel MVC, MySQL, and TailwindCSS, it features a responsive interface that works on desktops, tablets, and mobile phones.

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-06B6D4?style=for-the-badge&logo=tailwind-css)
![License](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)

---

## ✨ Key Features

### 🛒 Point of Sale
- **Responsive POS Interface** – Works seamlessly on desktops, tablets, and mobile devices.
- **Barcode Scanning** – Supports external scanners and camera-based scanning (via Instascan).
- **Quick Product Search** – Search by name or barcode.
- **Dynamic Cart** – Add/remove items, adjust quantities, real‑time subtotal, tax, and total.
- **Tax & Discount** – Percentage‑based tax and fixed discount input.
- **Multiple Payment Methods** – Cash, card, mobile wallet.
- **Invoice Printing** – 80mm thermal printer friendly layout with automatic print dialog.
- **PDF Export** – Download invoices as PDF.

### 📦 Inventory & Products
- **Inventory Management** – Track stock quantities; sales decrement inventory without checking availability (allows negative stock).
- **Low Stock Alerts** – Dashboard shows products below minimum threshold.
- **Product Management** – Add, edit, delete products with image upload, SKU, barcode, purchase/selling prices, expiry dates.
- **Profit Calculation** – Real-time profit margin display when adding/editing products.

### 💰 Expenses Management
- **Complete CRUD** – Add, edit, delete expenses with fields: name, amount, date, description.
- **Summary Dashboard** – View total, today, and monthly expenses at a glance.
- **Net Profit Integration** – Dashboard shows sales vs expenses to calculate net profit.
- **Responsive Layout** – Expense list table for desktop, card view for mobile.

### 📊 Reports & Dashboard
- **Dashboard Overview** – Today's sales count, revenue, low stock alerts.
- **Expense Summary** – Daily, weekly, monthly expense totals.
- **Recent Activity** – Latest expenses and sales displayed on dashboard.
- **Profit/Loss Visualization** – Color-coded net profit (green positive, red negative).

### 🧰 Admin & Security
- **Role-Based Access** – Admin and cashier roles (optional).
- **Soft Deletes** – Products are soft‑deleted to preserve order history.
- **User-Friendly Messages** – Success and error toasts for all actions.
- **RTL Support** – Full Arabic support with proper text direction.

---

## 🧰 Technologies Used

- **Backend:** Laravel 11 (PHP 8.2)
- **Database:** MySQL
- **Frontend:** Blade templates, TailwindCSS, Alpine.js, JavaScript (Axios)
- **Barcode Scanning:** [Instascan](https://github.com/schmich/instascan)
- **PDF Generation:** barryvdh/laravel-dompdf
- **Icons:** Font Awesome 6
- **UI Enhancements:** Alpine.js for modals, Tailwind CSS for responsive design

---

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js & NPM (optional, for asset compilation)
- Web server (Apache/Nginx) or Laravel's built‑in server

---

## 🔧 Installation

1. **Clone the repository**  
   ```bash
   git clone https://github.com/ALSHRIF67/supermarket_pos.git
   cd supermarket_pos
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Copy the environment file**
   ```bash
   cp .env.example .env
   ```
   Then edit `.env` with your database credentials:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=supermarket_pos
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders** (create tables and insert demo data)
   ```bash
   php artisan migrate --seed
   ```
   > **Note:** If you encounter a duplicate email error, run `php artisan migrate:fresh --seed` to reset everything.

6. **(Optional) Install and build frontend assets**
   ```bash
   npm install
   npm run build
   ```
   If you prefer not to use Vite, the templates already include CDN links for CSS and JS.

7. **Link storage** (for product images)
   ```bash
   php artisan storage:link
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```
   Open your browser at `http://127.0.0.1:8000`

---

## 🚀 Usage

### Dashboard
After starting the server, go to `/dashboard` to see:
- Today's sales summary
- Low stock alerts
- Net profit calculation (sales - expenses)
- Recent expenses and sales

### Point of Sale
From the navigation bar click **POS** or directly visit `/pos`.
- Search for products using the search bar or scroll through the product grid.
- Click on a product to add it to the cart (products can be added even if stock is zero).
- In the cart you can:
  - Adjust quantity.
  - Remove an item.
  - Enter tax (percentage) and discount (fixed amount).
  - Choose a payment method (Cash, Card, Wallet).
  - Add optional notes.
- Click **Print Invoice**.
  - The order will be saved to the database.
  - An invoice window will open and automatically trigger the print dialog.

### Expenses Management
- Navigate to **Expenses** from the sidebar.
- **Add New Expense** – Fill in name, amount, date, optional description.
- **View All Expenses** – Table with edit/delete actions.
- **Summary Cards** – Quick view of total, today's, and this month's expenses.
- **Delete Confirmation** – Modal confirmation to prevent accidental deletion.

### Product Management
- From the admin sidebar you can add, edit, and delete products, categories, and suppliers.
- **Add Product** – Form includes:
  - Product name, barcode, SKU, category, supplier.
  - Purchase price, selling price (profit margin calculated automatically).
  - Initial quantity, minimum stock alert, unit type.
  - Production/expiry dates, description, image upload.
- **Edit Product** – Same fields with pre-filled data.
- **Delete Product** – If a product is linked to existing orders, a friendly error message appears; otherwise it is soft‑deleted.

### Invoices
- Each invoice gets a unique number (e.g., `INV-1742434567890`).
- View an invoice again via `/pos/invoice/{id}`.

---

## 📡 API Endpoints (Optional)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/api/products` | List all products |
| GET    | `/api/products/{id}` | Show a single product |
| POST   | `/api/products` | Create a new product |
| PUT    | `/api/products/{id}` | Update a product |
| DELETE | `/api/products/{id}` | Delete a product |
| POST   | `/api/pos/order` | Create a new order (used internally) |

Most endpoints require authentication (can be enabled as needed).

---

## 🧪 Demo Data

After seeding, you'll have:

- **User:** admin@example.com / password (if authentication is enabled)
- **Category:** Beverages, Snacks
- **Supplier:** Pepsi Co.
- **Products:** Pepsi 500ml (selling price 1.00), Lays Chips (selling price 2.50)

---

## 🛠 Recent Enhancements

- **Expenses Management System** – Full CRUD with summary dashboard and net profit integration.
- **UI/UX Overhaul** – Responsive TailwindCSS layout, mobile‑friendly cards, improved tables.
- **Delete Confirmation Modal** – Replaces browser confirm() with a clean modal (Alpine.js).
- **Product Deletion Safety** – Check for existing orders before allowing deletion; error message shown.
- **Soft Deletes** – Products are soft‑deleted to preserve order history.
- **Validation** – Added `ProductStoreRequest` and `ProductUpdateRequest` with comprehensive rules.
- **Profit Calculation** – Real‑time display when entering purchase and selling prices.
- **RTL & Arabic Support** – Full right‑to‑left layout with Arabic labels and messages.

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/amazing-feature`).
3. Commit your changes (`git commit -m 'Add amazing feature'`).
4. Push to the branch (`git push origin feature/amazing-feature`).
5. Open a Pull Request.

---

## 📄 License

This project is open‑source software licensed under the MIT license.

---

## 🙏 Acknowledgements

- [Laravel](https://laravel.com/)
- [TailwindCSS](https://tailwindcss.com/)
- [Alpine.js](https://alpinejs.dev/)
- [Instascan](https://github.com/schmich/instascan)
- [Font Awesome](https://fontawesome.com/)
- [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)

Happy selling! 🛒