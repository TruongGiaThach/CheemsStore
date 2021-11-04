<template>
  <v-card>
    <v-card-title class="mx-auto" elevate-on-scroll scroll-target="#scrolling-techniques-7">

      <v-col>
        <h2>Products</h2>

        <v-btn-toggle v-model="toggle_exclusive">
          <v-btn icon color="#2a9d8f" small>
            <v-icon>mdi-plus</v-icon>
          </v-btn>
          <v-btn icon color="#f4a261" small>
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
          <v-btn icon color="#264653" small>
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-btn-toggle>
      </v-col>

      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-sheet
      id="scrolling-techniques-7"
      class="overflow-y-auto"
      max-height="600"
    >
      <v-data-table
        v-model="selected"
        :headers="headers"
        :items="products"
        :search="search"
        :single-select="singleSelect"
        show-select
      ></v-data-table>
    </v-sheet>
  </v-card>
</template>

<script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                editingItem: null,
                addingProduct: null,
                search: '',
                selected: [],
                singleSelect: true,
                toggle_exclusive: 2,
                headers: [
                  {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                  },
                  { text: 'Amount', value: 'amount' },
                  { text: 'Price', value: 'price' },
                  { text: 'Image', value: 'image' },
                  { text: 'Description', value: 'description' },
                ],
                products: [
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },

                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                    {
                        name: 'paper',
                        amount: 19,
                        price: 1000,
                        image: null,
                        description: 'yeah',
                    },
                ],
            }
        },
        components: {Modal},
        beforeMount() {
            //axios.get('/api/products/').then(response => this.products = response.data)
        },
        methods: {
            newProduct() {
                this.addingProduct = {
                    name: null,
                    units: null,
                    price: null,
                    image: null,
                    description: null,
                }
            },
            endEditing(product) {
                this.editingItem = null

                let index = this.products.indexOf(product)
                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description

                axios.put(`/api/products/${product.id}`, {name, units, price, description})
                     .then(response => this.products[index] = product)
            },
            addProduct(product) {
                this.addingProduct = null

                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let image = product.image 

                axios.post("/api/products/", {name, units, price, description, image})
                     .then(response => this.products.push(product))
            }
        }
    }
</script>