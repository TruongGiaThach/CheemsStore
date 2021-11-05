  <template>
        <div>
            <!-- Top bar-->
            <div class ="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main bar -->
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel mainbar">
                    <div class="container">
                        <div class ="brand">
                            <router-link :to="{name: 'home'}" class="navbar-brand">
                                <div>
                                    <img id="logo" :src = "require('../../images/home/logo/CheemsIcons.png').default" width="55em">
                                    <h2 id="title">
                                        <b>Cheems Store</b>
                                    </h2>
                                </div>
                            </router-link>
                        </div>

                        <!-- Left Side Of Navbar -->
                        <div class="navbar-nav mr-auto">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2 " type="search" placeholder="Tìm kiếm..." aria-label="Search" >
                                    <button class="btn btn-warning my-2 my-sm-0 cheems-color" type="submit">
                                        <img :src = "require('../../images/home/icons/icons8-search-90.png').default" width="20em">
                                    </button>
                            </form>
                        </div>

                        <!-- Right Side Of Navbar -->
                        
                        <div class="navbar-nav ml-auto">
                            <div class="dropdown">
                                <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" >
                                    <router-link :to="{ name: 'login' }" class="nav-link">
                                        <div class = "navbar-icon">
                                            <img :src = "require('../../images/home/icons/icons8-sale-90.png').default" width="40em">
                                            <p>
                                                <b>Khuyến mãi</b>
                                            </p>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                            
                            <div class="dropdown" >
                                <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" >
                                    <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">
                                        <div class = "navbar-icon">
                                            <img :src = "require('../../images/home/icons/icons8-heart-90.png').default" width="40em">
                                            <p>
                                                <b>Yêu thích</b>
                                            </p>
                                        </div>
                                    </router-link>
                                    <router-link :to="{ name: 'login' }" class="nav-link" v-if="isLoggedIn">
                                        <div class = "navbar-icon">
                                            <img :src = "require('../../images/home/icons/icons8-heart-90.png').default" width="40em">
                                            <p>
                                                <b>Yêu thích</b>
                                            </p>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" data-offset="100,20">
                                    <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">
                                        <div class = "navbar-icon">
                                            <img :src = "require('../../images/home/icons/icons8-male-user-90.png').default" width="40em">
                                            <p>
                                                <b>Tài khoản</b>
                                            </p>
                                        </div>
                                    </router-link>
                                    <span v-if="isLoggedIn">
                                        <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 0"> 
                                            <div class = "navbar-icon">
                                                <img :src = "require('../../images/home/icons/icons8-male-user-90.png').default" width="40em">
                                                <p>
                                                    <b>{{name}}</b>
                                                </p>
                                            </div>
                                            </router-link>
                                        <router-link :to="{ name: 'admin' }" class="nav-link" v-if="user_type == 1">
                                            <div class = "navbar-icon">
                                                <img :src = "require('../../images/home/icons/icons8-male-user-90.png').default" width="40em">
                                                <p>
                                                    <b>{{name}}</b>
                                                </p>
                                            </div>
                                        </router-link>
                                    </span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Đăng nhập</router-link>
                                    <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Đăng ký</router-link>
                                    <span v-if="isLoggedIn">
                                        <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 0">Hồ sơ</router-link>
                                        <router-link :to="{ name: 'admin' }" class="nav-link" v-if="user_type == 1">Quản lý</router-link>
                                    </span>
                                    <li class="nav-link" v-if="isLoggedIn" @click="logout"> Đăng xuất</li>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </nav>
            <main class="py-4">
                <router-view @loggedIn="change"></router-view>
            </main>
        </div>
</template>
 <script>
    export default {
        data() {
            return {
                name: null,
                user_type: 0,
                isLoggedIn: localStorage.getItem('bigStore.jwt') != null
            }
        },
        mounted() {
            this.setDefaults()
        },
        methods : {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('bigStore.user'))
                    this.name = user.name
                    this.user_type = user.is_admin
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
                this.setDefaults()
            },
            logout(){
                localStorage.removeItem('bigStore.jwt')
                localStorage.removeItem('bigStore.user')
                this.change()
                this.$router.push('/')
            }
        }
    }
</script>

<style scoped>
/**************************
*******Top header CSS******
***************************/
.topbar{
    height: 3em;
    background-color: #d2691e;
}
.header_top {
  background: none repeat scroll 0 0 #F0F0E9;
}

.contactinfo ul li:first-child{
    margin-left: -15px;
}

.contactinfo ul li a{
  font-size: 12px;
  color: #696763;
  font-family: 'Roboto', sans-serif;
}


.contactinfo ul li a:hover{
	background:inherit;
}


.social-icons ul li a {
  border: 0 none;
  border-radius: 0;
  color: #696763;
  padding:0px;
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
  color: #fff;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}


.fa-facebook:hover {
  background: #0083C9;
}

.fa-twitter:hover  {
	background:#5BBCEC;
}

.fa-linkedin:hover  {
	background:#FF4518;
}

.fa-dribbble:hover  {
	background:#90C9DC;
}

.fa-google-plus:hover  {
	background:#CE3C2D;
}

/***************************
*******Main header CSS******
****************************/
.mainbar{
    height: 5em;
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
.dropdown .dropdown-menu{
    min-width: 6.2em;
}
.navbar-nav{
    margin-bottom: -2em;
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
.navbar-nav .navbar-icon{
    filter: 
    invert(47%) 
    sepia(15%) 
    saturate(7%) 
    hue-rotate(59deg) 
    brightness(103%) 
    contrast(89%);
}
.navbar-nav .navbar-icon:hover{
    filter: 
    invert(45%) 
    sepia(26%) 
    saturate(2077%)
    hue-rotate(349deg) 
    brightness(96%) 
    contrast(88%);
}
.cheems-color{
    background-color: #d2691e;
}

</style>