<template>
    <v-app>
        <div class="product-side">
            <v-card class="product-card">
                <div class = "product-image" id="left">
                    <img :src = "baseUrl +'/images/' + productInfo.image">
                </div>
                <div id="right">
                    <h3>{{productInfo.name}}</h3>
                    <p id="manufact">Thương hiệu <a>{{productInfo.manufacture}}</a></p>
                    <p id="amount">Chỉ còn {{productInfo.amount}} sản phẩm</p>
                    <p id="price">{{Number(productInfo.outportPrice).toLocaleString()}} đ </p>
                    <p id="description"> Mô tả: {{productInfo.description}}</p>
                    <p id="tag"> Tag: {{productInfo.tag}}</p>
                </div>
            </v-card>
        </div>
        <div class="info-side">
            <v-card>
                <table>
                    <tr v-if="(this.productInfo.outportPrice > 800000)">
                        <td class="info-icons">
                            <v-icon small color="green"> fas fa-tags</v-icon>
                        </td>
                        <td id="freeshipping">
                            Sản phẩm này được miễn phí giao hàng
                        </td>
                    </tr>
                    <tr v-if="(this.productInfo.outportPrice > 800000)">
                        <td colspan="2">
                            <v-divider></v-divider>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="info-title">
                            <b>Chính sách bán hàng</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="info-icons">
                            <v-icon small color="blue "> fas fa-shipping-fast</v-icon>
                        </td>
                        <td>
                            Miễn phí giao hàng cho đơn hàng từ 800K
                        </td>
                    </tr>
                    <tr>
                        <td class="info-icons">
                            <v-icon small color="blue "> fas fa-shield-alt</v-icon>
                        </td>
                        <td>
                            Cam kết hàng chính hãng 100%
                        </td>
                    </tr>
                    <tr>
                        <td class="info-icons">
                            <v-icon small color="blue ">fas fa-sync-alt</v-icon>
                        </td>
                        <td>
                            Đổi trả trong vòng 10 ngày
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="info-title">
                            <b>Dịch vụ khác</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="info-icons">
                            <v-icon small color="blue "> fas fa-cog</v-icon>
                        </td>
                        <td>
                            Sửa chữa đồng giá 150.000đ
                        </td>
                    </tr>
                    <tr>
                        <td class="info-icons">
                            <v-icon small color="blue "> fas fa-desktop</v-icon>
                        </td>
                        <td>
                            Vệ sinh máy tính, laptop
                        </td>
                    </tr>
                    <tr>
                        <td class="info-icons">
                            <v-icon small color="blue ">fas fa-tools</v-icon>
                        </td>
                        <td>
                            Bảo hành tại nhà
                        </td>
                    </tr>
                </table>
            </v-card>
        </div>
    </v-app>
</template>

<script>
export default {
    props: {
        product: {
            type: String,
            default: 'notfound',
        },
    },
    data() {
        return{
            baseUrl: window.location.origin,
            productInfo: [],
        }
    },
    beforeMount() {
        axios
        .get("/api/products")
        .then((response) => {
          for(var i = 0; i < response.data.length; i++){
              if(response.data[i]._id == this.product)
              {
                  this.productInfo = response.data[i];
                  return;
              }
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
}
</script>

<style scoped>
/****************************
*******Product side**********
*****************************/
.product-side{
    position: relative;
    width: 59%;
    left: 10%;
    top: 2em;
}
.product-card{
    height: auto;
}
.product-side #left{
    display: inline-block;
    margin: 2em;
    vertical-align:top;
}
.product-side #left img{
    height: 20em;
    width: 20em;
}
.product-side #right{
    display: inline-block;
    width: 60%;
}
.product-side #right h3{
    font-weight: 600;
}
.product-side #right #description{
    height: auto;
}
.product-side #right #manufact{
    color:rgb(100, 100, 100);
}
.product-side #right #manufact a{
    color:blue;
}
.product-side #right #amount{
    color:chocolate;
    font-size: 85%;
}
.product-side #right #price{
    color:blue;
    font-weight: 700;
    font-size: 140%;
}
/***************************
*******Info side************
****************************/
.info-side{
    position: absolute;
    width: 20%;
    right: 10%;
}
.info-title{
    padding-left:0.8em;
}
.info-icons{
    padding: 0.8em;
}
#freeshipping{
    color:green;
}
</style>
