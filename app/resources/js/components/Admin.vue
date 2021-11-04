 <!DOCTYPE html>
 <template>
    <div class="dashboard">
        <v-app id="inspire">
            <v-app-bar app
                absolute
                color="white"
                elevate-on-scroll
                scroll-target="#scrolling-techniques-7"
            >
                <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

                <v-toolbar-title>Admin Dashboard</v-toolbar-title>

                <v-spacer></v-spacer>
                
            </v-app-bar>
                <v-navigation-drawer v-model="drawer" app permanent expand-on-hover>
                    
                    <v-list>
                        <v-list-item class="px-2">
                            <v-list-item-avatar color="grey darken-1">
                                <v-img src="" />
                            </v-list-item-avatar>
                        </v-list-item>

                        <v-list-item link>
                            <v-list-item-content>
                                <v-list-item-title class="text-h6">
                                    {{ user!=null?user.name:"admin" }}
                                </v-list-item-title>
                                <v-list-item-subtitle>{{ user!=null?user.gmail:"admin@gmail.com" }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                        
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
                <v-sheet
                    id="scrolling-techniques-7"
                    class="overflow-y-auto"
                    max-height="600"
                >
                    <v-main>
                            <component :is="activeComponent"></component>
                    </v-main>
                </v-sheet>
        </v-app>
    </div>
</template>

<script>
    import Main from './admin/Main'
    import Users from './admin/Users'
    import Products from './admin/Products'
    import Orders from './admin/Orders'
    import Statistic from './admin/Statistic'

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
                    ['mdi-chart-line','Statistic','statistic'],
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
                    case "statistic":
                        this.activeComponent = Statistic
                        this.$router.push({name: 'admin-pages', params: {page: 'statistic'}})
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

</style>