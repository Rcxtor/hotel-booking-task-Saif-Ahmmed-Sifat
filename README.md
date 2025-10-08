Installation Guide
---

> bash
```
    git clone https://github.com/Rcxtor/hotel-booking-task-Saif-Ahmmed-Sifat.git 
    cd hotel-booking-task-Saif-Ahmmed-Sifat
```
Install Dependencies
---
> bash
```
composer install
npm install && npm run build
```
Create Environment File
---
> bash
```
cp .env.example .env
```
Copy the followings
> .env
```
APP_NAME=laravel
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotelgo
DB_USERNAME=root
DB_PASSWORD=
```
Run Migration and Seed Data
---
>bash
```
php artisan migrate --seed
```
Start the Server
>bash (seperate)
```
npm run dev
php artisan serve
```
Access the app through browser
---
>web-browser
```
http://localhost:8000
```
Technologies Used
---
```
Laravel 12.32.5
PHP 8.2.12
Composer 2.6.5
MySQL
Blade Templates
```
USER Flow
---
```
1.User visits the Home page

2.Clicks “Book Room”

3.Provides Name, Email, and Phone

4.Selects Check-in and Check-out dates

5.System displays available room categories with pricing

6.User chooses a room category

7.Confirms booking

8.Redirected to a Thank You page showing booking details
```
