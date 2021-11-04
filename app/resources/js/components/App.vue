  <template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand">
                        <div>
                            <img id="logo" :src = "require('../../images/home/logo/CheemsIcons.png').default" width="55em">
                            <h2 id="title">
                                <b>Cheems Store</b>
                            </h2>
                        </div>
                    </router-link>

                    <!-- Left Side Of Navbar -->
                    <div class="navbar-nav mr-auto">

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

.dropdown:hover>.dropdown-menu{
    display: block;
}
.dropdown-menu .nav-link:hover{
    color:#d2691e;
}
.navbar-nav .navbar-icon{
    filter: invert(47%) sepia(15%) saturate(7%) hue-rotate(59deg) brightness(103%) contrast(89%);
}
.navbar-nav .navbar-icon:hover{
    filter: invert(45%) sepia(26%) saturate(2077%) hue-rotate(349deg) brightness(96%) contrast(88%);
}
</style>