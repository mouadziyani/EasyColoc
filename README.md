# EasyColoc
**EasyColoc** is a Laravel 12 web app that makes shared housing finances effortless, transparent, and fair.

## Project Overview
Roommates split rent, groceries, utilities, and one-off costs. EasyColoc centralizes those expenses, calculates balances automatically, and records settlements so everyone knows exactly who owes whom and why.

## Core Features
| Feature | Description |
| --- | --- |
| ?? **User Authentication** | Secure registration, login, and session management. |
| ?? **Colocation Creation & Joining** | Create a housing group or join one instantly. |
| ?? **Expense Logging** | Record shared expenses with categories and clear ownership. |
| ?? **Automated Balance Calculation** | Live balance computation for each roommate. |
| ?? **Debt Settlement (sender_id/receiver_id)** | Explicit payer/payee tracking to close debts cleanly. |

## Technology Stack
| Layer | Technology |
| --- | --- |
| Backend | PHP 8.x, Laravel 12 |
| Frontend | Tailwind CSS (Modern Card & Grid UI), Alpine.js |
| Database | MySQL |

## Installation Guide
### Prerequisites
- PHP 8.x
- Composer
- Node.js + npm
- MySQL

### Setup
```bash
git clone git@github.com:mouadziyani/EasyColoc.git
cd EasyColoc
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### Configure Environment
Update `.env` with your database credentials:
```
DB_DATABASE=easycoloc
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### Migrate Database
```bash
php artisan migrate
```

### Run the App
```bash
npm run dev
php artisan serve
```

## Database Architecture
- **Users** belong to a single **Colocation**.
- **Colocations** have many **Users**, **Expenses**, and **Payments**.
- **Expenses** are created by a **User** and linked to a **Colocation** with a category and amount.
- **Payments** record settlements using `sender_id` (payer) and `receiver_id` (payee).

## UI/UX Philosophy
EasyColoc embraces a **Modern Aesthetic** with **rounded-3xl corners**, **soft shadows**, and **dynamic grid layouts**. A card-based layout keeps data readable and calm, while responsive grids make balances and recent expenses easy to scan at a glance.

## License
MIT
