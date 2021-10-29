Đây là hướng dẫn cài đặt

!Quan trọng: Cài ubuntu trước mấy e gái

- Cài docker, docker compose theo hướng dẫn trên docker docs
- run docker up, docker-compose up để check cài đặt oce
- tải gitdesktop
- clone project này về máy
- vào CheemsStore/app, mở terminal
- cài laravel sail theo cú pháp
  + ![image](https://user-images.githubusercontent.com/71328121/139443708-163918f9-1989-4893-be19-be68b49ca32a.png)
  + chú ý: bỏ cái dòng -u đi
- run .vendor/bin/sail up rồi mở tab terminal mới
- cài php8 vào máy
- đến thư mục chứa php, thường là etc/8.0/...
- trong phần script thêm dòng ";extention=mongodb.so", nhớ sudo
- giờ thì mở chrome ( chưa có thì cài) rồi vào localhost, may mắn thì nó chạy, k thì nói thạch, có khi thạch quên bước nào 
- tải mongodb compass gui
- connect mongodb, chỗ post là 0.0.0.0 và username = password = root
- giờ oce cả rồi, run ./vendor/bin/sail npm run watch rồi code
- chúc ae may mắn
