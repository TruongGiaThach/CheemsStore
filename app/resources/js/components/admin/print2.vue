<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TEST PRN</title>
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.2.3/paper.css"> -->
    <style>


    </style>
</head>

<body>
    <div id="app">
       {{lim.fullname}}
        <div class="noprint">
            rows/page &nbsp;<input type="number" v-model="perpage" /><br/>
            Items &nbsp; <input type="number" v-model="additem" />
          <button @click="additems">Additem</button>
            <br/>
            <select @change="changecss" v-model="pagesize">
              <option disabled value="">Please select one</option>
                <option>A3</option>
                <option>A3 landscape</option>
                <option selected>A4</option>
                <option>A4 landscape</option>
                <option>A5</option>
                <option>A5 landscape</option>
            </select>
            <span>Selected: {{ pagesize }}</span><br />
            <button  @click="printpage">Printing</button>
        </div>
        <printing
            :items="items"
            :master="master"
            v-bind:perpage="perpage"
            :columns="columns"
            :calfield="calfield"
            :sumtotal="sumtotal"
            :vatrate="vatrate"
            :calcuvat="calcuvat"
            :calculatotal="calculatotal"
            :pagesize="pagesize"
            >
            </printing>
    </div>
    <template id="printing-template">
       <div v-bind:class="[pageclass, prinonly]">
            <section v-if="pages.length > 0" class="sheet padding-10mm printonly"  v-for="(itms,idx) in pages" >
    	        <div v-show="istrue" class="header-block">
    		        <div class="clear">
    		            <div class="column2">
    		                <h3>{{master.repname}} #{{master.billno}}</h3>
    		                <p><b>Bill Date :</b> {{today}}</p>
    		            </div>
    		            <div>
    		                <div class="column2 align-right">
    		                    <p style="left:0px;margin-top:5px;"><b>status :</b> ได้รับเงิน</p>
    		                    <p style="left:0px;"><b>tacking code :</b>{{master.tackingcode}}</p>
    		                    <p v-if="pages.length > 1 " style="left:0px;"><b>page :</b> {{idx+1}}/{{pages.length}}</p>
    		                </div>
    		            </div>
    		        </div>
    		        <div class="clear">
    	                <div class="column2" style="margin-bottom: 5px;">
    	                    <span><b>customer:</b></span>
    	                    <span>{{master.name}}</span>
    	                </div>
    	                <div class="column2">
    	                    <span><b>line id:</b></span>
    	                    <span>{{master.line}}</span>
    	                </div>
                	</div>
    	            <div class="clear">
    	                <div class="column2">
    	                    <span><b>address1:</b></span>
    	                    <span>{{master.address1}}</span>
    	                </div>
    	                <div class="column2">
    	                    <span><b>facebook:</b></span>
    	                    <span>{{master.facebook}}</span>
    	                </div>
    	            </div>
    	            <div class="clear">
    	                <div class="column2">
    	                    <span><b>address2:</b></span>
    	                    <span>{{master.address2}}</span>
    	                </div>
    	                <div class="column2">
    	                    <span><b>email:</b></span>
    	                    <span>{{master.email}}</span>
    	                </div>
    	                <div class="column2">
    	                    <span><b>province:</b></span>
    	                    <span>{{master.province}}</span>
    	                </div>
    	                <div class="column2">
    	                    <span><b>tel :</b></span>
    	                    <span>{{master.tel}}</span>
    	                </div>
    	                <div class="column2">
    	                <span><b>zipcode:</b></span>
    	                    <span>{{master.zipcode}}</span>
    	                </div>
    	                <div class="column2">
    	                    <span><b></b></span>
    	                    <span></span>
    	                </div>
    	            </div>
    	        </div>
    	        <div class="body-block" v-bind:style="{ padding: '15px', height: bodyblockheight + 'mm' }" >
    	            <div class="block-tborder">
    	                <table >
    	                    <thead>
    	                        <tr>
                                    <th class="align-center" style="width:50px;">#</th>
    	                            <th v-for="col in columns" v-bind:class="col.classname">{{col.label}}</th>
    	                           <!--  <th class="align-left">SKU</th>
    	                            <th class="align-left">สินค้า</th>
    	                            <th class="align-right">ราคา (฿) / หน่วย</th>
    	                            <th class="align-center" style="width:50px;">จำนวน</th>
    	                            <th class="align-right">ราคารวม (฿)</th> -->
    	                        </tr>
    	                    </thead>
    	                    <tbody>
    	                        <tr v-for="(item,index) in itms">
                                    <td class="align-center">{{index+1}}</td>
    	                            <td v-for="col in columns" v-bind:class="col.classname">{{calfield(item,col)}}</td>


    	          <!--                   <td class="align-left">{{item.id}}</td>
    	                            <td class="align-left">
    	                                {{item.name}}
    	                            </td>
    	                            <td class="align-right">{{item.price}}</td>
    	                            <td class="align-center">1</td>
    	                            <td class="align-right">{{item.price}}</td> -->
    	                        </tr>
    	                    </tbody>
    		            <tfoot  v-show="(idx+1)==pages.length">
    		                        <tr class="border-bottom">
    		                            <td colspan="5" class="align-right"><b>รวม</b></td>
    		                            <td class="align-right">{{sumtotal(items)}}</td>
    		                        </tr>
    		                        <tr>
    		                            <td colspan="5" class="align-right">vat {{master.vatrate.toLocaleString('th-TH', {minimumFractionDigits: decimal })}}%</td>
    		                            <td class="align-right">{{vat}}</td>
    		                        </tr>
                                    <!--<tr>
    		                            <td colspan="5" class="align-right">Kerry Express (100.00 กรัม)</td>
    		                            <td class="align-right">35.00</td>
    		                        </tr>-->
                                    <tr class="border-top">
    		                            <td colspan="3" class="align-right">
    		                            </td>
    		                            <td colspan="2" class="align-right" style="font-size: 16px;"><b>Total : </b></td>
    		                            <td class="align-right" style="font-size: 16px;"><b>{{calculatotal(items)}}</b></td>
    		                        </tr>
    		            </tfoot>
    		            </table>
    	            	<div v-show="(idx+1)==pages.length" class="block-note">
    	                	<h4>Note:</h4>
    	                	<div class="note">{{master.note}}</div>
    	            	</div>
    	        	</div>
    	        </div>
            	<div class="footer-block">
            		<b>ชื่อผู้ซื้อ</b>
            	</div>
            	<small style="float:right; padding-right: 15px">print@: {{now}} copyright © 2017 by ServIT. thongchai@servit.co.th</small>
            </section>
            <section v-show="pages.length === 0" class="sheet padding-10mm printonly" >
                    No Items for Print
            </section>

       </div>
    </template>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-resource/dist/vue-resource.min.js"></script>
