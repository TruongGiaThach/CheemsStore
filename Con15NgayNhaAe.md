# Đây là hướng dẫn cài đặt


## Lưu ý quan trọng trước khi làm:
## 1. Cài Ubuntu
## 2. Nếu không cài Ubuntu mà xài Windows thì phải git clone vào thư mục của Ubuntu subsystem


- cài php8 vào máy
- Cài docker, docker compose theo hướng dẫn trên docker docs
- run docker up, docker-compose up để check cài đặt oce
- tải gitdesktop
- clone project này về máy
- vào CheemsStore/app, mở terminal
- cài laravel sail theo cú pháp
  +   docker run — rm \
     -u “$(id -u):$(id -g)” \
     -v $(pwd):/opt \
     -w /opt \
     laravelsail/php80-composer:latest \
 composer install — ignore-platform-reqs
  + chú ý: bỏ cái dòng -u đi hoặc không được thì chạy lệnh sau 
     docker run 
     laravelsail/php80-composer:latest \
     composer install — ignore-platform-reqs
  + từ sau, các câu lệnh yêu cần để ./vendor/bin/sail  ở đầu
  + dùng chown add owner -R là user vào thư mục /var/www
- run ./vendor/bin/sail up rồi mở tab terminal mới
- Chạy lệnh ./vendor/bin/sail up mà ai dính lỗi "Array and string offset access syntax with curly braces is no longer supported in code example" ở "RUN pecl install mongodb && echo "extension=mongodb.so" > /etc/php/8.0/cli/php.ini" thì thêm  dòng này vô trước nó trong docker/8.0/Dockerfile:

- RUN curl -O https://pear.php.net/go-pear.phar
- RUN php go-pear.phar
- RUN pecl install grpc -q

- sau đó check lại phát chỗ dockerfile chỗ đánh dấu
  ![image](https://user-images.githubusercontent.com/71328121/139451660-a43be4e2-72ec-4fae-b025-6dcd5cb54ce1.png)
- install jessenger, passport, tinker (laravel)
  + note: sau khi cài passport, vào vendor/ {này chiều update sau hoặc ae search lỗi cx đc r fix } 
  + note số 2: k cài thằng nào liên quan đến designmynight
  + cú pháp đề nghị {UPDATE sau}
- run ./vendor/bin/sail build (nhớ tắt tab sail up trước, chạy lệnh này rồi run sail up nền lại )
- đến thư mục chứa php, thường là etc/8.0/cli/... mở file php.ini
- trong phần script thêm dòng ";extention=mongodb.so"
- giờ thì mở trình duyệt dòng chromium (Chrome/ Microsoft Edge/...) rồi vào localhost, may mắn thì nó chạy, k thì nói thạch, có khi thạch quên bước nào 
  + Ae có thể publish sail như link này rồi sửa dockerfile xem fix được lỗi của pảy k nha 
      https://viblo.asia/p/cai-dat-laravel-ket-noi-voi-mongodb-maGK76XO5j2#_laravel-sail-co-ho-tro-mongodb-khong-0
  + kèm theo nhớ ./vendor/bin/sail down khi làm theo link để tránh lỗi nhé brủh
- inbox Thạch để lấy .env
- ae nào mà bị exit ngay laravel:test "/usr/bin/env: 'bash\r': No such file or directory" thì chạy: sudo apt-get install -y dos2unix \ sudo find . -type f -exec dos2unix {} \; sau đó build lại sail.
- run .vendor/bin/sail composer install --> install package for laravel
- chạy ./vendor/bin/sail artisan migrate để test dữ liệu
- ./vendor/bin/sail artisan migrate --seed để tạo db mẫu

- tải mongodb compass gui
- connect mongodb, chỗ post là 0.0.0.0 và username = password = root
- giờ oce cả rồi, run ./vendor/bin/sail npm run watch rồi code
- chúc ae may mắn
## Một số lưu ý khi thao tác database với mongo, ae bết thêm chỗ nào update hoặc thêm vào cho mn đỡ mò:
- https://github.com/jenssegers/laravel-mongodb
- https://tech.osteel.me/posts/you-dont-need-laravel-sail#extending-laravel-sail
## Tips (thêm link vào đây, chú ý nội dung học thuật hoặc chia sẻ kiến thức:
- https://chungnguyen.xyz/posts/code-laravel-lam-sao-cho-chuan
- https://www.youtube.com/watch?v=CjA79XhHVQI
- https://viblo.asia/p/tim-hieu-eloquent-trong-laravel-phan-1-eloquent-model-database-QpmleBAo5rd
## Hướng dẫn giao diện và code
- https://www.youtube.com/watch?v=gvnxd1xne7Q (giao diện, code admin page)
- https://www.youtube.com/watch?v=BEogCy3Ux2I
- https://www.youtube.com/watch?v=4ZC6OisRPfE
- https://themeselection.com/10-best-laravel-vue-admin-template-free/
## Link drive nhóm
- https://drive.google.com/drive/folders/17ogNxapNdUGL8U3ep89noszYrcBSfh71?usp=sharing
