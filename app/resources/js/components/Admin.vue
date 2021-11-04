 <!DOCTYPE html>
 <template>
    <div class="dashboard">
        <v-app id="inspire">
            <v-app-bar app
                absolute
                color="white"
                elevate-on-scroll
                    elevation-4
            >
                <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

                <v-toolbar-title>Admin Dashboard</v-toolbar-title>

                <v-spacer></v-spacer>
                
            </v-app-bar>
                <v-navigation-drawer
                    v-model="drawer"
                    app
                >
                    <v-img src="" class="pa-4">
                        <div class="text-center mt-4">
                            <v-avatar class="mb-4" color="grey darken-1" size="64">
                                <v-img aspect-ratio="30" src="" />
                            </v-avatar>
                            <h1>
                                {{ user!=null?user.name:"admin" }}
                            </h1>
                        </div>
                    </v-img>

                    <v-divider></v-divider>

                        <v-list>
                            <v-list-item
                                v-for="[icon, text, page] in Nav_bar_items"
                                :key="icon"
                                    link
                                @click="setComponent(page)"
                            >
                                <v-list-item-icon>
                                    <v-icon>{{ icon }}</v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title>{{ text }}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                </v-navigation-drawer>
                <v-main>
                    <div class="dashboard-content">
                        <component :is="activeComponent"></component>
                    </div>
                </v-main>
        </v-app>
    </div>
</template>

<script>
    import Main from './admin/Main'
    import Users from './admin/Users'
    import Products from './admin/Products'
    import Orders from './admin/Orders'

    export default {
        data() {
            return {
                user: null,
                activeComponent: null,
                drawer: true,
                Nav_bar_items: [
                    ['mdi-paper-roll', 'Orders', 'orders'],
                    ['mdi-store-search', 'Product', 'products'],
                    ['mdi-account-group', 'users', 'users'],
                ],
            }
        },
        components: {
            Main, Users, Products, Orders
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('bigStore.  d fuser'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
</script>

<style scoped>
.hero-section { height: 20vh; background: seagreen; align-items: center; margin-bottom: 20px; margin-top: -20px; }
.title { font-size: 60px; color: #ffffff; }
.dashboard {
    background-color: seagreen;
    height: 100vh;
    width: 100vw;
}

</style>