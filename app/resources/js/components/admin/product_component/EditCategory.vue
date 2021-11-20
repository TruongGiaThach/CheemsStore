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
        <v-card-title>
          <span class="text-h5">Danh mục</span>
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
            let formData = new FormData();
            formData.append('name', this.editedCategory.name);
            formData.append('description', this.editedCategory.description);

            axios
                .put(`/api/category/${this.editedCategory._id}`, formData, {
                    header:{
                        'Content-Type':"multipart/form-data"
                    }
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