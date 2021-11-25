<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-card-title>
      <v-spacer></v-spacer>
    </v-card-title>
    <div
      style="width: 80%; align: center; margin-left: auto; margin-right: auto"
    >
      <v-data-table
        :headers="headers"
        :items="staffs"
        :search="search"
        item-key="email"
        rounded-xl
        class="elevation-1"
        min-height="70vh"
      >
        <!-- dialog thêm thông tin nhân viên -->
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title class="info--text">Nhân viên</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Tìm kiếm nhân viên"
              single-line
              hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  class="mb-2"
                  v-bind="attrs"
                  v-on="on"
                >
                  Thêm nhân viên mới
                </v-btn>
              </template>
              <ValidationObserver ref="observer" v-slot="{ invalid }">
                <v-card class="elevation-12">
                  <v-card-title class="bg-info mx-auto" max-width="inherit">
                    <span class="text-h5 mx-auto white--text">
                      {{ formTitle }}</span
                    >
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <V-form @submit.prevent="save">
                        <v-row>
                          <v-col cols="12" sm="6" md="4">
                            <ValidationProvider
                              v-slot="{ errors }"
                              name="name"
                              rules="required"
                            >
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.name"
                                label="Tên nhân viên"
                                required
                              ></v-text-field>
                            </ValidationProvider>
                          </v-col>
                          <v-col cols="12" sm="6" md="4"></v-col>
                          <v-col cols="12" sm="6" md="4"></v-col>
                          <v-col cols="12" sm="6" md="4">
                            <ValidationProvider
                              v-slot="{ errors }"
                              name="email"
                              rules="required|email"
                            >
                              <v-text-field
                                v-model="editedItem.email"
                                label="Email"
                                type="text"
                                :error-messages="errors"
                                required
                                :disabled="editedIndex != -1"
                              ></v-text-field>
                            </ValidationProvider>
                          </v-col>
                          <v-col cols="12" sm="6" md="4">
                            <ValidationProvider
                              v-slot="{ errors }"
                              name="cmnd"
                              rules="required|numeric"
                            >
                              <v-text-field
                                v-model="editedItem.cmnd"
                                label="CMND"
                                type="text"
                                :disabled="editedIndex != -1"
                                :error-messages="errors"
                                required
                              ></v-text-field>
                            </ValidationProvider>
                          </v-col>
                          <v-col cols="12" sm="6" md="4">
                            <v-text-field
                              v-model="editedItem.salary"
                              label="Mức lương"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="6" md="4">
                            <v-text-field
                              v-model="editedItem.numOfDayOff"
                              label="Số ngày nghỉ"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </V-form>
                    </v-container>
                  </v-card-text>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">
                      Cancel
                    </v-btn>
                    <v-btn
                      color="blue darken-1"
                      type="submit"
                      text
                      @click="save"
                      :disabled="invalid"
                    >
                      Save
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </ValidationObserver>
            </v-dialog>
            <!-- dialog khi xóa 1 row -->
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                    >OK</v-btn
                  >
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
        <!-- delete edit button -->
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
        </template>
        <!-- reload -->
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize"> Reset </v-btn>
        </template>
      </v-data-table>
    </div>
  </v-card>
</template>

<script>
import {
  required,
  digits,
  max,
  regex,
  email,
  numeric,
} from "vee-validate/dist/rules";
import {
  extend,
  ValidationObserver,
  ValidationProvider,
  setInteractionMode,
} from "vee-validate";
setInteractionMode("eager");

extend("max", {
  ...max,
  message: "{_field_} Không quá {length} kí tự. ({_value_})",
});

extend("required", {
  ...required,
  message: "{_field_} không được để trống",
});

extend("numeric", {
  ...numeric,
  message: "{_field_} chỉ được nhập số",
});
extend("email", {
  ...email,
  message: "Email cần nhập đúng",
});
extend("regex", {
  ...regex,
  message: "{_field_} {_value_} does not match {regex}",
});

export default {
  data() {
    return {
      search: "",
      headers: [
        {
          text: "Name",
          align: "start",
          sortable: false,
          value: "name",
          class: "info--text",
        },
        { text: "Email", value: "email", class: "info--text" },
        { text: "CMND", value: "cmnd", class: "info--text" },
        { text: "Số ngày nghỉ", value: "numOfDayOff", class: "info--text" },
        { text: "Lương", value: "salary", class: "info--text" },
        { text: "Ngày vào làm", value: "dateBegin", class: "info--text" },
        {
          text: "Actions",
          value: "actions",
          sortable: false,
          class: "info--text",
        },
      ],
      state: true,
      staffs: [],
      editingItem: null,
      addingUser: null,
      dialog: false,
      dialogDelete: false,
      editedIndex: -1,
      editedItem: {
        _id: "",
        name: "",
        email: "",
        cmnd: "",
        numOfDayOff: 0,
        salary: 0,
        dateBegin: new Date(Date.now()).toLocaleString().split(",")[0],
      },
      defaultItem: {
        _id: "",
        name: "",
        email: "",
        cmnd: "",
        numOfDayOff: 0,
        salary: 0,
        dateBegin: new Date(Date.now()).toLocaleString().split(",")[0],
      },
    };
  },
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Thêm nhân viên"
        : "Sửa thông tin nhân viên";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },
  beforeMount() {
    axios
      .get("/api/staffs")
      .then((response) => {
        this.staffs = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    initialize() {
      axios
        .get("/api/staffs")
        .then((response) => {
          this.staffs = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    deleteItem(item) {
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
      console.log("deleteItem");
    },

    deleteItemConfirm() {
      this.deleteUser();
      this.deleteStaff();
      console.log("deleteItemConfirm");
      this.closeDelete();
    },
    //close save user
    close() {
      this.$refs.observer.reset();
      this.dialog = false;
      this.initialize();
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    //close delete user
    closeDelete() {
      this.dialogDelete = false;
      this.initialize();
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    editItem(item) {
      this.editedIndex = this.staffs.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    endEditing(staff) {
      this.editingItem = null;
      axios
        .put(`/api/staffs/${staff._id}`, {
          name: staff.name,
          numOfDayOff: staff.numOfDayOff,
          salary: staff.salary,
        })
        .catch((response) => {});
    },
    addStaff() {
      //add staff

      let index = -1;
      index = this.staffs.findIndex(
        (staff) => staff.email == this.editedItem.email
      );
      if (index != -1) {
        alert("Email đã được sử dụng. Vui lòng dùng email khác");
      } else
        axios
          .post("/api/staffs", {
            name: this.editedItem.name,
            email: this.editedItem.email,
            cmnd: this.editedItem.cmnd,
            numOfDayOff: this.editedItem.numOfDayOff,
            salary: this.editedItem.salary,
            dateBegin: this.editedItem.dateBegin,
          })
          .then((response) => {
            if (response.data.status == false) {
              alert("Lỗi bất ngờ khi thêm nhân viên");
            }
          });
    },
    async save() {
      const reuslt = await this.$refs.observer.validate();

      if (this.editedIndex > -1) {
        this.endEditing(this.editedItem);
      } else {
        this.addStaff(this.editedItem);
      }
      this.initialize();
      this.close();
    },
    deleteStaff() {
      axios.delete(`/api/staffs/${this.editedItem.email}`).then((response) => {
        if (response.status == true) {
          alert("Đã xóa nhân viên");
        }
      });
    },
    deleteUser() {
      console.log(this.editedItem.email),
        axios.delete(`/api/users/${this.editedItem.email}`).then((response) => {
          console.log(response.message);
        });
    },
  },
};
</script>