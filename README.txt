K2 CAREER HUB - LOCAL DEMO
==========================

REQUIREMENTS
- XAMPP (Windows) or another PHP 8.1+ local server
- PHP extensions: PDO_SQLite and SQLite3 enabled
- Apache and PHP running

INSTALL (XAMPP / WINDOWS)
1. Extract the ZIP.
2. Copy the folder "k2careerhub_local" into C:\xampp\htdocs\
3. Open XAMPP Control Panel and Start Apache.
4. Visit http://localhost/k2careerhub_local/

DEMO LOGINS
Admin:
  admin@k2careerhub.local
  Admin@123

Student:
  student@k2careerhub.local
  Student@123

WHAT WORKS IN THIS PROTOTYPE
- Responsive homepage and navigation
- College directory, search and profile pages
- Course catalogue and separate Distance Education page
- Student registration/login
- Admission enquiry creation
- Student dashboard with own admission records
- Admin dashboard with all admission records
- Admission status management
- CSV export
- SQLite database auto-created in /data

IMPORTANT
- This is a local prototype, not production-ready.
- The campus/gallery panels are design placeholders until real institution images are uploaded.
- Do not enter real student personal data, identity documents or payment details.
- Change demo passwords before any shared testing.
- For a real deployment, add admin-managed institution/gallery CRUD, institution login, document security, consent, audit trail, backups, email verification and security review.
- If you see "SQLite is not available", enable pdo_sqlite and sqlite3 in php.ini, restart Apache, and retry.
