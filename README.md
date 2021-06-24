## About OASYS

OASYS is a web based office attendance system made with Laravel as a project for my internship program on Refactory. There are several features of this system:
1. Office and Division Management
2. Employee Management
3. Working Shift Management
4. Attendance System
5. QR Code Attendance
6. Absent Proposal System
7. Overtime Proposal System
8. Leave Proposal System

This system also provides Rest API to be consumed for mobile application development.

OASYS can be used in two ways. First is by using the web application, and the second is by using mobile application.

A brief explanation about QR Code attendance, admin will generate QR Code for the desired amount of time (in seconds), then the employees can scan the generated code to submit their attendance. After attendance is submitted, employee must edit  their attendance because there are fields that automatically filled when an attendance is submitted by scanning QR Code

## API Documentation

- [authentication](https://documenter.getpostman.com/view/14039041/TzJu8x2C)
- [attendance](https://documenter.getpostman.com/view/14039041/TzRa6j6L)
- [overtime](https://documenter.getpostman.com/view/14039041/TzXtK1my)
- [absent](https://documenter.getpostman.com/view/14039041/TzXtK1n1)
- [leave](https://documenter.getpostman.com/view/14039041/TzXtK1mz)
- [approve-attendance](https://documenter.getpostman.com/view/14039041/TzY3DGoJ)
- [approve-overtime](https://documenter.getpostman.com/view/14039041/TzXtK1my)
- [approve-absent](https://documenter.getpostman.com/view/14039041/TzecD5Q2)
- [approve-leave](https://documenter.getpostman.com/view/14039041/TzecD5Q3)
- [qr code attendance](https://documenter.getpostman.com/view/14039041/TzXtK1n2)

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation
1. Run `composer install`
2. Run `npm install` and then `npm run dev`
3. Create a file named `.env` on the root folder and then copy the content of `env.example` file to `.env`
4. Change `CACHE_DRIVER=file` to `CACHE_DRIVER=redis` on the `.env` file
5. Change `QUEUE_CONNECTION=sync` to `QUEUE_CONNECTION=database` on the `.env` file
6. Configure the mail variables to your own SMTP server using _Google Mail_ or _Mailtrap_ as well as the database variables to your own configurations
7. Run `php artisan key:generate`
8. Run `php artisan migrate:fresh --seed` to migrate and seed the database
9. Run `php artisan serve`
10. Run `php artisan queue:work`
11. By default, a user with admin privilege is created when the seeder is run. The email is `admin@mail.com` and the password is `password`
