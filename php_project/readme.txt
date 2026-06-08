NERMAN.AI PHP Migration - Deployment Guide
-----------------------------------------

This project is a PHP/MySQL version of the Nerman.AI platform, migrated from Django.

Deployment Steps on sysdc.ru:
1. Upload all files from this ZIP to your web directory (e.g., public_html).
2. Database Setup:
   - Create a new MySQL database on your hosting.
   - Run the SQL scripts in the `db/` folder:
     a. `schema.sql` (Creates the structure)
     b. `data_dump.sql` (Populates categories, materials, and other data)
3. Configuration:
   - Edit `includes/db.php` and update the following with your hosting's database credentials:
     $host = 'localhost';
     $db   = 'your_db_name';
     $user = 'your_db_user';
     $pass = 'your_password';
4. Assets (Important!):
   - Copy your `static` folder from the Django project into this directory.
   - The PHP code expects images/videos at `static/img/...` and `static/materials/...`.
5. Testing:
   - Navigate to your domain.
   - Register a new account to test functionality.
   - Use OTP `555555` for testing registration.

Note: Pro subscription logic is implemented. New users start with 'None' status. You can manually upgrade a user to 'Pro' in the `profiles` table in your database.

Support contacts: @thePanTheR23 (Nerman Developers)
