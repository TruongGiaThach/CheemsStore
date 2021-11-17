  <template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">Login</div>
          <div class="card-body">
            <form>
              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right"
                  >E-Mail Address</label
                >
                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="email"
                    required
                    autofocus
                  />
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Password</label
                >
                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="password"
                    required
                  />
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4 containerflex">
                  <button
                    title="Đăng nhập"
                    type="submit"
                    class="btn btn-primary"
                    @click="handleSubmit"
                  >
                    Đăng nhập
                  </button>
                  <a class="btn btn-link" href="void()" >
                    Forgot Your Password?
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
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

        axios.post("api/login", { email, password }).then((response) => {
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
  },
};
</script>
<style scoped>
.containerflex {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: stretch;
    align-content: stretch;
}
</style>