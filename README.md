# HappyHolidayHome

Welcome to HappyHolidayHome! This is a full-stack holiday home reservation website built with HTML, CSS, JavaScript, PHP, MySQL, and Bootstrap 5.

## Features

- **User-friendly Interface:** Intuitive and easy-to-use interface for browsing and booking vacation homes.
  
- **Home Listings:** Browse vacation home listings with descriptions, images, and pricing information.

- **Booking System:** Select vacation homes, choose dates, and make reservations with real-time availability updates.

- **User Authentication:** Secure user registration and login for booking history and profile management, integrated with Google reCAPTCHA for added security.

- **Admin Panel (Bootstrap 5):** Manage holiday homes, reservations, and user data through the admin panel.

- **Backend Database (MySQL):** MySQL database for storing holiday home details, user info, and reservations.

## Technologies Used

- **Frontend:**
  - HTML5, CSS3, JavaScript
  - Bootstrap 5
  
- **Backend:**
  - PHP
  - MySQL Database
  - PHPMailer for OTP (One-Time Password) system for user verification

## Usage (Self-Hosting with XAMPP)

1. **Setup Environment:** To host the HappyHolidayHome reservation website, ensure you have a server environment with PHP and MySQL support. XAMPP provides an easy solution by bundling Apache, MySQL, PHP, and Perl. Transfer the project files to your XAMPP's web directory (usually "htdocs").

2. **Database Configuration:** Import the provided MySQL database schema to set up the necessary tables and configurations for storing holiday home details, user information, and reservations. Use PHPMyAdmin, accessible through XAMPP, to import the database schema.

3. **Customization:** Modify the website content, such as holiday home listings, descriptions, images, and pricing information according to your requirements. Edit the project files within the XAMPP directory.

4. **Google reCAPTCHA Setup:** Obtain your reCAPTCHA keys from Google's reCAPTCHA administration panel. Integrate these keys into the user and admin login pages for added security. Update the respective files within your XAMPP directory.

5. **OTP System Configuration:** Configure PHPMailer with your email settings for the OTP (One-Time Password) system to enable user verification during registration and login processes. Adjust the PHPMailer settings within your XAMPP environment.

6. **Launch and Usage:** After completing the setup and configurations, access the homepage through your local server using XAMPP to begin browsing available vacation homes. Users can register/login to make reservations, and admins can utilize the admin panel to manage listings and reservations.

7. **Security Considerations:** Regularly update and maintain the system to ensure security protocols are up to date. Periodically review reCAPTCHA and email configurations within your XAMPP environment to guarantee effective security measures.

## Reference

- [How To Send Email Using PHP With PHP Mailer | PHP Send Email | Full Step By Step](https://youtu.be/9tD8lA9foxw) by [David G Tech](https://www.youtube.com/@DavidGTech)

## Author

This project is developed by [Adhiraj Saha](https://github.com/adhirajcs/).