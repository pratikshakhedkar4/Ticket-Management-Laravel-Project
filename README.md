Admin Credentials:
Email: pratikshakhedkar4@gmail.com
password: Admin@123

Installation:
Create new database
Add database name .env file
Enter your mail credentials in .env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    mail_username=yourmail@gmail.com
    MAIL_PASSWORD=your password
    MAIL_ENCRYPTION=tls
    mail_from_address=yourmail@gmail.com
    MAIL_FROM_NAME="${APP_NAME}"
Run php artisan migrate command
Run php artisan db:seed command
Run php arisan serve