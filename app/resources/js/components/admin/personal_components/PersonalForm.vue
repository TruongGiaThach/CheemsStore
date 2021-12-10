<template>
  <v-form style="width: 100%">
    <v-card style="width: 100%">
      <v-card-title
        class="mx-auto"
        max-width="inherit"
        style="background-color: #2196f3; height=60px;"
      >
        <h4 class="text-h5 mx-auto white--text">Thông tin cơ bản</h4>
      </v-card-title>

      <v-card-text>
        <v-row>
          <v-col cols="12" sm="12"></v-col>
          <v-col cols="12" sm="12"> </v-col>
          <v-col cols="12" sm="4">
            <v-text-field color="rgb(33, 150, 243)"  v-model="staff.name" readonly label="Tên"></v-text-field>
          </v-col>
          <v-col cols="12" sm="4">
            <v-text-field v-model="staff.cmnd" label="CMND" readonly></v-text-field>
          </v-col>
          <v-col cols="12" sm="4">
            <v-text-field v-model="staff.salary" label="Lương" readonly></v-text-field>
          </v-col>
          <v-col cols="12" sm="6">
            <v-text-field v-model="staff.email" readonly label="Email"></v-text-field>
          </v-col>
          <v-col cols="12" sm="6">
            <v-text-field
              v-model="staff.number"
              readonly
              label="Số điện thoại"
            ></v-text-field>
          </v-col>
          <v-col cols="12" sm="12">
            <v-text-field
              v-model="staff.address"
              readonly
              label="Địa chỉ"
              color="#2196f3;"
            ></v-text-field>
          </v-col>
          <v-col cols="12" sm="12">
            <div>
              <h6>Ghi chú:</h6>
              <textarea v-model="staff.note" style="width: 100%"></textarea>
            </div>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-form>
</template>
<script>
export default {
  props: {
      staff: [],
  },
  data() {
    return {
      
    };
  },
};
</script>
<style></style>
