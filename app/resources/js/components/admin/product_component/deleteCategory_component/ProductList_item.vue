<template>
    <v-hover v-slot="{ hover }">
      <v-card
        :elevation="hover ? 1 : 0"
        :class="{ 'on-hover': hover }"
        width="100%"
      >
        <v-container fluid>
        <v-row
            justify="start"
        >
            <v-col cols="12" md="1">
                <v-icon v-if="choseWay" left dark color="green"> mdi-checkbox-marked-circle </v-icon>
                <v-icon v-else left dark color="red" > mdi-alert-circle </v-icon>
                <v-icon v-if="chosenCategory!=null && toggle_exclusive == 'CHANGE'" left dark color="#2196F3" @click="overlaySelectCate = true"> mdi-cog</v-icon>
            </v-col>
            <v-col cols="12" md="5">
                    <h6 class="text-left">
                        {{ product.name }}
                    </h6>
                    <div v-if="chosenCategory!=null && toggle_exclusive == 'CHANGE'" :class="'text-caption'" class="transition-swing">
                        To->{{ chosenCategory.name }}
                    </div>
            </v-col>
            <v-col cols="12" md="2">
                <v-btn-toggle
                 
                  v-model="toggle_exclusive"
                  rounded
                  dense
                  borderless
                >
                    <v-btn
                        :v-if="hover"
                        color="#3F51B5"
                        active-class="choseChangeActive"
                        block
                        small
                        outlined
                        value="CHANGE"
                        @click="$emit('turnOffAll')"
                    >
                        Danh mục
                    </v-btn>
                    <v-btn
                        :v-if="hover"
                        color="#F44336"
                        active-class="choseDeleteActive"
                        block
                        small
                        outlined
                        value="DELETE"
                        @click="$emit('turnOffAll')"
                    >
                        Thùng rác
                    </v-btn>
                </v-btn-toggle>
            </v-col>
        </v-row>
        <v-overlay
          :absolute="absolute"
          :value="overlayLoading"
        >
            <v-icon v-if="finish" dark large>mdi-check-bold</v-icon>
            <v-progress-circular
                v-else
                :size="50"
                :value="100"
                color="blue-grey"
            ></v-progress-circular>
        </v-overlay>
        <v-overlay
          :absolute="absolute"
          :value="overlaySelectCate"
        >
            <v-select
                v-model="chosenCategory"
                :items="categoryList"
                item-text="name"
                return-object
                label="chọn danh mục để chuyển qua"
                single-line
                required
            ></v-select>
        </v-overlay>
        </v-container>
      </v-card>
    </v-hover>
</template>

<script>

import { eventBus } from '../../../../app'

export default {
    data: () => ({
        toggle_exclusive: undefined,
        isChangeCategory: false,
        absolute: true,
        overlayLoading: false,
        overlaySelectCate: false,
        finish: false,
        triggerAction: false,
        chosenCategory: null,


        transparent: 'rgba(255, 255, 255, 0)',
    }),
    props: {
        productIndex: [Number],
        product: [Object],
        categoryList: [Array],

        SelectAllToggle: false,
        SelectAllACtion: null,
        SelectAllCate: null,
    },
    created: function() {
        eventBus.$on('TriggerChildAction', (payload) => {
            this.triggerchildAction(payload);
        });
    },
    computed: {
        choseWay() {
            if(this.toggle_exclusive != 'DELETE') {
                if (this.toggle_exclusive == 'CHANGE') {
                    if (this.isChangeCategory) {
                        return true;
                    }
                    else return false;
                }
                else return false;
            }
            else 
            {
                this.overlaySelectCate = false;
                return true;
            }
        },
    },
    watch: {
        SelectAllACtion: function() {
            if(this.SelectAllACtion == 'DELETE') {
                if(this.SelectAllToggle) this.toggle_exclusive = this.SelectAllACtion;
            }
            else if(this.SelectAllACtion == 'CHANGE') {
                if(this.SelectAllToggle) this.toggle_exclusive = this.SelectAllACtion;
            }
        },
        SelectAllCate: function() {
            if(this.SelectAllCate != null) {
                if(this.SelectAllACtion == 'CHANGE') {
                    if(this.SelectAllToggle) this.chosenCategory = this.SelectAllCate;
                }
            }
        },
        toggle_exclusive: function() {
            if(this.toggle_exclusive == 'CHANGE') {
                if(this.chosenCategory == null) this.overlaySelectCate = true;
            }
        },
        chosenCategory: function() {
            if(this.chosenCategory != null) {
                this.isChangeCategory = true;
                this.overlaySelectCate = false;
            }
            else {
                this.isChangeCategory = false;
            }
        }
    },
    methods: {
        triggerchildAction(trigger) {
            if(trigger != this.triggerAction) {
                this.triggerAction = true;
                if(this.choseWay) {
                    if(this.toggle_exclusive == 'DELETE') {
                        this.acceptDelete();
                        this.triggerAction = false;
                    }
                    else {
                        if(this.isChangeCategory)
                        this.acceptChange();
                        this.triggerAction = false;
                    }
                }
                else {
                    this.$emit('ActionCommand', false);
                    this.triggerAction = false;
                }
            }
        },
        acceptChange() {
            let formData = new FormData();
            formData.append('name', this.product.name);
            formData.append('amount', this.product.amount);
            formData.append('importPrice', this.product.importPrice);
            formData.append('outportPrice', this.product.outportPrice);
            formData.append('manufacture', this.product.manufacture);
            formData.append('warrantyPeriod', this.product.warrantyPeriod);
            formData.append('category_id', this.chosenCategory._id);
            formData.append('description', this.product.description);
            formData.append('tag', this.product.tag);
            formData.append('name', this.product.name);

            formData.append("_method", "PUT");

            axios
            .post(`/api/products/${this.product._id}`, formData, {
            header:{
                'Content-Type':"multipart/form-data"
            }
            })
            .then(
            res => {
                this.$emit('ActionCommand' ,[true, this.productIndex, 'CHANGE', this.product._id, this.chosenCategory._id]);
            })
            .catch((response) => {});
        },
        acceptDelete() {
            this.overlayLoading = true;
            axios
            .delete('/api/products/'+this.product._id)
            .then(
            res => {
                console.log("delete.")
                this.finish = true;
                this.$emit('ActionCommand' ,[true, this.productIndex, 'DELETE', this.product._id]);
            }
            )
            .catch((response) => {})
            .catch((error) => {
                console.error(error);
            })
        }
    }
    
}
</script>

<style>
.isAccept {
    color: green;
}
.notAccept {
    color: red;
}




.choseChange {
    border-color: #BBDEFB !important;
    text-decoration-color: cyan !important;
}
.choseDelete {
    border-color: #FFCDD2 !important;
    text-decoration-color: pink !important;
}
.choseChangeActive {
    background-color: cyan !important;
    text-decoration-color: whitesmoke;
}
.choseDeleteActive {
    background-color: pink !important;
    text-decoration-color: whitesmoke;
}
</style>