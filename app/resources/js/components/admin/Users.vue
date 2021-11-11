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
            <v-spacer></v-spacer>
          </v-toolbar>
      </template>
      <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          <v-row>
            <v-col cols="12" md="8">
              <h3>{{ item.name }}</h3>
              <p class="text-justify">
                Nhuw com cat
              </p>
            </v-col>
          </v-row>
        </td>
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
      ],
      users: [],
      editingItem: null,
      addingUser: null,
      dialog: false,
      dialogDelete: false,
      expanded: [],
      singleExpand: true,
    };
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
  },
  methods: {
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