</body>
</html>
<script>

Vue.component('printing', {
      template: '#printing-template',
      props: {
            master: {
                type: Object,
                default: {}
            },
            items: {
                type: Array,
                default:[]
            },
            perpage: {
                type: Number,
                default: 15
            },
            vatrate: {
                type: Number,
                default: 7
            },
            columns: {
                type: Array,
                default:[
                    // { classname:'align-left', field:'id', label:'SKU' },
                    // { classname:'align-left', field:'name', label: 'สินค้าง' },
                    // { classname:'align-right', field:'price', label: 'ราคา (฿) / หน่วย' },
                    // { classname:'align-center', field:'qty', label: 'จำนวน'},
                    // { classname:'align-right', field:'total', label: 'ราคารวม (฿)'},
                ]
            },
            calfield : {
                type: Function,
                default: (i,c)=>i[c.field]
            },
            decimal: {
                type: Number,
                default: 2
            },
            sumtotal: {
                type: Function,
                default: (items)=>items.reduce((o,i) => o+(i.price*i.qty),0).toLocaleString('th-TH', {minimumFractionDigits: decimal })
            },
            calculatotal: {
                type: Function,
                default: (i)=>i
            },
            calcuvat: {
                type: [Number,Function],
                default: (i)=>i
            },
            pagesize: {
                type: String,
                default: 'A4'
            }
      },
      data() {
        return {
            isfalse:false,
            istrue:true,
        }
      },
      computed: {
            pages() {
                let p = [];
                console.log('p,i before',p)
                let pp = +this.perpage;
                p = this.items.map((e,i)=>{
                     return i%pp === 0 ? this.items.slice(i,Number(i+pp)).filter((e)=>{ return e }) : null
                    })
                console.log(p)
                p = p.filter(i=>i!=null)
                console.log(p)
                return p;
            },
            vat(){
                if( typeof this.calcuvat == 'number' ){
                    return this.calcuvat;
                } else {
                    return this.calcuvat(this.items,this.vatrate);
                }
            },
            today(){
                return new Date().toISOString().slice(0,10);//.replace(/-/g,"");
            },
            now(){
                return new Date().toISOString().slice(0,19).replace('T',' ')
            },
            scrheihgt(){
                return screen.height;
            },
            bodyheihgt(){
                return this.scrheight - 300;
            },
            pageclass(){
                return this.pagesize;
            },
            prinonly(){
                return 'printonly';
            },
            bodyblockheight(){
                console.log(this.pagesize);
                let size = 0;
                switch (this.pagesize)
                {
                    case "A3":
                        size = 419;
                    break;
                    case "A3 landscape":
                        size = 296;
                    break;
                    case "A4 landscape":
                        size = 209;
                    break;
                    case "A5 landscape":
                        size = 147;
                    break;
                    case "A5":
                        size = 209;
                    break;
                    default:
                        size = 296;
                }
                console.log('new size =',size-40)
                return (size - 40 );
            }

      },
      methods: {
        // calfield(item,col) {
        //     if(item[col.field]) {
        //         if(col.fiexd){
        //             let digi = Number(col.fiexd);
        //             return item[col.field].toLocaleString('th-TH', {minimumFractionDigits: digi });
        //         } else {
        //             return item[col.field];
        //         }
        //     } else {
        //         return col.func(item.qty,item.price);
        //     }
        // }
      }
    });

     let obj = {
        firstname: 'T',
        lastname: 'Lim',
        get fullname() {
           return this.firstname + ' ' + this.lastname;
        }
     }

     console.log(obj.fullname);

