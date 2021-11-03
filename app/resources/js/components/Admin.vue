 <template>
        <div>
            <div class="dashboard">
                <div class="sidebar">
                    <div class="sidebar-title">
                        Menu
                    </div>
                    <div class="sidebar-menu-items">
                        <button active-class="active" class="sidebar-menu-items-button" @click="setComponent(oders)">
                            <div class="link-container">
                                Orders
                            </div>
                        </button>
                        <button active-class="active" class="sidebar-menu-items-button" @click="setComponent(products)">
                            <div class="link-container">
                                Products
                            </div>
                        </button>
                        <button active-class="active" class="sidebar-menu-items-button" @click="setComponent(users)">
                            <div class="link-container">
                                Users
                            </div>
                        </button>
                    </div>
                </div>
                <div class="dashboard-content">
                    
                </div>
            </div>
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
                activeComponent: null
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
.hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
.title { font-size: 60px; color: #ffffff; }
.dashboard {
    display: grid;
    grid-template-columns: 1fr 5fr;
    background-color: seagreen;
    height: 100vh;
    width: 100vw;
}

.sidebar-title {
    color: white;
    font-size: 24px;
    margin-top: 10px;
    text-align: center;
}

.sidebar-menu-items {
    display: flex;
    flex-direction: column;
    margin-top: 40px;
}

.sidebar-menu-items > * {
    margin-top: 60px;
}

.dashboard-content {
    background-color: white;
    border-radius: 10px;
    margin: 6px 6px 6px 6px;
}

.sidebar-menu-items-button:focus {
    outline: none;
}

.sidebar-menu-items-button.active {
    background-color: white;
    color: seagreen;
    font-weight: 500;
}

.sidebar-menu-items-button {
    border: none;
    padding: 10px 8px;
    cursor: pointer;
    font-size: 16px;
    color: white;
}

</style>