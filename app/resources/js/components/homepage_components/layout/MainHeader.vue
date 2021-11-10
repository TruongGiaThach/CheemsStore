<template>
<div>
    <top-header></top-header>
    <!-- Main bar -->
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel mainbar sticky-top">
            <div class="container">
                <div class ="brand">
                    <router-link :to="{name: 'home'}" class="navbar-brand">
                        <div>
                            <img id="logo" :src = "require('../../../../../public/images/CheemsIcons.png').default" width="55em">
                            <h2 id="title">
                                <b>Cheems Store</b>
                            </h2>
                        </div>
                    </router-link>
                </div>

                <!-- Left Side Of Navbar -->
                <div class="navbar-nav mr-auto">
                    <form class="form-inline search-box">
                        <input class="form-control mr-sm-2 " type="search" placeholder="Nhập từ khóa cần tìm" aria-label="Search" size="50">
                        <button class="btn btn-warning my-2 my-sm-0 cheems-color" type="submit">
                            <i class="fas fa-search fa-lg"></i>
                        </button>
                    </form>
                </div>

                <!-- Right Side Of Navbar -->
                
                <div class="navbar-nav ml-auto">
                    <div class="dropdown">
                        <div class="btn dropdown " id="dropdownMenuButton" aria-expanded="false" >
                            <router-link :to="{ name: 'category' }" class="nav-link">
                                <div class = "navbar-icon">
                                    <i class="fas fa-tag fa-2x"></i>
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
                                    <i class="fas fa-heart fa-2x"></i>
                                    <p>
                                        <b>Yêu thích</b>
                                    </p>
                                </div>
                            </router-link>
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="isLoggedIn">
                                <div class = "navbar-icon">
                                    <i class="fas fa-heart fa-2x"></i>
                                    <p>
                                        <b>Yêu thích</b>
                                    </p>
                                </div>
                            </router-link>
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
</div>
    
</template>
<script>
import TopHeader from './TopHeader.vue'
export default {
    components:{
        TopHeader
    },
}
</script>
<style scoped>
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
</style>