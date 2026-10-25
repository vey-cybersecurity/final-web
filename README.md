# Student Management System (ប្រព័ន្ធគ្រប់គ្រងសិស្ស)

A clean, beginner-friendly **Student Management System** built with **Laravel 13**, **MySQL**, **Laravel Blade**, and **Bootstrap 5**. Designed specifically as a final school project adhering strictly to Laravel's standard MVC architecture and Eloquent ORM.

---

## 👨‍🎓 Project Information
* **Student Name:** `[Your Full Name Here]`
* **School / University:** `[Your Institution Here]`
* **Project Name:** `student-management`
* **Repository URL:** `[Your GitHub Repository URL Here]`

---

## 🌟 Features Overview

1. **Authentication System:**
   - Full Registration (Name, Email, Password confirmation).
   - Secure Login with session regeneration (`session()->regenerate()`).
   - Secure Logout via HTTP `POST` with session invalidation and token refresh.
   - Route protection with `auth` middleware across dashboard and CRUD features.
   - Guest restriction with `guest` middleware for login/register pages.

2. **Department Management (CRUD):**
   - Paginated list (10 departments per page) with student counts.
   - Real-time search by department name.
   - Add, View, and Edit departments.
   - Safe deletion: Deleting a department that has registered students is **strictly blocked** both in the controller and through restrictive foreign keys (`restrictOnDelete()`).

3. **Student Management (CRUD):**
   - Paginated list (10 students per page) with eager-loaded departments (`with('department')`) and student avatar thumbnails.
   - Combined search (by Student Name or Student Code) and Department dropdown filter with preserved pagination query strings.
   - Add student with unique student code, dynamic department selection, gender radio buttons, date of birth validation (cannot be in the future), optional phone number, and optional **Profile Photo upload** (JPG, PNG, WEBP max 2MB).
   - View student profile with full-size photo, age calculation, and detailed information.
   - Edit student details with ability to replace or remove current profile photo.
   - Delete student with confirmation modal and automatic photo file cleanup from storage.

4. **Dashboard & User Interface:**
   - Responsive Bootstrap 5 layout with top navbar showing active navigation and logged-in user details.
   - Summary metric cards for **Total Students** and **Total Departments**.
   - Table displaying the **5 most recently added students**.
   - Flash alerts for success and error feedback with inline validation messages preserving old input values (`old()`).

---

## 🗄️ Database Relationships & Architecture

The application is structured around two core Eloquent models:

```
[ Department ] (1) <------------ (N) [ Student ]
      id                                department_id (Foreign Key, restrictOnDelete)
      name (unique)                     student_code (unique)
      description (nullable)            name
      timestamps                        gender ('Male', 'Female')
                                        dob (date, <= today)
                                        phone (nullable, max 30)
                                        timestamps
```

