# Student Security System (SSS)

A comprehensive PHP & MySQL web application designed for schools and colleges to manage students, parents, teachers, staff, ID cards with QR codes, attendance tracking, and leave management.

## ⚡ Quick Start (Vercel)

1. Push this project to GitHub.
2. Import the repository into [Vercel](https://vercel.com).
3. Connect your free cloud MySQL database (TiDB Cloud / Aiven) by setting environment variables (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `DB_PORT`).
4. Click **Deploy**!

## 🐳 Quick Start (Docker)

Deploy locally or to VPS with a single command:

```bash
docker compose up -d --build
```

- **Application URL**: [http://localhost:8080](http://localhost:8080)
- **phpMyAdmin URL**: [http://localhost:8081](http://localhost:8081)

## 🔑 Default Login Accounts

| Role | Email | Password |
|---|---|---|
| Admin | `admin@admin.com` | `admin123` |
| Teacher | `teacher@teacher.com` | `teacher123` |
| Staff | `staff@staff.com` | `staff123` |
| Parent | `parent@parent.com` | `parent123` |

For detailed instructions on deploying to **cPanel**, **Linux VPS (LAMP)**, **XAMPP/WAMP**, or **Cloud Providers**, refer to [DEPLOYMENT.md](DEPLOYMENT.md).
