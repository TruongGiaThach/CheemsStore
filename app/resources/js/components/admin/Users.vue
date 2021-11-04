<template>
  <v-card>
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
      :items="desserts"
      :search="search"
    ></v-data-table>
  </v-card>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
        headers: [
          {
            text: 'Name',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Gmail', value: 'gmail' },
          { text: 'Role', value: 'role' },
          { text: 'CMND', value: 'cmnd' },
          { text: 'Dayoff', value: 'dayoff' },
        ],
        desserts: [
          {
            name: 'NguyentanTien',
            gmail: 'Nguyentantien@gmail.com',
            role: 'admin',
            cmnd: 312465826,
            dayoff: 4,
          },
        ],
      }
    },
  }
</script>