* **One-to-Many Relationship:**
  - In [Department.php](file:///e:/laragon/www/student-management/app/Models/Department.php): `public function students() { return $this->hasMany(Student::class); }`
  - In [Student.php](file:///e:/laragon/www/student-management/app/Models/Student.php): `public function department() { return $this->belongsTo(Department::class); }`
* **Referential Integrity:**
  - Foreign key in migration: `$table->foreignId('department_id')->constrained('departments')->restrictOnDelete();`
  - Controller check: [DepartmentController.php](file:///e:/laragon/www/student-management/app/Http/Controllers/DepartmentController.php) validates `$department->students()->exists()` before allowing deletion, presenting a friendly warning message.

---

## 🚀 Setup & Installation Guide (Windows + Laragon)

Follow these exact step-by-step instructions in Windows using Laragon:

### 1. Check Prerequisites
Open **Laragon Terminal** (or PowerShell) and verify your PHP and Composer versions:
```powershell
php -v
composer -V
```
*PHP 8.2+ or 8.3+ and Composer 2.x are required.*

### 2. Start Laragon Services
* Open the **Laragon** desktop interface.
* Click **Start All** to start **Apache** (or Nginx) and **MySQL**.

### 3. Create the MySQL Database
Open your terminal or MySQL client (HeidiSQL in Laragon) and execute:
```sql
CREATE DATABASE student_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
*(Or in Laragon: Right-click > MySQL > Create database... > Enter `student_management`)*

### 4. Clone or Extract the Project
Ensure the project is in Laragon's `www` root:
```
E:\laragon\www\student-management
```

### 5. Configure `.env` File
Copy `.env.example` to create your local `.env`:
```powershell
cp .env.example .env
```
Open `.env` and verify the MySQL database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_management
DB_USERNAME=root
DB_PASSWORD=
```
*(Note: Default Laragon MySQL user is `root` with an empty password).*

### 6. Install Dependencies & Generate Application Key
Run:
```powershell
composer install
php artisan key:generate
```

### 7. Run Migrations & Seed Sample Data
Run the migrations and seed demo data:
```powershell
php artisan migrate --seed
```
*(To reset the database at any time, run `php artisan migrate:fresh --seed`)*

### 8. Start & Open the Application
Run Laravel's built-in server (or use Laragon's virtual host `http://student-management.test`):
```powershell
php artisan serve
```
Open your browser and navigate to:
**[http://localhost:8000](http://localhost:8000)**

---

## 🔑 Demo Account Credentials

A pre-configured demonstration account is available:
* **Email:** `admin@example.com`
* **Password:** `Password123!`

### Sample Data Included:
* **3 Departments:**
  1. `IT` (Information Technology)
  2. `Business` (Business Administration)
  3. `Accounting` (Accounting & Finance)
* **15 Students:** Cambodian names in Latin characters distributed evenly across the departments (e.g., *Sokha Chan*, *Bopha Pich*, *Kosal Chea*, *Kalyan Nhem*).

---

## 🧪 Automated Testing & Verification

Run the full PHPUnit test suite:
```powershell
vendor/bin/phpunit --colors=never
```
All feature tests cover:
- ✅ Authentication (Login, Register, Logout, Auth Middleware redirection).
- ✅ Department CRUD and blocked deletion of non-empty departments.
- ✅ Student CRUD, unique student codes, future date of birth rejection, search, and department filtering.

---

## 📋 Manual Testing Checklist

| Test Item | Action | Expected Result |
|---|---|---|
| **1. Guest Access** | Navigate to `/dashboard` while logged out | Redirected to `/login` |
| **2. Registration** | Register new account at `/register` | Account created, logged in, and redirected to `/dashboard` |
| **3. Login** | Log in with `admin@example.com` / `Password123!` | Successfully redirected to Dashboard with greeting |
| **4. Dashboard** | Check metric cards and recent student table | Shows accurate total counts and 5 newest students |
| **5. Add Department** | Go to Departments > Add Department | Form validates name (required, unique) and creates record |
| **6. Prevent Dept Delete**| Try to delete `IT` (has students) | Deletion blocked with clear warning alert |
| **7. Add Student** | Go to Students > Add Student | Dropdown shows departments; future DOB triggers validation error |
| **8. Search & Filter** | Search "Chan" and select "IT" department | Filtered results show only matching students; pagination preserved |
| **9. Student Profile** | Click View icon on any student | Profile screen shows complete details and age calculation |
| **10. Logout** | Click user dropdown > Logout | Session invalidated and redirected to Login screen |

---

## 📦 Pushing to GitHub (Clean Repository)

Before committing and pushing to GitHub, make sure no secrets or build caches are included:

1. Check `.gitignore` contains:
   ```
   .env
   /vendor
   /node_modules
   ```
2. Initialize and push:
   ```powershell
   git init
   git add .
   git commit -m "Complete Student Management System final project"
   git branch -M main
   git remote add origin https://github.com/[your-username]/[your-repo].git
   git push -u origin main
   ```

---

## 🗜️ Preparing Source ZIP for Submission

To create a clean submission ZIP package:
1. Verify that `.env.example` has the setup configuration and `README.md` is present.
2. Ensure you **DO NOT** include `.env`, `vendor/`, or `node_modules/` in the ZIP file.
3. Compress the project folder:
   - Exclude: `.env`, `vendor/`, `node_modules/`, `.git/`
   - Include: `app/`, `bootstrap/`, `config/`, `database/`, `public/`, `resources/`, `routes/`, `tests/`, `composer.json`, `composer.lock`, `.env.example`, `artisan`, `README.md`.

---

## 🎥 Demo Video Recording Checklist (for School Submission)

When recording your demonstration video (3–5 minutes recommended):

1. **Introduction:** State your name, student ID, project title ("Student Management System"), and tech stack (Laravel 13, Blade, Bootstrap 5, MySQL).
2. **Setup Demonstration:** Briefly show Laragon running with Apache and MySQL.
3. **Database Inspection:** Show the 3 tables (`users`, `departments`, `students`) in HeidiSQL or phpMyAdmin.
4. **Authentication Flow:**
   - Demonstrate logging in with the demo credentials.
   - Show registration of a new user.
5. **Dashboard Tour:** Point out the summary statistic cards and recent students list.
6. **Department Management:**
   - Create a test department (e.g., "Graphic Design").
   - Attempt to delete the `IT` department to prove deletion is blocked because it has students.
   - Delete the empty "Graphic Design" department to show normal deletion works.
7. **Student Management:**
   - Add a new student, showing validation for duplicate code or future date of birth.
   - Demonstrate the combined search and department dropdown filter.
   - Show pagination navigating between pages while retaining the filter.
   - View a student profile and edit their details.
8. **Logout:** Click Logout to confirm session destruction and redirect to login.
