<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
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
      <template v-slot:[`item.staff_name`]="{ item }">
        <div class="d-flex justify-center">
          <v-row no-gutters align="center">
            <v-col class="flex-grow-0">
              <p style="margin: 0px"> {{ item.staff_name }} </p>
            </v-col>
            <v-col class="flex-grow-0">
              <v-menu
                :close-on-content-click="true"
                :nudge-width="200"
                offset-x
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-icon color="info" dark v-bind="attrs" v-on="on" small @click="handleClick(item)"
                    >mdi-information-outline</v-icon
                  >
                </template>
                <v-card :color="item.color" dark>
                  <div
                    class="d-flex flex-no-wrap justify-space-between"
                    v-if="staffInforCheck == 'CHECKING'"
                  >
                    <v-progress-circular
                      indeterminate
                      color="primary"
                    ></v-progress-circular>
                  </div>
                  <div 
                    class="d-flex flex-no-wrap justify-space-between"
                    v-if="staffInforCheck == 'NODATA'"
                  >
                    <p>No data found!</p>
                  </div>
                  <div
                    class="d-flex flex-no-wrap justify-space-between"
                    v-if="staffInforCheck == 'HASDATA'"
                  >
                    <v-avatar class="ma-4" size="140">
                      <v-img
                        style="border-radius: 5px"
                        :src="baseUrl +'/images/' + 'admin.png'"
                      ></v-img>
                    </v-avatar>
                    <div>
                      <v-card-title
                        class="text-h5"
                        v-text="item.staff_name"
                      ></v-card-title>
                      <v-card-subtitle>
                        <p>chức vụ: {{ staff.role }}</p>
                        <p>email: {{ staff.email }}</p>
                      </v-card-subtitle>
                    </div>
                  </div>
                </v-card>
              </v-menu>
            </v-col>
          </v-row>
        </div>
      </template>
      <template v-slot:[`item.action`]="{ item }">
        <div class="d-flex justify-center">
          <v-row no-gutters align="center">
            <v-col class="flex-grow-0">
              <p style="margin: 0px"> {{ item.action }} </p>
            </v-col>
            <v-col class="flex-grow-0">
              <v-menu
                :close-on-content-click="true"
                :nudge-width="200"
                offset-x
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-icon color="info" dark v-bind="attrs" v-on="on" small @click="handleContent(item)"
                    >mdi-information-outline</v-icon
                  >
                </template>
                <v-card class="content" style="width: 100%;">
                  <v-card-text class="changeFont">
                    <h5 style="color: #2196f3" class="commonFont">
                      {{ item.content }}
                    </h5>
                    <v-row v-for="content in contents" :key="content" >
                        <h6 class="commonFont">
                          {{ content }}
                        </h6>
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-menu>
            </v-col>
          </v-row>
        </div>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  beforeMount() {
    axios.get("/api/histories").then((response) => {
      this.histories = response.data;
      this.histories.forEach(element => {
          this.contents = element.content.split('&');
          element.content = this.contents[0];
          if(element.staff_id == null) element.staff_name = 'ADMIN';
          this.contents.shift();
          this.contents.pop();
          this.listContents.push(this.contents);
      });
      this.histories.reverse();
      this.listContents.reverse();
      if(this.histories[0].staff_id != null) {
        axios.get("/api/getStaffWithID/" + `${this.histories[0].staff_id}`).then((response) => {
          this.staff = response.data;
        });
      }
    });
  },
  data() {
    return {
      listContents: [],
      contents: [],
      search: "",
      histories: [],
      staff: [],
      staffInforCheck: 'NODATA',
      headers: [
        {
          text: "ID",
          value: "staff_name",
          class: "info--text",
          width: "40vh",
          align: "left",
          sortable: false,
        },
        { text: "Hành động", value: "action", class: "info--text" },
        { text: "sản phẩm", value: "product_name", class: "info--text" },
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
      this.staffInforCheck = 'CHECKING';
      axios.get("/api/getStaffWithID/" + `${item.staff_id}`)
      .then((response) => {
        this.staff = response.data;
        this.staffInforCheck = 'HASDATA';
              console.log(this.staff)
      })
      .catch((error) => {
        console.log(error);
        this.staffInforCheck = 'NODATA';
        this.staff = null;
      })
      //this.handleContent(item);
    },
    handleContent(item)
    {
        let index = this.histories.indexOf(item)
        this.contents = this.listContents[index];
    },
  },
};
</script>
