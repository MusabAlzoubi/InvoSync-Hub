# 📦 InvoSync Hub – National E-Invoicing System (Jordan - JoFotara)

**InvoSync Hub** is a multi-tenant SaaS platform designed for Jordanian businesses to manage their invoicing, accounting, and government e-invoicing compliance through full integration with the Jordanian National E-Invoicing System (**JoFotara**).

---

## 🎯 Project Goals

- ✅ Seamless integration with Jordan's National E-Invoicing API (JoFotara)
- ✅ Full support for all invoice types: Standard, Simplified, Credit Notes
- ✅ Comprehensive customer/supplier management
- ✅ Multi-user and multi-role support (Admin, Accountant, Sales, Viewer, etc.)
- ✅ Modular structure with scalable service-based architecture
- ✅ Extensible to integrate Power Automate, Power BI, or any third-party systems

---

## 🏗️ Codebase Structure

### 📁 Controllers
Organized by domain context:

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/             # Manage companies, users, system configs
│   │   ├── Accountant/        # Manage invoices, customers, suppliers, payments
│   │   ├── API/               # API endpoints & integration points
│   │   ├── Webhook/           # Handle callbacks from JoFotara or third parties
│   │   └── Shared/            # Notifications, Reports, User profile
```

### 📁 Services
Contains business logic separated from controllers:

```
app/
└── Services/
    ├── InvoiceService.php
    ├── JoFotaraService.php
    ├── CustomerService.php
    ├── SupplierService.php
    ├── PaymentService.php
    └── WebhookService.php
```

### 📁 Models
Each model has its own migration and Eloquent relationships defined under `app/Models`.

---

## 🔐 Roles & Permissions

This project uses `spatie/laravel-permission` to manage roles and permissions.

### Available Roles:

| Role         | Description                                                  |
|--------------|--------------------------------------------------------------|
| `Super Admin`| Full system access including global settings                 |
| `Admin`      | Company-level admin: manages users, invoices, and settings   |
| `Accountant` | Handles financial operations: invoices, journals, payments   |
| `Sales`      | Creates and manages invoices only                            |
| `Viewer`     | Read-only access to assigned data                            |
| `Auditor`    | External/internal auditing access to reports and logs        |
| `API Client` | External system or integration user                          |

---

## ⚙️ Used Packages

| Package                             | Purpose                                 |
|-------------------------------------|-----------------------------------------|
| `laravel/breeze`                    | Authentication scaffolding              |
| `spatie/laravel-permission`         | Role and permission management          |
| `laravel/framework` (v10.x)         | Laravel core                            |
| `PHP 8.2`                           | Programming language                    |
| `MySQL 8+`                          | Database                                |
| `TailwindCSS`                       | Frontend styling (via Breeze)           |

---

## 🧾 Main Database Entities

- `invoices`, `invoice_items`, `invoice_documents`, `invoice_status_logs`
- `customers`, `suppliers`, `products`
- `payments`, `supplier_payments`, `expenses`
- `journals`, `journal_entries`, `accounts`
- `companies`, `users`, `notifications`, `audit_logs`
- `api_clients`, `webhook_logs`, `integration_errors`, `settings`

Each model has full Eloquent relationships and supports tenant scoping.

---

## 🧩 JoFotara Integration

This system is built to comply with JoFotara API specifications, including:

- ✅ Generating unique UUIDs, QR codes, and digital signatures
- ✅ Submitting invoices directly to the JoFotara API
- ✅ Logging integration responses (success/failure)
- ✅ Mapping full metadata for each invoice transaction
- ✅ Multi-company secure isolation

---

## 🧰 Setup Instructions (basic)

```bash
# Install dependencies
composer install
npm install && npm run dev

# Environment setup
cp .env.example .env
php artisan key:generate

# Run migrations & seed roles
php artisan migrate --seed

# Create storage symlink (if needed)
php artisan storage:link

# Start local server
php artisan serve
```

---

## 🧠 Future Roadmap

- Power BI / Power Automate integration
- Custom billing plans for multi-tenant SaaS
- Email/SMS invoice dispatch
- Periodic financial reports and dashboards
- Stripe or HyperPay integration for online payments
- Multi-language support (Arabic/English UI)

---

## 👨‍💻 Developer

**Musab Al-Zoubi**  
📧 musab.m.alzoubii@gmail.com  
🔗 [LinkedIn](https://www.linkedin.com/in/musab-al-zoubi)  
🔗 [GitHub](https://github.com/MusabAlzo3bi)

---

## 📄 License

This project is currently closed-source for commercial deployment and internal use.

---

> Current Version: `v0.1-alpha`  
> Last updated: `June 2025`