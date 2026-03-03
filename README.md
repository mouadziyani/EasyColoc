# EasyColoc
**EasyColoc** is a Laravel-based web application for managing colocation (shared housing) expenses and settlements with clarity and fairness.

## Project Overview
EasyColoc helps roommates track shared costs like rent, groceries, and bills, automatically calculates balances, and streamlines debt settlement so everyone knows who owes whom.

## Core Features
| Feature | Description |
| --- | --- |
| ?? **User Authentication** | Secure sign up, login, and session management for roommates. |
| ?? **Colocation Creation & Joining** | Create a shared housing group or join an existing one. |
| ?? **Expense Logging** | Record expenses with categories (rent, utilities, groceries, etc.). |
| ?? **Automated Balance Calculation** | Real-time calculation of each roommate’s balance. |
| ?? **Debt Settlement (sender_id/receiver_id)** | Clear settlement workflow to record who pays whom. |

## Technology Stack
| Layer | Technology |
| --- | --- |
| Backend | PHP 8.x, Laravel 12 |
| Frontend | Tailwind CSS (Modern Card & Grid UI), Alpine.js |
| Database | MySQL |

## Installation Guide
```bash
git clone <your-repo-url>
cd easycoloc
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Update your database credentials in `.env`, then run:
```bash
php artisan migrate
```

Build assets and run the app:
```bash
npm run dev
php artisan serve
```

## Database Architecture
- **Users** belong to a **Colocation**.
- **Colocations** have many **Users**, **Expenses**, and **Payments**.
- **Expenses** are created by a **User** and linked to a **Colocation** with a category and amount.
- **Payments** represent settlements using `sender_id` (payer) and `receiver_id` (payee).

## UI/UX Philosophy
EasyColoc uses a **Modern Aesthetic** with **rounded-3xl corners**, **soft shadows**, and **dynamic grid layouts**. A card-based system keeps content readable and premium-feeling, while grid layouts help roommates scan balances and expenses quickly.

## License
MIT
