# Đây là hướng dẫn cài đặt

## Quan trọng: Cài ubuntu trước mấy e gái

- Cài docker, docker compose theo hướng dẫn trên docker docs
- run docker up, docker-compose up để check cài đặt oce
- tải gitdesktop
- clone project này về máy
- vào CheemsStore/app, mở terminal
- cài laravel sail theo cú pháp
  + ![image](https://user-images.githubusercontent.com/71328121/139443708-163918f9-1989-4893-be19-be68b49ca32a.png)
  + chú ý: bỏ cái dòng -u đi
  + từ sau, các câu lệnh yêu cần để ./vendor/bin/sail  ở đầu
  + dùng chown add owner -R là user vào thư mục /var/www
- run .vendor/bin/sail up rồi mở tab terminal mới
- cài php8 vào máy
- sau đó check lại phát chỗ dockerfile chỗ đánh dấu
  ![image](https://user-images.githubusercontent.com/71328121/139451660-a43be4e2-72ec-4fae-b025-6dcd5cb54ce1.png)
- install jessenger, passport, tinker
  + note: sau khi cài passport, vào vendor/ {này chiều update sau hoặc ae search lỗi cx đc r fix } 
  + note số 2: k cài thằng nào liên quan đến designmynight
  + cú pháp đề nghị {UPDATE sau}
- run ./vendor/bin/sail build (nhớ tắt tab sail up trước, chạy lệnh này rồi run sail up nền lại lmao :) )
- đến thư mục chứa php, thường là etc/8.0/cli/... mở file php.ini
- trong phần script thêm dòng ";extention=mongodb.so", nhớ sudo
- giờ thì mở chrome ( chưa có thì cài) rồi vào localhost, may mắn thì nó chạy, k thì nói thạch, có khi thạch quên bước nào 
  + Ae có thể publish sail như link này rồi sửa dockerfile xem fix được lỗi của pảy k nha 
      https://viblo.asia/p/cai-dat-laravel-ket-noi-voi-mongodb-maGK76XO5j2#_laravel-sail-co-ho-tro-mongodb-khong-0
  + kèm theo nhớ ./vendor/bin/sail down khi làm theo link để tránh lỗi nhé brủh
- ask me for .env file and save it into project
- run .vendor/bin/sail composer install --> install package for laravel
- chạy ./vendor/bin/sail artisan migrate để test dữ liệu
- ./vendor/bin/sail artisan migrate --seed để tạo db mẫu
- 
- tải mongodb compass gui
- connect mongodb, chỗ post là 0.0.0.0 và username = password = root
- giờ oce cả rồi, run ./vendor/bin/sail npm run watch rồi code
- chúc ae may mắn
## Một số lưu ý khi thao tác database với mongo, ae bết thêm chỗ nào update hoặc thêm vào cho mn đỡ mò:
- https://github.com/jenssegers/laravel-mongodb
- https://tech.osteel.me/posts/you-dont-need-laravel-sail#extending-laravel-sail
## Tips (thêm link vào đây, chú ý nội dung học thuật hoặc chia sẻ kiến thức:
- https://chungnguyen.xyz/posts/code-laravel-lam-sao-cho-chuan
