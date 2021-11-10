  <template>
        <div>
            <main-header></main-header>
            <main class="py-4">
                <ScrollTopArrow></ScrollTopArrow>
                <router-view @loggedIn="change"></router-view>
            </main>
            <main-footer></main-footer>
        </div>
</template>
 <script>
import ScrollTopArrow from './tool_components/scroll-to-top-button/ScrollTopArrow'
import MainHeader from './homepage_components/layout/MainHeader.vue'
import MainFooter from './homepage_components/layout/MainFooter.vue'
    export default {
        data() {
            return {
                name: null,
                user_type: 'user',
                isLoggedIn: localStorage.getItem('bigStore.jwt') != null
            }
        },
        mounted() {
            this.setDefaults()
        },
        components: {
            ScrollTopArrow,
            MainHeader,
            MainFooter,
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
            logout(){
                localStorage.removeItem('bigStore.jwt')
                localStorage.removeItem('bigStore.user')
                this.change()
                this.$router.push('/')
            }
        }
    }
</script>
