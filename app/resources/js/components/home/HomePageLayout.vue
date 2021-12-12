  <template>
        <div>
            <!-- Top bar-->
            <div class ="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li class="mr-sm-4">
                                        <a href="tel:0969694200"><i class="fa fa-phone mr-sm-2 fa-2x"></i>
                                            <p id="info">0969694200</p>
                                            <p id="title " class="mr-sm-1">Hotline: </p>
                                        </a>
                                    </li>
                                    <li class="mr-sm-4">
                                        <a href="mailto:admin@devtest.com"><i class="fa fa-envelope mr-sm-2 fa-2x"></i>
                                            <p id="info">admin@devtest.com</p>
                                            <p id="title" class="mr-sm-1">Email: </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2 ml-auto">
                            <div class="social-icons pull-right">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main bar -->
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel mainbar sticky-top">
                    <div class="container">
                        <div class ="brand">
                            <a href="/home" class="navbar-brand">
                                <div>
                                    <img id="logo" :src = "require('../../../../public/images/CheemsIcons.png').default" width="55em">
                                    <h2 id="title">
                                        <b>Cheems Store</b>
                                    </h2>
                                </div>
                            </a>
                        </div>

                        <!-- Left Side Of Navbar -->
                        <div class="navbar-nav mr-auto">
                            <div class="mobile-menu">
                                <v-btn
                                @click="dialog = true"
                                >
                                    <v-icon>fas fa-list</v-icon>
                                </v-btn>
                                <v-dialog
                                v-model="dialog"
                                >
                                <div class="menu">
                                    <side-menu></side-menu>
                                </div>
                                    
                                </v-dialog>
                            </div>

                            <form class="form-inline search-box" :action="'/store/' + this.category + '/' + this.search" method="get">
                                <input class="form-control mr-sm-2 " v-model="search" type="search" placeholder="Nhập từ khóa cần tìm" aria-label="Search" size="50">
                                <button class="btn btn-warning my-2 my-sm-0 cheems-color">
                                    <i class="fas fa-search fa-lg"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Right Side Of Navbar -->
                        <div class="navbar-nav ml-auto">
                            <div class="dropdown">
                                <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" >
                                    <a href="/store/all" class="nav-link">
                                        <div class = "navbar-icon">
                                            <i class="fas fa-tag fa-2x"></i>
                                            <p>
                                                <b>Khuyến mãi</b>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="dropdown">
                                <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" >
                                    <a href="/store/all" class="nav-link">
                                        <div class = "navbar-icon">
                                            <i class="fas fa-store-alt fa-2x"></i>
                                            <p>
                                                <b>Cửa hàng</b>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" >
                                    <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">
                                        <div class = "navbar-icon">
                                            <i class="far fa-user-circle fa-2x"></i>
                                            <p>
                                                <b>Tài khoản</b>
                                            </p>
                                        </div>
                                    </router-link>
                                    <span v-if="isLoggedIn">
                                        <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 'user'"> 
                                            <div class = "navbar-icon">
                                                <i class="far fa-user-circle fa-2x"></i>
                                                <p>
                                                    <b>{{name}}</b>
                                                </p>
                                            </div>
                                            </router-link>        
                                        <router-link :to="{ name: 'admin' }" class="nav-link" v-else >
                                            <div class = "navbar-icon">
                                                <i class="far fa-user-circle fa-2x"></i>
                                                <p v-if="user_type == 'admin'">
                                                    <b>{{name}}</b>
                                                </p>
                                                <p v-else>
                                                    <b>staff</b>
                                                </p>
                                            </div>
                                        </router-link> 
                                    </span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Đăng nhập</router-link>
                                    <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Đăng ký</router-link>
                                    <span v-if="isLoggedIn">
                                        <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 'user'">Hồ sơ</router-link>
                                        <router-link :to="{ name: 'admin' }" class="nav-link" v-else>Quản lý</router-link>
                                    </span>
                                    <li class="nav-link" v-if="isLoggedIn" @click="logout"> Đăng xuất</li>
                                </div>
                            </div>
                        </div>
                    </div>
            </nav>
            <main class="py-4">
                <ScrollTopArrow></ScrollTopArrow>
                <router-view></router-view>
            </main>
            <footer>
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
            </footer>
        </div>
