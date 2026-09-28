# Deployment Guide - Student Security System (SSS)

This project is fully prepared and packaged for deployment across multiple hosting environments: **Vercel**, **Docker**, **Linux VPS / LAMP**, **cPanel / Shared Hosting**, **XAMPP/WAMP**, and **Cloud Platforms (Railway, Render)**.

---

## ⚡ Option 0: Vercel Deployment (Serverless PHP)

Vercel is a serverless platform that deploys this PHP project using the pre-configured [vercel.json](file:///vercel.json).

> [!NOTE]
> Vercel hosts the web frontend and serverless PHP functions, but does **not** host MySQL databases. You need a free cloud MySQL database (e.g., **TiDB Cloud**, **Aiven**, or **Clever Cloud**) to connect to.

### Step 1: Get a Free Cloud MySQL Database
1. Go to [TiDB Cloud](https://tidbcloud.com/) or [Aiven](https://aiven.io/) and create a free MySQL database.
2. Open the SQL Editor / Web Console and import or execute the contents of [database.sql](file:///database.sql).
3. Note your database connection details:
   - **Host**: e.g., `gateway01.ap-southeast-1.prod.aws.tidbcloud.com`
   - **Port**: `4000` (or `3306`)
   - **User**: e.g., `xxxxxx.root`
   - **Password**: your password
   - **Database**: `sss`

### Step 2: Deploy to Vercel (Via GitHub - Recommended)
1. Push this project to a **GitHub** repository.
2. Go to [Vercel Dashboard](https://vercel.com/dashboard) and click **"Add New..."** > **"Project"**.
3. Import your GitHub repository.
4. Under **Environment Variables**, add the following:
   - `DB_HOST`: your cloud DB host
   - `DB_PORT`: `4000` (or `3306`)
   - `DB_NAME`: `sss`
   - `DB_USER`: your cloud DB username
   - `DB_PASS`: your cloud DB password
   - `DB_SSL`: `true`
5. Click **Deploy**. Vercel will build and launch your application!

### Alternative: Deploy via Vercel CLI
```bash
npx vercel
```
Follow the interactive prompts to log in, link your project, and set the environment variables.

---

## 🔑 Default Login Credentials

The initial database seed (`database.sql`) comes pre-loaded with testing accounts for each role:

| Role | Email | Password | Dashboard URL |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@admin.com` | `admin123` | `/admin/admin_dashboard.php` |
| **Teacher** | `teacher@teacher.com` | `teacher123` | `/teacher/teacher_dashboard.php` |
| **Staff** | `staff@staff.com` | `staff123` | `/staff/staff_dashboard.php` |
| **Parent** | `parent@parent.com` | `parent123` | `/parent/parent_dashboard.php` |

---

## Option 1: Docker Deployment (Recommended for Full Stack)

The project includes a ready-to-run [Dockerfile](file:///Dockerfile) and [docker-compose.yml](file:///docker-compose.yml) with automatic MariaDB database initialization.

### Prerequisites
- Docker Engine & Docker Compose installed.

### Steps:
1. Open terminal in the project root directory.
2. Run:
   ```bash
   docker compose up -d --build
   ```
3. Access services:
   - **Application**: `http://localhost:8080`
   - **phpMyAdmin (DB Manager)**: `http://localhost:8081` (Host: `db`, User: `root`, Password: `root_password` or `sss_user` / `sss_password`)
4. To stop:
   ```bash
   docker compose down
   ```

---

## Option 2: XAMPP / WAMP Local Deployment

### Steps:
1. Copy the project folder into your web root:
   - **XAMPP**: `C:\xampp\htdocs\sss\`
   - **WAMP**: `C:\wamp64\www\sss\`
2. Start **Apache** and **MySQL** from XAMPP / WAMP Control Panel.
3. Open `http://localhost/phpmyadmin/`:
   - Create a database named `sss` with collation `utf8mb4_unicode_ci`.
   - Click on `Import` and select the file [database.sql](file:///database.sql).
4. Verify your `.env` or [con.php](file:///con.php) settings (default is `localhost`, `root`, blank password, database `sss`).
5. Open your browser and navigate to:
   ```
   http://localhost/sss/index.php
   ```

---

## Option 3: Ubuntu / Debian Linux VPS (LAMP Stack)

### 1. Install Apache, MySQL / MariaDB, and PHP
```bash
sudo apt update
sudo apt install -y apache2 mariadb-server php php-mysql php-gd php-zip php-mbstring libapache2-mod-php
```

### 2. Configure Database
```bash
sudo mysql -u root
```
Run within MariaDB console:
```sql
CREATE DATABASE sss CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'sss_user'@'localhost' IDENTIFIED BY 'YourStrongPassword123!';
GRANT ALL PRIVILEGES ON sss.* TO 'sss_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```
Import schema:
```bash
mysql -u sss_user -p sss < /path/to/project/database.sql
```

### 3. Deploy Files & Set Permissions
```bash
sudo cp -r /path/to/project/* /var/www/html/sss/
sudo chown -R www-data:www-data /var/www/html/sss
sudo chmod -R 755 /var/www/html/sss
sudo chmod -R 775 /var/www/html/sss/assets/qr_img
sudo chmod -R 775 /var/www/html/sss/assets/image/student_photo
sudo chmod -R 775 /var/www/html/sss/assets/image/profile_image/parent
```

### 4. Create Production `.env`
In `/var/www/html/sss/.env`:
```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=sss
DB_USER=sss_user
DB_PASS=YourStrongPassword123!
APP_ENV=production
```

### 5. Enable Apache Rewrite & Restart
```bash
sudo a2enmod rewrite headers
sudo systemctl restart apache2
```

---

## Option 4: cPanel / Shared Hosting

1. **Upload Files**:
   - Zip the project and upload to `public_html/` (or a subdirectory) via File Manager or FTP.
   - Extract the files.
2. **Create MySQL Database**:
   - In cPanel, navigate to **MySQL Databases**.
   - Create a database (e.g. `cpaneluser_sss`).
   - Create a database user and assign full permissions to that database.
3. **Import SQL**:
   - Open **phpMyAdmin** from cPanel.
   - Select your new database and click **Import**.
   - Select [database.sql](file:///database.sql) and execute.
4. **Configure Database Connection**:
   - Create or edit `.env` in the root folder:
     ```env
     DB_HOST=localhost
     DB_NAME=cpaneluser_sss
     DB_USER=cpaneluser_dbuser
     DB_PASS=YourDatabasePassword
     ```
5. **Set Folder Permissions**:
   - Ensure `assets/qr_img/`, `assets/image/student_photo/`, and `assets/image/profile_image/parent/` have permission `755` or `775`.

---

## Option 5: Cloud Deployment (Railway / Render)

1. Connect your Git repository to **Railway** or **Render**.
2. Provision a **MySQL** or **MariaDB** plugin/database.
3. In the Web Service settings, set the environment variables:
   - `DB_HOST`: Your cloud database host
   - `DB_PORT`: Database port
   - `DB_USER`: Database username
   - `DB_PASS`: Database password
   - `DB_NAME`: Database name
4. Import [database.sql](file:///database.sql) using the provided database URL / connection string.
5. Deploy using the included [Dockerfile](file:///Dockerfile).

---

## 🛠️ Environment Variables Reference

| Variable | Default | Description |
| :--- | :--- | :--- |
| `DB_HOST` | `localhost` | MySQL/MariaDB hostname or IP |
| `DB_PORT` | `3306` | MySQL/MariaDB connection port |
| `DB_NAME` | `sss` | Name of the database |
| `DB_USER` | `root` | Database username |
| `DB_PASS` | `""` | Database password |
| `APP_ENV` | `production` | Environment name (`development` / `production`) |
| `SMTP_HOST` | `smtp.gmail.com` | SMTP Host for password reset emails |
| `SMTP_PORT` | `587` | SMTP Port |
| `SMTP_USER` | `""` | SMTP Username |
| `SMTP_PASS` | `""` | SMTP App Password |
| `SMTP_FROM_EMAIL` | `noreply@example.com` | Sender email address |
