<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <div
      style="width: 80%; align: center; margin-left: auto; margin-right: auto"
    >
      <v-data-table
        :headers="headers"
        :items="users"
        :search="search"
        :expanded.sync="expanded"
        :single-expand="singleExpand"
        item-key="email"
        show-expand
        rounded-xl
        class="elevation-1"
        min-height="70vh"
      >
        <template v-slot:[`item.state`]="{ item }">
          <v-chip :color="getColor(item.state)">
             <span v-if="item.state === 'active'">
               Đang hoạt động
             </span>
              <span v-if="item.state === 'inactive'">
               Đã thoát
              </span>
          </v-chip>
        </template>

        <!-- dialog thêm tài khoản và thông tin nhân viên -->
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Tài khoản</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
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
                  Tạo tài khoản mới
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="text-h5">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.name"
                          label="Tên nhân viên"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4"></v-col>
                      <v-col cols="12" sm="6" md="4"></v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.email"
                          label="Email"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.password"
                          label="Mật khẩu"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.c_password"
                          label="Xác nhân mật khẩ"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.cmnd"
                          label="CMND"
                        ></v-text-field>
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
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">
                    Cancel
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
                </v-card-actions>
              </v-card>
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
        <!-- expand 1 row -->
        <template v-slot:expanded-item="{ headers, item }">
          <td :colspan="headers.length">
            <table class="table_style">
              <tr>
                <h3>Thông tin nhân viên {{ item.name }}</h3>
              </tr>
              <tr>
                <div v-for="staff in staffs" :key="staff.id">
                  <v-list class="text-justify" v-if="staff.email == item.email">
                    <tr>
                      <td>Email:</td>
                      <td>
                        {{ staff.email }}
                      </td>
                    </tr>
                    <tr>
                      <td>CMND:</td>
                      <td>
                        {{ staff.cmnd }}
                      </td>
                    </tr>
                    <tr>
                      <td>Số ngày nghỉ:</td>
                      <td>
                        {{ staff.numOfDayOff }}
                      </td>
                    </tr>
                    <tr>
                      <td>Mức lương:</td>
                      <td>
                        {{ staff.salary }}
                      </td>
                    </tr>
                    <tr>
                      <td>Ngày vào làm:</td>
                      <td>
                        {{ staff.dateBegin }}
                      </td>
                    </tr>
                  </v-list>
                </div>
              </tr>
            </table>
          </td>
        </template>
        <!-- delete button -->
        <template v-slot:[`item.actions`]="{ item }">
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
        },
        { text: "Email", value: "email" },
        { text: "Role", value: "role" },
        { text: "Actions", value: "actions", sortable: false },
        { text: "Trạng thái", value: "state" },
      ],
      state: true,
      users: [],
      staffs: [],
      editingItem: null,
      addingUser: null,
      dialog: false,
      dialogDelete: false,
      expanded: [],
      singleExpand: true,
      editedIndex: -1,
      editedItem: {
        name: "",
        email: "",
        password: "",
        c_password: "",
        cmnd: "",
        numOfDayOff: 0,
        salary: 0,
        dateBegin: new Date(Date.now()).toLocaleString().split(",")[0],
      },
      defaultItem: {
        name: "",
        email: "",
        password: "",
        c_password: "",
        cmnd: "",
        numOfDayOff: 0,
        salary: 0,
        dateBegin: new Date(Date.now()).toLocaleString().split(",")[0],
      },
    };
  },
  computed: {
    formTitle() {
      return "Thêm nhân viên";
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
      .get("/api/users")
      .then((response) => {
        this.users = response.data;
        console.log(this.users[0]._id);
      })
      .catch((error) => {
        console.error(error);
      });
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
    creat_default_editing_item() {
      this.editedItem = Object.assign({}, this.defaultItem);
      this.editedIndex = -1;
    },
    getColor(state) {
      if (state == "active") return "#01D145";
      else if (state == "inactive") return "#FAE5F3"
      else  return "#D1018D";
     
    },
    initialize() {
      axios
        .get("/api/users")
        .then((response) => {
          this.users = response.data;
          console.log(this.users[1].id);
        })
        .catch((error) => {
          console.error(error);
        });
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
      this.dialog = false;
      this.initialize();
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
    async addUser() {
      //add user

      let index = -1;
      index = this.users.findIndex((i) => i.email == this.editedItem.email);
      console.log(this.editedItem);
      if (index != -1) {
        alert("Email đã có tài khoản. Vui lòng dùng email khác");
        return;
      } else
        await axios
          .post("/api/register", {
            name: this.editedItem.name,
            email: this.editedItem.email,
            password: this.editedItem.password,
            c_password: this.editedItem.c_password,
            role: "staff",
            state: "inactive",
          })
          .catch((response) => {
            if (response.user == null) {
              alert("Lỗi bất ngờ khi thêm tài khoản");
            }
          });
    },
    async addStaffAndUserAccount() {
      //add staff

      console.log("when add staff");
      console.log(this.editedItem);
      let index = -1;
      index = this.staffs.findIndex(
        (staff) => staff.email == this.editedItem.email
      );
      if (index != -1) {
        this.addUser();
      } else
        await axios
          .post("/api/staffs/", {
            name: this.editedItem.name,
            email: this.editedItem.email,
            cmnd: this.editedItem.cmnd,
            numOfDayOff: this.editedItem.numOfDayOff,
            salary: this.editedItem.salary,
            dateBegin: this.editedItem.dateBegin,
          })
          .catch((response) => {
            if (response.data.status == false) {
              alert("Lỗi bất ngờ khi thêm nhân viên");
              return;
            }
          })
          .then((response) => {
            if (response.data.status != false) {
              this.addUser();
              return;
            }
          });
      this.creat_default_editing_item();
    },
    save() {
      this.addStaffAndUserAccount();
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
    clickRow(item, event) {
      if (event.isExpanded) {
        const index = this.expanded.findIndex((i) => i === item);
        this.expanded.splice(index, 1);
      } else {
        this.expanded.push(item);
      }
    },
  },
};
</script>
<style scoped>
.table_style {
  width: 80%;
  margin-left: auto;
  margin-right: auto;
}
td {
  padding: 15px;
}
</style>