var vm = new Vue({
        mixins: [],
        data: {
            lim: obj,
            pagesize:'A4',
            additem:0,
            maincount:20,
            vatrate:7,
            // vat: 23423423,
            perpage:15,
            columns: [
                    { classname:'align-left',   field:'id',    label: '#sku'     },
                    { classname:'align-left',   field:'name',  label: 'product name'    },
                    { classname:'align-right',  field:'price', label: 'price(฿)/unit' , decimal: 2 },
                    { classname:'align-center', field:'qty',   label: 'qty'},
                    // { classname:'align-right',  field:'vat',   label: 'discount' , func:(a,b)=>(a*b/100), decimal:2 },
                    { classname:'align-right',  field:'total', label: 'total(฿)' ,func: (a,b)=>(a*b).toLocaleString('th-TH', {minimumFractionDigits: 2 }) },
                ],
            master:{
                repname: 'Qutation',
                billno: 'QT20170600001',
                billdate:new Date().toISOString().slice(0,10),
                tackingcode :'34123413234',
                vatrate:7,
                vattype:1,  // 0 novat 1,excute vat 2 includevat
                vat:300,
                name: 'Customer Name Co,.Ltd.',
                address1: '203/7 Ladplao 15 Rd.',
                address2: 'Jatujak Bkk',
                province: 'Bangkok/Thailand',
                zipcode: '10250',
                tel: '081-6477729',
                email: 'email@email.com',
                line: 'tlen4105',
                facebook: 'thongchai@servit.co.th',
                note: 'Note Note Note Note Note Note Note',
			},
            // items:[]
            items:[
				  {
				    "id": "001",
				    "name": "iPad Pro",
				    "price": 30900,
				    "storage": 32,
				    "type": "iPad",
                    "qty":1,
                    "size": "12.9",
                  },
                  {
                    "id": "002",
                    "name": "iPad Pro",
                    "price": 34900,
                    "storage": 128,
                    "type": "iPad",
                    "qty":2,
                    "size": "12.9",
                  },
                  {
                    "id": "003",
                    "name": "iPad Pro",
                    "price": 38900,
                    "storage": 256,
                    "type": "iPad",
                    "qty":1,
                    "size": "12.9"
                  },
                  {
                    "id": "004",
                    "name": "iPad Pro",
                    "price": 22900,
                    "qty":1,
                    "storage": 32,
                    "type": "iPad",
                    "size": "9.7"
                  },
                  {
                    "id": "005",
                    "name": "iPad Pro",
                    "price": 26900,
                    "storage": 128,
                    "type": "iPad",
                    "qty":1,
                    "size": "9.7"
                  },
                  {
                    "id": "006",
                    "name": "iPad Pro",
                    "price": 30900,
                    "storage": 256,
                    "type": "iPad",
                    "qty":1,
                    "size": "9.7"
                  },
                  {
                    "id": "007",
                    "name": "iPad Air 2",
                    "price": 14400,
                    "storage": 32,
                    "type": "iPad",
                    "qty":1,
                    "size": "9.7"
                  },
                  {
                    "id": "008",
                    "name": "iPad Air 2",
                    "price": 18400,
                    "storage": 128,
                    "type": "iPad",
                    "qty":1,
                    "size": "9.7"
                  },
                  {
                    "id": "009",
                    "name": "iPad mini 4",
                    "price": 14400,
                    "storage": 32,
                    "type": "iPad",
                    "qty":1,
                    "size": "7.9"
                  },
                  {
                    "id": "010",
                    "name": "iPad mini 4",
                    "price": 18400,
                    "storage": 128,
                    "type": "iPad",
                    "qty":1,
                    "size": "7.9"
                  },
                  {
                    "id": "011",
                    "name": "iphone7",
                    "price": 26000,
                    "storage": 32,
                    "type": "iPhone",
                    "qty":1,
                    "size": "4.7"
                  },
                  {
                    "id": "012",
                    "name": "iphone7",
                    "price": 55000,
                    "storage": 128,
                    "type": "iPhone",
                    "qty":1,
                    "size": "4.7"
                  },
                  {
                    "id": "013",
                    "name": "iphone7Plus",
                    "price": 49000,
                    "storage": 32,
                    "type": "iPhone",
                    "qty":1,
                    "size": "5.5"
                  },{
                    "id": "014",
                    "name": "iphone7Plus",
                    "price": 59000,
                    "storage": 128,
                    "type": "iPhone",
                    "qty":1,
                    "size": "5.5"
                  },{
                    "id": "015",
                    "name": "iphone7Plus",
                    "price": 59000,
                    "storage": 128,
                    "type": "iPhone",
                    "qty":1,
                    "size": "5.5"
                  },{
                    "id": "016",
                    "name": "iphone7Plus",
                    "price": 59000,
                    "storage": 128,
                    "type": "iPhone",
                    "qty":1,
                    "size": "5.5"
                  },{
                    "id": "017",
                    "name": "iphone7Plus",
                    "price": 59000,
                    "storage": 128,
                    "type": "iPhone",
                    "qty":1,
                    "size": "5.5",
                  }
                ]
        },
        el: '#app',
        methods: {
               additems(){
                  console.log('---items to add---',this.additem)
                  let i;
                  for(i=0;i<this.additem;i++)  {
                     this.maincount++;
                     let ox = {
                        "id": this.maincount,
                        "name": "iphone7Plus",
                        "price": 59000,
                        "storage": 128,
                        "type": "iPhone",
                        "qty":i+1,
                        "size": "5.5",
                      };

                     this.items.push(ox);
                  }
               },
                calfield(item,col) {
                    let digi = (col.decimal ? col.decimal: 0 );
                    if(item[col.field]) {
                         return ( digi ? item[col.field].toLocaleString('th-TH', {minimumFractionDigits: digi }) : item[col.field] );
                    } else {
                        return ( digi ? col.func(item.qty,item.price).toLocaleString('th-TH', {minimumFractionDigits: digi }) : col.func(item.qty,item.price) );
                    }
                },
                calculatotal(items) {
                    let total = items.reduce((o,i) =>o+(i.price*i.qty),0);
                    let vat = total*7/100;
                    return (total+vat).toLocaleString('th-TH', {minimumFractionDigits: 2 });
                },
                sumtotal(items) {
                   return items.reduce((o,i) => o+(i.price*i.qty),0).toLocaleString('th-TH', {minimumFractionDigits: 2 })
                },
                calcuvat(items,v=7) {
                    let total = items.reduce((o,i) =>o+(i.price*i.qty),0);
                    return (total* v/100).toLocaleString('th-TH', {minimumFractionDigits: 2 });
                },
                cssPagedMedia: (function () {
                    var style = document.createElement('style');
                    document.head.appendChild(style);
                    return function (rule) {
                        style.innerHTML = rule;
                    };
                }()),
                changecss(){
                    console.log('changecss')
                    this.cssPagedMedia.size = (size)=>{
                        this.cssPagedMedia('@page {size: ' + size + '}');
                    };
                    this.cssPagedMedia.size(this.pagesize);
                },
                printpage(){
                  window.print()
                }
        },
    })
</script>
