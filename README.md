Huong dan cai dat va su dung:

bước 1: Clone remote repository về local 
$ git clone <repository> <directory>

bước 2: Cài đặt composer và npm để cài đặt các gói cần thiết trong dự án: 
$ composer install
$ npm install

bước 3: Tạo database và config database
$ cp .env.example .env (lệnh này để copy file file .env.example sang file .env vì phải có file .env thì mới kết nối tới database được)

Cập nhật file .env như sau: 

DB_CONNECTION=psql         
DB_HOST=127.0.0.1            
DB_PORT=5432   
DB_DATABASE=<user>
DB_USERNAME=<password>
    
bước 4: Tạo key cho dự án:

$ php artisan key:generate

--------update sau--------
Bước 5: Tạo ra các bảng và dữ liệu mẫu cho database
php artisan migrate
php artisan db:seed



