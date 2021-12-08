
<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-row>
      <v-col cols="12" md="3">
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
                ><v-icon color="rgb(33, 150, 243)"
                  >mdi-star-outline</v-icon
                ></v-col
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
            <h6 style="color: #2196f3" class="commonFont">{{ user.role }}</h6>
            <br />
            <br />
            <p class="commonFont mx-auto" style="width: 80%">
              {{ description }}
            </p>
            <h6 class="commonFont">{{ staff.email }}</h6>
            <h6 class="commonFont">{{ staff.dateBegin }}</h6>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="9">
        <v-data-table
          style="
            height: 91vh;
            overflow: auto;
            align: center;
            margin-left: auto;
            margin-right: auto;
          "
          :headers="headers"
          :items="histories"
          :search="search"
          @click:row="handleClick"
        >
        </v-data-table>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
import { axios } from 'vue/types/umd';
export default {
  beforeMount()
  {
      axios.get('/api/history')
      .then((response)=>{
          this.histories = response.data;
      })
  },
  data() {
    return {
        histories:[],
        staff:[],
        headers: [
            {
                text: "Tên nhân viên",
                value: "name",
                class: "info--text",
                width: "40vh",
                align: "left",
                sortable: false,
            },
            { text: "Content", value: "content", class: "info--text" },
            { text: "Thời gian thực hiện", value: "implementDate", class: "info--text" },
        ]
    };
  },
  computed: {},
  methods: {
      handleClick(item)
      {
          await axios.get('/api/history' + `${item._id}`)
          .then((response)=>{
              this.staff = response.data;
          })
      }
  },
};
</script>
