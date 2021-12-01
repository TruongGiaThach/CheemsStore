 <!DOCTYPE html>
 <template>
  <div class="dashboard">
    <v-app id="inspire">
      <v-app-bar
        app
        absolute
        elevate-on-scroll
        scroll-target="#scrolling-techniques-7"
      >
        <v-toolbar-title>Cheems Store</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-menu left bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn icon v-bind="attrs" v-on="on">
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item active-class="" @click="() => {}">
              <v-btn @click="toggleTheme" text rounded>
                {{ this.$vuetify.theme.dark ? "Light mode" : "Dark mode" }}
              </v-btn>
            </v-list-item>
            <v-list-item active-class="" @click="() => {}">
              <v-list-item-title>Settings</v-list-item-title>
            </v-list-item>
            <v-list-item active-class="" @click="logout()">
              <v-list-item-title>Log out</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-app-bar>
      <v-navigation-drawer
        v-model="drawer"
        app
        dark
        permanent
        expand-on-hover
        src="https://papers.co/wallpaper/papers.co-md49-wallpaper-nature-earth-dark-asleep-mountain-night-34-iphone6-plus-wallpaper.jpg"
      >
        <v-list>
          <v-list-item class="px-2">
            <v-list-item-avatar color="grey darken-1">
              <v-img :src="image_user" alt="" />
            </v-list-item-avatar>
            <v-list-item-title>{{
              user.role == "admin" ? "(Quản lí)" : "(Nhân viên)"
            }}</v-list-item-title>
          </v-list-item>

          <v-divider></v-divider>

          <v-list-item link>
            <v-list-item-content>
              <v-list-item-title class="text-h6" color="#f1faee">
                {{ user != null ? user.name : "admin" }}
              </v-list-item-title>
              <v-list-item-subtitle>{{
                user != null ? user.gmail : "admin@gmail.com"
              }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list>
          <v-list-item link @click="setComponent(checkComponent)">
            <v-list-item-icon>
              <v-icon>{{ iconDashBoard }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ textDashBoard }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-group :value="true" no-action color="colors">
            <template v-slot:activator>
              <v-list-item-icon>
                <v-icon>mdi-domain</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>{{ textOrder }}</v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item
              v-for="([icon, text, page], i) in Nav_bar_order"
              :key="i"
              link
              @click="setComponent(page)"
            >
              <v-list-item-icon>
                <v-icon v-text="icon"></v-icon>
              </v-list-item-icon>
              <v-list-item-title v-text="text"></v-list-item-title>
            </v-list-item>
          </v-list-group>
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
      <v-sheet id="scrolling-techniques-7" class="overflow-y-auto">
        <v-main class="grey lighten-3">
          <component :is="activeComponent"></component>
        </v-main>
      </v-sheet>
    </v-app>
  </div>
</template>

<script>
import Main from "./admin/Main";
import Users from "./admin/Users";
import Products from "./admin/Products";
import Orders from "./admin/Orders";
import CreateOrder from "./admin/order_components/createOrder";
import Staffs from "./admin/Staffs";
import Customers from "./admin/Customers";
export default {
  data() {
    return {
      checkComponent: "dashboard",
      iconDashBoard: "mdi-monitor-dashboard",
      textDashBoard: "Bảng điều khiển",
      textOrder: "Kinh doanh",
      colors: "white",
      image_user: "/images/CheemsIcons.png",
      user: null,
      activeComponent: null,
      drawer: true,
      Nav_bar_items: [
        ["mdi-store-search", "Sản phẩm", "products"],
        ["mdi-account-group", "Khách hàng", "customers"],
         ["mdi-account", "Tài khoản", "users"],
        ["mdi-account-cog-outline", "Nhân viên", "staffs"],
      ],
      Nav_bar_order: [
        ["mdi-cart-plus", "Bán hàng", "createOrder"],
        ["mdi-clipboard-check-multiple-outline", "Hóa đơn", "orders"],
      ],
    };
  },
  components: {
    Main,
    Products,
    Customers,
    Orders,
    CreateOrder,
    Staffs,
    Users,
  },
  beforeMount() {
    this.setComponent(this.$route.params.page);
    this.user = JSON.parse(localStorage.getItem("bigStore.user"));
    axios.defaults.headers.common["Content-Type"] = "application/json";
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + localStorage.getItem("bigStore.jwt");
    this.getImage();
    if (this.user.role == "staff") {
      this.Nav_bar_items.pop();
      this.Nav_bar_items.pop();
   
    }
  },
  methods: {
    getImage() {
      this.user = JSON.parse(localStorage.getItem("bigStore.user"));
      if (this.user.role == "admin") this.image_user = "/images/admin.png";
      else this.image_user = "/images/CheemsIcons.png";
      console.log(2);
    },
    toggleTheme() {
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
    },
    setComponent(value) {
      switch (value) {
        case "dashboard":
          this.activeComponent = Main;
          if (this.$route.path != "/admin/main")
            this.$router.push({
              name: "admin-pages",
              params: { page: "main" },
            });

          break;
        case "users":
          this.activeComponent = Users;
          if (this.$route.path != "/admin/users")
            this.$router.push({
              name: "admin-pages",
              params: { page: "users" },
            });
          break;
        case "orders":
          this.activeComponent = Orders;
          if (this.$route.path != "/admin/orders")
            this.$router.push({
              name: "admin-pages",
              params: { page: "orders" },
            });
          break;
        case "products":
          this.activeComponent = Products;
          if (this.$route.path != "/admin/products")
            this.$router.push({
              name: "admin-pages",
              params: { page: "products" },
            });
          break;
        case "createOrder":
          this.activeComponent = CreateOrder;
          if (this.$route.path != "/admin/createOrder")
            this.$router.push({
              name: "admin-pages",
              params: { page: "createOrder" },
            });
          break;
        case "staffs":
          this.activeComponent = Staffs;
          if (this.$route.path != "/admin/staffs")
            this.$router.push({
              name: "admin-pages",
              params: { page: "staffs" },
            });
          break;
        case "customers":
          this.activeComponent = Customers;
          if (this.$route.path != "/admin/customers")
            this.$router.push({
              name: "admin-pages",
              params: { page: "customers" },
            });
          break;
        default:
          this.activeComponent = Main;
          if (this.$route.path != "/admin") {
            this.$router.push("/admin");
          }
          break;
      }
    },
    setDefaults() {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("bigStore.user"));
        this.name = user.name;
        this.user_type = user.role;
        this.getImage();
      }
    },
    change() {
      this.isLoggedIn = localStorage.getItem("bigStore.jwt") != null;
      this.setDefaults();
    },
    logout() {
      let user = JSON.parse(localStorage.getItem("bigStore.user"));
      axios.patch("/api/users/", { email: user.email }).catch((response) => {});
      localStorage.removeItem("bigStore.jwt");
      localStorage.removeItem("bigStore.user");

      this.change();
      this.$router.push("/");
    },
  },
};
</script>

<style scoped>
.hero-section {
  height: 20vh;
  background: seagreen;
  align-items: center;
  margin-bottom: 20px;
  margin-top: -20px;
}
.title {
  font-size: 60px;
  color: #ffffff;
}
</style>
