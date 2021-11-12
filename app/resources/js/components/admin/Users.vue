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
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Tài khoản</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
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
        </v-toolbar>
      </template>
      <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          <tr>
            <h3>Thông tin nhân viên {{ item.name }}</h3>
          </tr>

          <div v-for="staff in staffs" :key="staff.id">
            <v-list class="text-justify" v-if="staff.email == item.email">
              <v-list-item>
                <v-list-item-content>Email:</v-list-item-content>
                <v-list-item-content class="align-end">
                  {{ staff.email }}
                </v-list-item-content>
              </v-list-item>

              <v-list-item>
                <v-list-item-content>CMND:</v-list-item-content>
                <v-list-item-content class="align-end">
                  {{ staff.cmnd }}
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-content>Số ngày nghỉ:</v-list-item-content>
                <v-list-item-content class="align-end">
                  {{ staff.numOfDayOff }}
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-content>Mức lương:</v-list-item-content>
                <v-list-item-content class="align-end">
                  {{ staff.salary }}
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-content>Ngày vào làm:</v-list-item-content>
                <v-list-item-content class="align-end">
                  {{ staff.dateBegin }}
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </div>
        </td>
      </template>
        <template v-slot:[`item.actions`]="{ item }">
        
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
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
      ],

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
      return "Thêm nhân viên"
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
        console.log(this.users[1].email);
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
    initialize() {
      axios
        .get("/api/users")
        .then((response) => {
          this.users = response.data;
          console.log(this.users[1].email);
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
    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
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