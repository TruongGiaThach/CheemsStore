  <template>
  <div>
    <div class="row no-gutter">
      <!-- The image half -->
      <div class="col-md-7 d-none d-md-flex bg-image"></div>
      <!-- The content half -->
      <div class="col-md-5 bg-light">
        <div class="login d-flex align-items-center py-5">
          <!--  content-->
          <div class="container">
            <div class="row">
              <div class="col-lg-10 col-xl-7 mx-auto">
                <h3 class="display-4">Cheems Store</h3>
                <p class="text-muted mb-4">
                  Ứng dụng quản lí đáng tin cậy đến từ Cheems family
                </p>
                <form>
                  <div class="form-group mb-3">
                    <input
                      id="email"
                      type="email"
                      v-model="email"
                      placeholder="Địa chỉ email"
                      required
                      autofocus
                      class="form-control rounded-pill border-0 shadow-sm px-4"
                    />
                  </div>
                  <div class="form-group mb-3">
                    <input
                      id="password"
                      type="password"
                      placeholder="Mật khẩu"
                      v-model="password"
                      title="Đăng nhập"
                      required
                      class="
                        form-control
                        rounded-pill
                        border-0
                        shadow-sm
                        px-4
                        text-primary
                      "
                    />
                  </div>
                  <div class="custom-control custom-checkbox mb-3">
                    <input
                      id="customCheck1"
                      type="checkbox"
                      checked
                      class="custom-control-input"
                    />
                    <label for="customCheck1" class="custom-control-label"
                      >Nhớ mật khẩu</label
                    >
                  </div>
                  <button
                    type="submit"
                    class="
                      btn btn-primary btn-block
                      text-uppercase
                      mb-2
                      rounded-pill
                      shadow-sm
                      btn-lg
                    "
                    @click="handleSubmit"
                  >
                    Đăng nhập
                  </button>
                  <div class="text-center d-flex justify-content-between mt-4">
                    <p>
                      Tạo bởi
                      <a href="https://youtu.be/tzYPr9w22VU" class="font-italic text-muted">
                        <u>Cheems family</u></a
                      >
                    </p>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End -->
        </div>
      </div>
      <!-- End -->
    </div>
  </div>
</template>
  
<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    handleSubmit(e) {
      e.preventDefault();
      if (this.password.length > 0) {
        let email = this.email;
        let password = this.password;

        axios
          .post("api/login", { email, password })
          .then((response) => {
            let user = response.data.user;
            let role = user.role;
            console.log(role);
            localStorage.setItem("bigStore.user", JSON.stringify(user));
            localStorage.setItem("bigStore.jwt", response.data.token);

          if (localStorage.getItem("bigStore.jwt") != null) {
            this.$emit("loggedIn");
            this.$router.push({
              name: "admin-pages",
              params: { page: "main" },
            });
          }
        });
      }
    },
    clear() {
      // you can use this method to clear login form
      this.email = "";
      this.password = null;
      this.$refs.observer.reset();
    },
    validate: function () {
      this.emailBlured = true;
      this.passwordBlured = true;
      if (this.validEmail(this.email) && this.validPassword(this.password)) {
        this.valid = true;
      }
    },

    validEmail: function (email) {
      var re = /(.+)@(.+){2,}\.(.+){2,}/;
      if (re.test(email.toLowerCase())) {
        return true;
      }
    },

    validPassword: function (password) {
      if (password.length > 5) {
        return true;
      }
    },
  },
};
</script>
<style scoped>
.login,
.image {
  min-height: 100vh;
}
.bg-image {
  background-image: url("https://therichpost.com/wp-content/uploads/2021/02/login-split.jpg");
  background-size: cover;
  background-position: center center;
}
</style>