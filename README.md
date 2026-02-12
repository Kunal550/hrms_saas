# HRMS SaaS - Laravel Project

A mini Human Resource Management System (HRMS) built with **Laravel 10** for SaaS companies.  
Supports multi-company architecture, role-based access (Admin / Employee), and modules for Employee Management, Attendance, and Leave Management.

---

## Features

- Admin / Employee roles
- Employee Management (Add/List)
- Attendance Management (Clock In / Clock Out)
- Leave Management (Apply / Approve / Reject)
- SaaS-ready multi-company support (`company_id`)
- Blade UI with Bootstrap
- Validation & error handling
- Deployment-ready structure

---

## Requirements

- PHP >= 8.1
- MySQL
- Composer
- Node.js & npm
- Git

---

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/Kunal550/hrms_saas.git
cd hrms_saas

Run migrations and seeders

## RUN this on terminal
php artisan serve & npm run dev

# Open in browser
http://127.0.0.1:8000

# Default Admin Credentials
Email: admin@example.com
Password: password

# Admin can add multiple employees dynamically. Employees can log in and use Attendance & Leave modules.

