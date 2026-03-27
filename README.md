# Kripa Technical Institute — Student Course Hub

A university web application for prospective students to explore degree programmes
and register their interest. Built in plain PHP using a hand-rolled MVC pattern
with no framework.

---

## Screenshots

See the `Screenshots/` folder for:
- `Homepage.png` — Student-facing home page
- `Admin Login.png` — Admin login page
- `Admin Panel.png` — Admin dashboard

---

## Features

### Student-Facing
- Browse all published undergraduate and postgraduate programmes
- Search programmes by keyword
- Filter programmes by level (Undergraduate / Postgraduate)
- View programme details with modules grouped by year of study
- View programme leader and module leaders for each programme
- See which modules are shared across multiple programmes with clickable links
- View staff profiles showing their modules and which programmes include them
- Register interest in a programme (duplicate prevention built in)
- Withdraw interest from a programme

### Admin
- Secure login with bcrypt password hashing
- Session-protected dashboard (redirect to login if not authenticated)
- Live statistics — total programmes, modules, and interested students
- Add, update, and delete programmes
- Add and delete modules
- Reassign module leaders
- Add new staff members
- Publish and unpublish programmes
- View full student mailing list
- Remove individual interest registrations
- Export mailing list as a CSV file

---

## Tech Stack
- **PHP** — server-side logic (no framework, hand-rolled MVC)
- **MySQL** — relational database
- **HTML / CSS** — front-end
- **XAMPP** — local development environment (Apache + MySQL)

---

## Getting Started

### Requirements
- XAMPP with Apache and MySQL running
- PHP 7.4 or higher

### Setup

1. Clone or download this repository into your XAMPP htdocs folder:
```
C:\xampp\htdocs\student-course-hub\
```

2. Start Apache and MySQL from the XAMPP Control Panel

3. Open phpMyAdmin at `http://localhost/phpmyadmin`

4. Click the **SQL** tab, paste the contents of `student_course_hub.sql`, and click **Go**

5. Create the config file manually — create `config/database.php` with this content:
```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_course_hub');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');
```

6. Open the site at:
```
http://localhost/student-course-hub/
```

---

## Admin Login
| Username | Password |
|---|---|
| admin | password |

---

## Project Structure
```
student-course-hub/
  index.php                        Entry point — loads core and dispatches routes
  student_course_hub.sql           Complete database setup script
  README.md                        This file
  .gitignore                       Excludes config/database.php from version control
  Screenshots/                     Required screenshots for submission
  app/
    controllers/
      HomeController.php
      ProgrammeController.php
      ModuleController.php
      StaffController.php
      InterestController.php
      AuthController.php
      AdminController.php
    models/
      ProgrammeModel.php
      ModuleModel.php
      StaffModel.php
      InterestModel.php
      AdminModel.php
    views/
      layouts/
        header.php                 Shared header — included on every page
        footer.php                 Shared footer — included on every page
      home/index.php
      programmes/index.php
      programmes/show.php
      modules/index.php
      staff/index.php
      staff/show.php
      interest/form.php
      interest/withdraw.php
      auth/login.php
      auth/register.php
      admin/dashboard.php
  core/
    Router.php                     Reads ?page= and dispatches to correct controller
    Controller.php                 Base class — provides view() and redirect()
    Database.php                   Singleton PDO connection
  config/
    database.php                   NOT included — create manually (see setup above)
  public/
    assets/
      css/style.css
      images/
        campus.jpg
        home.jpg
```

---

## Security Implemented
| Measure | Where |
|---|---|
| PDO prepared statements | All models — prevents SQL injection |
| htmlspecialchars() on all output | All views — prevents XSS |
| password_hash / password_verify | AuthController — bcrypt admin passwords |
| Session authentication | AdminController checkLogin() |
| Integer casting on URL IDs | All controllers — (int)$_GET['id'] |
| UNIQUE KEY on Email + ProgrammeID | InterestedStudents table — prevents duplicates |
| config/database.php in .gitignore | Credentials never uploaded to GitHub |

---

## Accessibility
- Skip to main content link for keyboard users
- Semantic HTML elements (`<main>`, `<nav>`, `<header>`, `<footer>`, `<article>`, `<section>`)
- `aria-label` on the navigation element
- Responsive CSS Grid layout — mobile-friendly at 900px and 600px breakpoints

---

## Module: CTEC2712 Web Application Development
