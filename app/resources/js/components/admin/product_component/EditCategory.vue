<template>
    <v-dialog
      v-model="dialog"
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          :disabled="isDisabled"
          icon
          v-bind="attrs"
          v-on="on"
        >
            <v-icon>
                mdi-pencil
            </v-icon>
        </v-btn>
      </template>
      <ValidationObserver ref="observer" v-slot="{invalid}">
      <v-card>
         <v-card-title class="bg-info mx-auto" max-width="inherit">
          <span class="text-h5 mx-auto white--text"> Sửa danh mục</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <V-form @submit.prevent="save">
                <v-row>
                    <v-col cols="12">
                        <ValidationProvider v-slot="{ errors }" name="Name" rules="required">
                            <v-text-field
                                v-model="editedCategory.name"
                                :error-messages="errors"
                                label="tên danh mục*"
                                required
                            ></v-text-field>
                        </ValidationProvider>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12">
                        <v-textarea v-model="editedCategory.description" color="teal">
                            <template v-slot:label>
                              <div>Mô tả <small>(optional)</small></div>
                            </template>
                         </v-textarea>
                    </v-col>
                </v-row>
            </V-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="close"
          >
            Đóng
          </v-btn>
          <v-btn
            color="blue darken-1"
            type="submit"
            text
            :disabled="invalid" 
            @click="save"
          >
            Lưu
          </v-btn>
        </v-card-actions>
      </v-card>
      </ValidationObserver>
    </v-dialog>
</template>

<script>

import { required } from 'vee-validate/dist/rules'
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'


export default {
    data: () => ({
      dialog: false,
    }),
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    props: {
        editedCategory: [Object],
    },
    computed: {
        isDisabled() {
            if(this.editedCategory == undefined) return true;
            else return false;
        }
    },
    methods: {
        editCategory() { 
            axios
                .put(`/api/category/${this.editedCategory._id}`, {
                    name: this.editedCategory.name,
                    description: this.editedCategory.description,
                })
                .then(
                  res => {
                    console.log("finish add category");
                  }
                )
                .catch((response) => {});
        },

        async close() {
          this.$refs.observer.reset()
          this.dialog = false;
        },

        async save() {
          const reuslt = await this.$refs.observer.validate()
          await this.editCategory();
          this.$emit('resetCategory');
          this.close();
        },
    },
}
</script>

<style>

</style>