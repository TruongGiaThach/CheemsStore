<template>
<div>
    <div class="divider"></div>
        <div class="main-footer">
            <div class="container">
                <div class="row mx-md-n5">
                    <div class="col px-md-5">
                        <h5 id ="title">CÔNG TY CỔ PHẦN THƯƠNG MẠI - DỊCH VỤ CHEEMS</h5>
                        <p>© 1997 - 2021 Công Ty Cổ Phần Thương Mại - Dịch Vụ Cheems
                            <br>
                            Giấy chứng nhận đăng ký doanh nghiệp: 0304998358 do Sở KH-ĐT TP.HCM cấp lần đầu ngày 30 tháng 05 năm 2007.
                            <br>
                            <br>
                        <b>Địa chỉ trụ sở chính:</b>
                        <br>
                        - khu phố 6, Thủ Đức, Thành phố Hồ Chí Minh
                        <br>
                        <b>Văn phòng điều hành miền Bắc:</b>
                        <br>
                        - Tầng 6, Số 1 Phố Thái Hà, Phường Trung Liệt, Quận Đống Đa, Hà Nội
                        <br>
                        <b>Văn phòng điều hành miền Nam:</b>
                        <br>
                        - Tầng 11 Minh Long Tower, số 17 Bà Huyện Thanh Quan, Phường Võ Thị Sáu, Quận 3, TP. Hồ Chí Minh</p>
                    </div>
                    <div class="col px-md-5">
                        <h5 id ="title">Liên hệ</h5>
                        <p>
                            <a class ="row " href="tel:0969694200"><i class="fa fa-phone mr-sm-2 fa-lg"></i>
                                <p id="title" class="mr-sm-1">Tổng đài: </p>
                                <p id="info">0969694200</p>
                            </a>
                            <a class ="row " href="mailto:admin@devtest.com"><i class="fa fa-envelope mr-sm-2 fa-2x"></i>
                                <p id="title" class="mr-sm-1">Email: </p>
                                <p id="info">admin@devtest.com</p>
                            </a>
                        </p>
                    </div>
                    <div class="col">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15672.924961103905!2d106.8030541!3d10.8700089!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xafa66f9c8be3c91!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiDEkEhRRyBUUC5IQ00!5e0!3m2!1svi!2sus!4v1636166812657!5m2!1svi!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <router-link :to="{name: 'home'}" id="right-reserved">2021 © by Cheemsstore.com All Right Reserved.</router-link>
        </div>
</div>
    
</template>

<style scoped>
/***************************
*******Main footer CSS******
****************************/
.divider{
    height: 0.2em;
    background-color: #d2691e;
}
.main-footer{
    height: fit-content;
    background-color: #ffff;
}
.main-footer .container{
    padding-top: 2em;
    max-width: 95%;
}
.main-footer .container .col #title{
    color: #d2691e;
    font-weight: bold;
    height: 3em;
}

.main-footer .container .col p{
    font-size: 90%;
}
.main-footer .container .col p p{
    display: inline;
}
/*****************************
*******Bottom footer CSS******
******************************/
.bottom-footer{
    height: 2.5em;
    background-color: #d2691e42;
    text-align: center;
}
.bottom-footer #right-reserved{
    line-height: 2.5em;
    text-decoration: none;
}
</style>