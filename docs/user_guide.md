
# 📘 User Documentation – User Panel Application

## 📋 Table of Contents
- [Introduction](#introduction)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Usage Guide](#usage-guide)
- [User Panel Features](#user-panel-features)
- [Account Management](#account-management)
- [Troubleshooting](#troubleshooting)
- [Support](#support)

---

## 🧭 Introduction

This application is a user panel system built with Laravel and Inertia.js, allowing users to manage their profiles and admins to manage user roles and access.

---

## 💻 System Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- Docker & Laravel Sail (for local development)

---

## 🛠️ Installation

1. **Clone the Repository:**

```bash
git clone https://your-repo-url
cd projektPPZ
```

2. **Start the Docker Containers:**

```bash
./vendor/bin/sail up -d
```

3. **Run Migrations for Testing:**

```bash
./vendor/bin/sail artisan migrate:fresh --env=testing
```

4. **Access the Application:**

Visit `http://localhost` in your browser.

---

## 🚀 Usage Guide

### Login/Register
- Use the login or register forms to access the panel.
- Users must be authenticated to access most features.

### User Panel
- Go to `/user/panel` to view your personal data.
- Information shown: name, surname, email, and description.

---

## 👥 User Panel Features

- **Authenticated View** – Displays user data.
- **Guest Restrictions** – Guests cannot access the panel.
- **Dynamic Content** – User data rendered via Inertia.

---

## 🔐 Account Management

- Users can edit their name, email, and password.
- Admins can edit user roles and delete users.

---

## 🧯 Troubleshooting

### MySQL Connection Error
If tests fail due to MySQL connection:

- Make sure Sail is running:
```bash
./vendor/bin/sail up -d
```

- Ensure `.env.testing` uses `DB_HOST=mysql`

---

## 🆘 Support

If you encounter issues:
- Check Laravel logs in `storage/logs`
- Ask your instructor or TA
- Reach out to the team maintaining the project

---
