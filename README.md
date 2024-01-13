# Todo app

## Cara Menjalankan Proyek
* Clone project https://github.com/agissept/todo-app.git
* Buka project tersebut
* Copy buat file .env berdasarkan .env.example
* Sesuaikan APP_URL, FORWARD_DB_PORT, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD dan yang lainnya
### Via local composer  (not tested)
* Jalankan `composer install` dan `npm install`
* Jalankan `php artisan migrate`
* Jalankan `php artisan serve` dan `npm dev`
### Via laravel sail (tested)
*pastikan anda sudah memahami penggunakan laravel sail https://laravel.com/docs/10.x/sail*
* Jalankan `composer install` dan `./sail npm install`
* Jalankan `./sail artisan migrate`
* Jalankan `./sail up -d` dan `/sail npm run dev`


## db.sql
Terdapat file database yang bisa Anda gunakan, sebagai initial data. Jika database ini telah dimport Anda bisa login menggunakan akun yang sudah ada. Daftar akun
* admin@gmail.com
* abdul@gmail.com
* asep@gmail.com
* lukman@gmail.com

Semua passwordnya adalah `12345678`