</template>
<script>
import ScrollTopArrow from './tool_components/scroll-to-top-button/ScrollTopArrow'
import {eventBus} from  '../../app'
import SideMenu from './SideMenu.vue'

    export default {
        name: "layout",
        data() {
            return {
                name: null,
                user_type: 'user',
                isLoggedIn: localStorage.getItem('bigStore.jwt') != null,
                search: '',
                category: 'all',
                dialog: false,
            }
        },
        components: {
            ScrollTopArrow,
            SideMenu,
        },
        created() {
            eventBus.$on('categorySelected', (category) => {
                this.category = category;
                });
        },
        mounted() {
            this.setDefaults()
        },
        watch: {
        dialog(val) {
            val || this.close();
            },
        },
        methods : {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('bigStore.user'))
                    this.name = user.name
                    this.user_type = user.role
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
                this.setDefaults()
            },
            logout() {
                localStorage.removeItem('bigStore.jwt')
                localStorage.removeItem('bigStore.user')
                this.change()
                this.$router.push('/')
            },
            close() {
                this.dialog = false;
            },
        }
    }
</script>

<style scoped>
/**************************
*******Top header CSS******
***************************/
.topbar{
    height: 2.55em;
    background-color: #d2691e;
}
.contactinfo ul li:first-child{
    margin-left: -15px;
}
.contactinfo ul li a{
  font-size: 12px;
  color: #ffff;
}
.contactinfo ul li a p{
   margin-top:0.2em;
   font-weight: bold;
   float: right;
}
.contactinfo ul li a #info{
   color: rgb(0, 200, 200)
}
.contactinfo ul li a:hover{
	background:inherit;
}
.social-icons ul li a {
  border: 0 none;
  border-radius: 0;
  padding:0;
}

.social-icons ul li{
	display:inline-block;
}

.social-icons ul li a i {
  padding: 11px 15px;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}

.social-icons ul li a i:hover{
  color: #ffff;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}

.fa-facebook{
   color: #0083C9;
}
.fa-facebook:hover {
   background: #0083C9;
}

.fa-twitter{
    color: #5BBCEC;
}
.fa-twitter:hover  {
	background:#5BBCEC;
}

.fa-google-plus {
	color:#CE3C2D;
}
.fa-google-plus:hover  {
	background:#CE3C2D;
}

/***************************
*******Main header CSS******
****************************/
.mainbar{
    background-color:rgba(255, 255, 255, 0.9);
}
.mainbar .container{
    margin-top: 1em ;
}
.navbar-brand {
    margin-left: -4em;
}
.navbar-brand #logo{
    float: left;
    margin-right: 0.5em;
}
.navbar-brand #title{
    color: #d2691e;
    padding-top: 0.4em;
}
.navbar-brand :hover{
    opacity: 0.9;
    filter: alpha(opacity=90);
}
.navbar-nav .fa-search{
    color:#ffff
}
.navbar-nav .search-box{
    max-width: 100%;
}
.dropdown #dropdownMenuButton{
    margin-bottom: -2.5em;

}
.dropdown .dropdown-menu{
    min-width: 7.3em;
    text-align: center;
}

.mr-auto{
    margin-left:8em;
    margin-bottom: 0em;
}
.dropdown:hover>.dropdown-menu{
    display: block;
}
.dropdown-menu .nav-link:hover{
    color:#d2691e;
}
.dropdown:hover .navbar-icon{
    color:#d2691e;
}
.cheems-color{
    background-color: #d2691e;
}
.menu{
    position: absolute;
    top: 20%;
    left: 5%;
}
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
/***************************
*******Main footer CSS******
****************************/
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