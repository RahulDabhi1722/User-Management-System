# 🔐 User Authentication System

A modern, secure, and user-friendly PHP-based authentication system with registration, login, password management, and enhanced security features.

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/CSS3-Modern-1572B6?style=flat-square&logo=css3&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 📋 Table of Contents

- [Features](#-features)
- [Screenshots](#-screenshots)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Security Features](#-security-features)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

### 🚀 Core Features
- **User Registration** with form validation and password strength indicator
- **Secure Login** with session management
- **Password Reset** functionality via email
- **User Dashboard** with profile information
- **Remember Me** option for persistent sessions
- **Responsive Design** that works on all devices

### 🔒 Security Features
- **Password Hashing** using PHP's password_hash()
- **CSRF Protection** for all forms
- **Rate Limiting** to prevent brute force attacks
- **Input Sanitization** and validation
- **Session Security** with proper timeout handling
- **SQL Injection Protection** using prepared statements

### 🎨 User Experience
- **Modern UI Design** with smooth animations
- **Form Validation** with real-time feedback
- **Loading States** and progress indicators
- **Toast Notifications** for user feedback
- **Password Strength Meter** with visual feedback
- **Mobile-First Responsive Design**

## 📸 Screenshots

### Login Page
![Login Page](<img width="636" height="772" alt="Screenshot 2025-08-10 101247" src="https://github.com/user-attachments/assets/6da6b4f1-002e-4fd9-8864-291894904d01" />)

### Registration Page
![Registration Page](<img width="490" height="925" alt="Screenshot 2025-08-10 101716" src="https://github.com/user-attachments/assets/9039be7e-9629-42e8-b206-3741286e3b9d" />)

### Dashboard
![Dashboard](<img width="1086" height="848" alt="Screenshot 2025-08-10 101052" src="https://github.com/user-attachments/assets/e8413758-0435-4fc9-aa51-ec4c2bfa5079" />)


## 🚀 Installation

### Prerequisites
- **PHP 7.4+** with MySQLi/PDO support
- **MySQL 5.7+** or MariaDB
- **Web Server** (Apache/Nginx)
- **XAMPP/WAMP/MAMP** (for local development)

### Step 1: Clone/Download
```bash
# Clone the repository (if using Git)
git clone https://github.com/yourusername/user-auth.git

# Or download and extract the ZIP file to your web directory
```

### Step 2: Database Setup
1. Start your web server and MySQL
2. Open phpMyAdmin (`http://localhost/phpmyadmin`)
3. Import the database:
   ```sql
   # Run the SQL commands from db.sql file
   # Or import the file directly in phpMyAdmin
   ```

### Step 3: Configuration
1. Edit `config/Database.php` with your database credentials:
   ```php
   private $host = "localhost";
   private $db_name = "user_auth";
   private $username = "root";
   private $password = "";
   ```

2. Update `config/config.php` for your environment:
   ```php
   define('APP_URL', 'http://localhost/user-auth');

   ```

### Step 4: File Permissions
Ensure proper file permissions for security:
```bash
# For Unix/Linux systems
chmod 755 /path/to/user-auth
chmod 644 /path/to/user-auth/*.php
```

## ⚙️ Configuration

### Database Configuration
Edit `config/Database.php`:
```php
private $host = "your_host";
private $db_name = "your_database";
private $username = "your_username";
private $password = "your_password";
```

### Application Settings
Edit `config/config.php`:
```php
// Application Settings
define('APP_NAME', 'Your App Name');
define('APP_URL', 'http://yourdomain.com');

// Security Settings
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 300); 
define('SESSION_LIFETIME', 3600);  

// Password Requirements
define('MIN_PASSWORD_LENGTH', 6);
define('REQUIRE_UPPERCASE', true);
define('REQUIRE_LOWERCASE', true);
define('REQUIRE_NUMBERS', true);
```

## 📖 Usage

### User Registration
1. Navigate to `register.php`
2. Fill out the registration form
3. Password strength is validated in real-time
4. Form is automatically cleared after successful registration

### User Login
1. Go to `login.php`
2. Enter email/username and password
3. Optional "Remember Me" for persistent sessions
4. Rate limiting prevents brute force attacks

### Password Reset
1. Click "Forgot Password" on login page
2. Enter your email address
3. Check email for reset instructions
4. Follow the link to set a new password

### User Dashboard
- View profile information
- Access account settings
- Secure logout functionality

## 📁 Project Structure

```
user-auth/
├── 📁 classes/
│   ├── 📄 User.php           # User management class
│   └── 📄 Security.php       # Security utilities
├── 📁 config/
│   ├── 📄 Database.php       # Database connection
│   └── 📄 config.php         # App configuration
├── 📁 css/
│   └── 📄 style.css          # Modern responsive styles
├── 📄 db.sql                 # Database schema
├── 📄 login.php              # Login page
├── 📄 register.php           # Registration page
├── 📄 home.php               # User dashboard
├── 📄 forgot-password.php    # Password reset
├── 📄 logout.php             # Logout handler
└── 📄 README.md              # This file
```

## 🔒 Security Features

### Password Security
- Passwords are hashed using `password_hash()` with bcrypt
- Minimum length requirements
- Strength validation (uppercase, lowercase, numbers, special chars)
- Secure password reset tokens

### Session Security
- Secure session handling with proper timeouts
- Session regeneration on login
- CSRF token protection on all forms
- Automatic session cleanup

### Input Validation
- Server-side validation for all inputs
- HTML entity encoding to prevent XSS
- SQL injection protection with prepared statements
- Rate limiting for login attempts

### Additional Security
- IP-based rate limiting
- Security event logging
- Input sanitization
- Secure headers implementation

## 🛠️ Customization

### Styling
Edit `css/style.css` to customize the appearance:
- Colors and themes
- Layout and spacing
- Animations and transitions
- Responsive breakpoints

### Functionality
Modify PHP classes to add features:
- `classes/User.php` - User management
- `classes/Security.php` - Security functions
- `config/config.php` - App settings

## 🐛 Troubleshooting

### Common Issues

**Database Connection Error:**
```
Solution: Check database credentials in config/Database.php
```

**Class 'Database' not found:**
```
Solution: Ensure proper file paths and includes
```

**Session Issues:**
```
Solution: Check session configuration and file permissions
```

**CSS Not Loading:**
```
Solution: Verify file paths and web server configuration
```

## 📝 Requirements

- **PHP**: 7.4 or higher
- **MySQL**: 5.7 or higher (or MariaDB equivalent)
- **Extensions**: PDO, password hashing support
- **Web Server**: Apache or Nginx

## 🆓 FREE Hosting Options - Deploy Without Spending Money

### 🌟 Best Free PHP Hosting Platforms

#### 1. **InfinityFree** ⭐ (Highly Recommended)
**Website:** infinityfree.net
- ✅ **Unlimited bandwidth & storage**
- ✅ **PHP 8.1 support**
- ✅ **MySQL databases**
- ✅ **No ads on your site**
- ✅ **Free SSL certificates**
- ✅ **Custom domains** (if you have one)
- 📧 **Free subdomain:** yoursite.rf.gd

**Setup Steps:**
1. Sign up at infinityfree.net
2. Create hosting account
3. Upload files via File Manager
4. Create MySQL database
5. Update config files
6. Your site: `yourproject.rf.gd`

#### 2. **000webhost** ⭐
**Website:** 000webhost.com
- ✅ **1GB storage, 10GB bandwidth**
- ✅ **PHP 8.0 support**
- ✅ **1 MySQL database**
- ✅ **Website builder included**
- ✅ **Free SSL**
- 📧 **Free subdomain:** yoursite.000webhostapp.com

#### 3. **AwardSpace**
**Website:** awardspace.com
- ✅ **1GB storage, 5GB bandwidth**
- ✅ **PHP 8.0 support**
- ✅ **1 MySQL database**
- ✅ **Ad-free hosting**
- 📧 **Free subdomain:** yoursite.ultimatefreehost.in

#### 4. **FreeHosting.com**
**Website:** freehosting.com
- ✅ **10GB storage, unlimited bandwidth**
- ✅ **PHP support**
- ✅ **MySQL databases**
- ⚠️ **Small ads (removable)**
- 📧 **Free subdomain:** yoursite.freevar.com

#### 5. **Heroku** (For Advanced Users)
**Website:** heroku.com
- ✅ **Git-based deployment**
- ✅ **Professional platform**
- ✅ **PostgreSQL database (free tier)**
- ⚠️ **Requires code modifications for PostgreSQL**
- 💤 **Sleeps after 30 min inactivity**

### 🚀 Quick Setup Guide for InfinityFree (Recommended)

#### Step 1: Sign Up
1. Go to **infinityfree.net**
2. Click "**Sign Up**"
3. Create account (no credit card needed)

#### Step 2: Create Hosting Account
1. Choose "**Create Account**"
2. Select subdomain: `yourproject.rf.gd`
3. Wait for account activation (2-3 hours)

#### Step 3: Upload Your Project
1. Login to **Control Panel**
2. Open "**File Manager**"
3. Go to `htdocs` folder
4. Upload all your PHP files
5. Extract if uploaded as ZIP

#### Step 4: Create Database
1. Go to "**MySQL Databases**"
2. Create new database
3. Note down database details:
   ```
   Database Name: epiz_xxxxx_yourdb
   Username: epiz_xxxxx
   Password: [your_password]
   Hostname: sql200.rf.gd
   ```

#### Step 5: Update Configuration
```php
// config/Database.php
private $host = "sql200.rf.gd";  // InfinityFree hostname
private $db_name = "epiz_xxxxx_yourdb";  // Your database name
private $username = "epiz_xxxxx";  // Your username
private $password = "your_password";  // Your password
```

```php
// config/config.php
define('APP_URL', 'https://yourproject.rf.gd');
define('ENVIRONMENT', 'production');
```

#### Step 6: Test Your Site
Visit: `https://yourproject.rf.gd/login.php`

### 💡 Alternative Free Options

#### **GitHub Pages + PHP Alternatives**
Since GitHub Pages doesn't support PHP, consider:
- **Convert to Static:** Use JavaScript for frontend
- **Netlify Functions:** For backend API
- **Vercel:** Supports serverless functions

#### **Firebase (Google)**
- **Free tier:** 1GB storage, 10GB bandwidth
- **Real-time database**
- **Requires converting to JavaScript**

#### **Railway.app**
- **$5 free credit monthly**
- **Supports PHP projects**
- **PostgreSQL database**

### ⚠️ Free Hosting Limitations

#### Common Restrictions:
- **Limited storage** (1-10GB)
- **Bandwidth limits** (5-10GB/month)
- **No email hosting**
- **Subdomain only** (no custom domain)
- **Occasional downtime**
- **Limited support**

#### What You Get:
- ✅ **Your project online 24/7**
- ✅ **Working database**
- ✅ **SSL certificate**
- ✅ **File management**
- ✅ **Basic analytics**

### 🔧 Free Hosting Setup Checklist

1. **Choose platform** (InfinityFree recommended)
2. **Sign up** (no payment required)
3. **Create hosting account**
4. **Upload project files** via File Manager
5. **Create MySQL database**
6. **Update config files** with new database details
7. **Test login/registration**
8. **Share your live URL!**

### 📱 Your Project Will Be Live At:
- **InfinityFree:** `https://yourproject.rf.gd`
- **000webhost:** `https://yourproject.000webhostapp.com`
- **AwardSpace:** `https://yourproject.ultimatefreehost.in`

### 🎯 Perfect for:
- **Learning & Portfolio**
- **School/College projects**
- **Testing & Demonstrations**
- **Small personal projects**
- **Proof of concept**

### 🚀 Upgrade Path:
Start free → **If traffic grows** → Upgrade to paid hosting
- Most free hosts offer paid upgrades
- Easy migration to better hosting
- Custom domain support

### 💻 Complete Free Solution:
```
Free Hosting + Free Subdomain + Free SSL = $0/year
Perfect for learning and showcasing your work!
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Font Awesome for icons
- Google Fonts for typography
- PHP community for security best practices
- Contributors and testers

## 🔄 Changelog

### Version 2.0
- Added modern responsive design
- Implemented password strength indicator
- Enhanced security features
- Added CSRF protection
- Improved user experience

### Version 1.0
- Basic authentication system
- User registration and login
- Simple database structure


