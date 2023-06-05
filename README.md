
# Laravel Web Course

Website Laravel Backend dengan tema web course dimana user dapat memesan/order dan mengakses course yang sudah dibeli menggunakan sistem payment manual berupa Admin Approvement.

- User Dashboard
- Admin Dashboard
- Course Management (CRUD Course)
- Admin Approve Orders (Manual Approvement)



## Setup Project

Clone the project

```bash
  git clone https://github.com/BagusFary/CourseLaravel
```

Go to the project directory

```bash
  cd CourseLaravel
```

Install dependencies

```bash
  cp .env.example .env 
  configure your env and change filesystem disk to public
```
```bash
  Configure your mailtrap to set up mail notifications
```
```bash
  composer install
```
```bash
  npm install
```
```bash
  php artisan key:generate
```
```bash
  php artisan storage:link
```
```bash
  php artisan migrate
```
```bash
  php artisan db:seed
```
Start the server
```bash
  npm run dev
```
```bash
  php artisan serve
```





## User and Admin Login

- Admin
Email    : admin@gmail.com__

Password : 12345678

- User
Password for all users email is '12345678'




