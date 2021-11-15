<template>
  <v-app id="inspire">
      <v-container
        fill-height
        fluid
        outlined
        align-start
        class="pa-4 mx-lg-auto grey lighten-3">
        <v-row align-content-end full-width>
            <v-col cols="12" md="3">
                <v-card
                height="500"
                ma-3>
                    <v-subheader>General information</v-subheader>

                    <template>
                        <v-row pa-3>
                            <v-col cols="12" md="6"><div> your today's sales: </div></v-col>
                            <v-col><div>${{ total_sale }}</div></v-col>
                        </v-row>
                    </template>
                </v-card>
            </v-col> 
            <v-col cols="12" md="5">
                <v-card
                height="300">
                </v-card>
            </v-col> 
            <v-col cols="12" md="3" class="ml-auto">
                <v-card max-height="450">
                    <v-list subheader>
                        <v-subheader>Active Staff</v-subheader>

                        <template v-if="users.lenght>0">
                        <v-list-item
                            v-for="user in users"
                            :key="user.name"
                        >
                            <v-list-item-avatar>
                                <v-img
                                    :alt="`${user.name} avatar`"
                                    src=""/>
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title v-text="user.name"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        </template>
                        <template v-else>
                            <v-list-item>
                                <v-list-item-content>
                                    <p> No staff online except you </p>
                                </v-list-item-content>
                            </v-list-item>
                        </template>
                    </v-list>
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
                user : null,
                orders : [],
                products : [],
                users : [],
                arrayEvents: null,
                date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),

                total_sale: 0.0
            }
        },
        mounted(){
            axios.get('/api/users/')
            .then(response => {
                this.users = response.data
            })
            .catch(error => {
                console.error(error);
            })
            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })
            axios.get('/api/category/')
            .then(response => {
                this.orders = response.data
            })
            .catch(error => {
                console.error(error);
            })         
        }
    }
</script>

<style scoped>
    .active-staff-card {
        align-self: start;
    }
    .general-information-card {
        align-self: end;
    }
    .big-text {
        font-size: 28px;
    }
	.product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
        height: 20vh
    }
</style>