<template>
  <v-app id="inspire">
      <v-container
        fluid
        outlined
        align-start
        class="pa-4 mx-lg-auto grey lighten-3">
        <v-row align-content-end full-width>
            <v-col cols="12" md="3">
                <v-card
                color="#321fdb"
                height="180">
                </v-card>
            </v-col>
            <v-col cols="12" md="3">
                <v-card
                color="#39f"
                height="180">
                </v-card>
            </v-col>
            <v-col cols="12" md="3">
                <v-card
                color="#f9b115"
                height="180">
                </v-card>
            </v-col>
            <v-col cols="12" md="3">
                <v-card
                color="#e55353"
                height="180">
                </v-card>
            </v-col>      
        </v-row>
        <v-row align-content-end full-width>
            <v-col>
                <v-card
                height="500">
                    
                </v-card>
            </v-col>
        </v-row>
      </v-container>
  </v-app>
</template>

<script>
	export default {
        data(){
            return {
                customer : [],
                receipts : [],
                values: [],
            }
        },
        mounted(){
            axios.get('/api/customer/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })    
            axios.get('/api/receipt/')
            .then(response => {
                this.receipts = response.data;
                for(var i = 0; i < response.data.length; i++){
                    this.values.push(response.data[i].total);
                }
            })
            .catch(error => {
                console.error(error);
            })   
        },
    }
</script>

<style scoped>

</style>