<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-card-title>
      Staffs
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
      show-expand
      rounded-xl
      class="elevation-1"
      min-height="70vh"
    ></v-data-table>
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
        { text: "Gmail", value: "gmail" },
        { text: "Role", value: "role" },
        { text: "CMND", value: "cmnd" },
      ],
      users: [],
    };
  },
  beforeMount() {
    axios
      .get("/api/users")
      .then((response) => {
        this.users = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>