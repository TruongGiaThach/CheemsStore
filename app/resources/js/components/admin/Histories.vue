
<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-row>
      <v-col cols="12" md="5" sm="5">
        <v-card class="content" style="width: 100%;">
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
            <h6 style="color: #2196f3" class="commonFont">
              {{ staff.position }}
            </h6>
            <br />
            <h5 style="color: #2196f3" class="commonFont">
              Các thay đổi:
            </h5>
            <v-row v-for="content in contents" :key="content" >
              <v-col cols="12" md="2" style="margin-bottom: 0;padding-bottom: 0;"
                ><v-icon color="rgb(33, 150, 243)" small
                  >mdi-star-outline</v-icon
                ></v-col
              >
              <v-col cols="12" md="8" style="margin-bottom: 0;padding-bottom: 0;"
                ><h6 class="commonFont">
                  {{ content }}
                </h6></v-col
              >
            </v-row>
            <br/>
            <h6 class="commonFont">{{ staff.email }}</h6>
            <h6 class="commonFont">{{ staff.dateBegin }}</h6>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="7" sm="7">
        <v-data-table
          style="
            height: 95vh;
            align: center;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
          "
          :headers="headers"
          :items="histories"
          :search="search"
          @click:row="handleClick"
        >
        <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title class="info--text"
            >Lịch sử</v-toolbar-title
          >
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>


          <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Tìm kiếm"
                single-line
                hide-details
          ></v-text-field>
        </v-toolbar>
        </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
export default {
  beforeMount() {
    axios.get("/api/histories").then((response) => {
      this.histories = response.data;
      this.histories.forEach(element => {
          this.contents = element.content.split('&');
          //remove the first element
          element.content = this.contents[0];
          this.contents.shift();
          
          //remove the last element
          this.contents.pop();
          this.listContents.push(this.contents);
      });
      this.histories.reverse();
      this.listContents.reverse();
      axios.get("/api/getStaffWithID/" + `${this.histories[0].staff_id}`).then((response) => {
        this.staff = response.data;
      });
    });
  },
  data() {
    return {
      listContents: [],
      contents: [],
      search: "",
      histories: [],
      staff: [],
      headers: [
        {
          text: "ID",
          value: "staff_name",
          class: "info--text",
          width: "40vh",
          align: "left",
          sortable: false,
        },
        { text: "Content", value: "content", class: "info--text" },
        {
          text: "Thời gian thực hiện",
          value: "implementDate",
          class: "info--text",
        },
      ],
      baseUrl: window.location.origin,
      description:
        "Dũng kun đẹp trai, ngày xưa ai lá ngọc cành vàng, ngày nay ai đẹp bằng Dkun ha",
    };
  },
  computed: {},
  methods: {
    handleClick(item) {
      axios.get("/api/getStaffWithID/" + `${item.staff_id}`).then((response) => {
        this.staff = response.data;
              console.log(this.staff)
      });
      this.handleContent(item);
    },
    handleContent(item)
    {
        let index = this.histories.indexOf(item)
        this.contents = this.listContents[index];
    },
  },
};
</script>
