<template>
  <v-card class="content">
    <v-card-title
      max-width="inherit"
      style="background-color: #2196f3; height: 150px"
    ></v-card-title>
    <div class="avatar">
      <img class="img" :src="baseUrl + '/images/ganyu.jpg'" />
    </div>

    <v-card-text class="changeFont">
      <v-row>
        <v-col cols="12" sm="3"
          ><v-icon color="rgb(33, 150, 243)">mdi-star-outline</v-icon></v-col
        >
        <v-col cols="12" sm="6"
          ><h3 style="margin-bottom: 0px" class="commonFont">
            {{ staff.name }}
          </h3></v-col
        >
        <v-col cols="12" sm="3"
          ><v-icon color="#2196f3">mdi-star-outline</v-icon></v-col
        >
      </v-row>
      <h6 style="color: #2196f3" class="commonFont">{{ staff.position }}</h6>
      <br />
      <br />
      <p class="commonFont mx-auto" style="width: 80%">
        {{ description }}
      </p>
      <h6 class="commonFont">{{ staff.email }}</h6>
      <h6 class="commonFont">{{ staff.dateBegin }}</h6>
    </v-card-text>
    <v-card-actions>
      <v-btn class="buttonFont" rounded color="primary" small @click="logOut">
        Đăng xuất
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn
        class="buttonFont"
        rounded
        color="primary"
        small
        @click="changePassword"
      >
        Đổi mật khẩu
      </v-btn>
    </v-card-actions>
    <v-dialog v-model="dialog" max-width="500px">
      <ValidationObserver ref="observer" v-slot="{ invalid }">
        <v-card class="elevation-12">
          <v-card-title class="bg-info mx-auto" max-width="inherit">
            <span class="text-h5 mx-auto white--text"> Đổi mật khẩu</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <V-form @submit.prevent="save">
                <v-row>
                  <v-col cols="12" sm="8" md="10">
                    <ValidationProvider
                      v-slot="{ errors }"
                      name="password"
                      rules="max:10"
                      vid="password"
                    >
                      <v-text-field
                        v-model="password"
                        label="Mật khẩu cũ"
                        :error-messages="errors"
                        required
                        type="password"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="12" sm="8" md="10">
                    <ValidationProvider
                      v-slot="{ errors }"
                      name="password"
                      rules="max:10"
                      vid="password"
                    >
                      <v-text-field
                        v-model="newPassword"
                        label="Mật khẩu mới"
                        :error-messages="errors"
                        required
                        type="password"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="12" sm="8" md="10">
                    <ValidationProvider
                      v-slot="{ errors }"
                      name="c_password"
                      rules="confirmed:password"
                      data-vv-as="password"
                    >
                      <v-text-field
                        v-model="c_password"
                        label="Xác nhân mật khẩu"
                        type="password"
                        :error-messages="errors"
                        required
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
              </V-form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="close"> Hủy </v-btn>
            <v-btn
              color="blue darken-1"
              type="submit"
              text
              @click="save"
              :disabled="invalid"
            >
              Lưu
            </v-btn>
          </v-card-actions>
        </v-card>
      </ValidationObserver>
    </v-dialog>
  </v-card>
</template>
<script>
import { max, email, confirmed} from "vee-validate/dist/rules";
import {
  extend,
  ValidationObserver,
  ValidationProvider,
} from "vee-validate";
extend("confirmed", {
  ...confirmed,
  message: "Mật khẩu không khớp.",
});
extend("max", {
  ...max,
  message: "{_field_} Không quá {length} kí tự. ({_value_})",
});
extend('email', {
  ...email,
  message: 'Email cần nhập đúng',
});
export default {
  props: {
      staff: [],
  },
  data() {
    return {
      dialog: false,
      password: "",
      c_password: "",
      newPassword: "",
      role: "WIBU CHÚA",
      name: "Dũng kun",
      email: "email@gmail.com",
      description:
        "Dũng kun đẹp trai, ngày xưa ai lá ngọc cành vàng, ngày nay ai đẹp bằng Dkun ha",
      baseUrl: window.location.origin,
    };
  },
  methods: {
    logOut() {
      localStorage.removeItem("bigStore.jwt");
      localStorage.removeItem("bigStore.user");
      this.$router.push("/");
    },
    changePassword() {
      this.password="",
      this.c_password="",
      this.newPassword="",
      this.dialog = true;
    },
    close()
    {
        this.dialog=false;
    },
    save()
    {
      axios.post("/api/updateUsers/" +`${this.email}`,{
          newPassword: this.newPassword,
      })
      .then((response)=>{
          console.log(response.data);
          if(response.data!=null) alert("Đổi mật khẩu thành công")
      })
    },

  },
  components: {
    ValidationProvider,
    ValidationObserver,
  },
};
</script>
<style>
.content {
  display: inline-block;
  position: relative;
  margin-top: 20px;
}
.avatar {
  display: block;
  width: 200px;
  height: 200px;
  overflow: hidden;
  margin-top: -100px;
  margin-left: auto;
  margin-right: auto;
}
.img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border-color: #ffffff;
  border-width: 2px;
  border-style: solid;
}
.changeFont {
  text-align: center;
}
.commonFont {
  text-align: center;
  color: black;
}
.buttonFont {
  font-family: "Roboto";
  margin-left: 30px;
  margin-right: 30px;
  margin-bottom: 10px;
}
</style>
