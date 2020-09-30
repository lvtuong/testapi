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
Bước 7: Xây dựng các styles và scripts
npm run <command>
Các lệnh(command) khả dụng được liệt kê ở đầu tệp package.json dưới từ khóa 'scripts'.

Bước8: Storage:link
php artisan storage:link
Sau khi cài dự án bạn phải chạy lệnh trên để public thư mục lưu trữ của bạn khi người dùng upload ảnh.

Bước 9: Chạy Phpunit ( https://github.com/rappasoft/laravel-5-boilerplate)
Sau khi dự án của bạn được cài đặt, bạn hãy chạy phpunit. để đảm bảo tất cả các chức năng đang hoạt động chính xác.
Từ gốc của dự án của bạn chạy:

phpunit
Bước 10: Login vào dự án
Sau khi cài đặt xong và và bạn có thế vào trình duyệt và login vào dự án với dữ liệu sau:

Username: admin@admin.com
Password: secret

