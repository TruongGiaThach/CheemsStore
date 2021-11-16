<template >
    <div id="printing-template">
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
    <div v-bind:class="[pageclass, prinonly]">
        <section class="sheet padding-10mm printonly"  v-for="(itms,idx) in pages" :key="itms">
            <div v-show="istrue" class="header-block">
                <div class="clear">
                    <div class="column2">
                        <h3>{{master.repname}} #{{master.billno}}</h3>
                        <p><b>Bill Date :</b> {{today}}</p>
                    </div>
                    <div>
                        <div class="column2 align-right">
                            <p style="left:0px;margin-top:5px;"><b>Trạng thái:</b>Đã thanh toán</p>
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
                        <span><b>email:</b></span>
                        <span>{{master.email}}</span>
                    </div>  
                </div>      
                <div class="clear">           
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
            <div class="body-block mx-auto" v-bind:style="{ padding: '15px', height: bodyblockheight + 'mm' }" >
                <div class="block-tborder">
                    <table >
                        <thead>
                            <tr>
                                <th v-for="col in columns" v-bind:class="col.classname" :key="col">{{col.label}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in itms" :key="index">
                                <td v-for="col in columns" v-bind:class="col.classname" :key="col">{{calfield(item,col)}}</td>
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
                <b>Dũng kun</b>
            </div>
            <small style="float:right; padding-right: 15px">print@: {{now}} copyright © 2017 by ServIT. thongchai@servit.co.th</small>
        </section>
        <section v-show="pages.length === 0" class="sheet padding-10mm printonly" >
                No Items for Print
        </section>

    </div>     
    </div>  
</template>

<script>
export default {
      data() {
        return {
            isfalse:false,
            istrue:true,
            lim: {
                firstname: 'T',
                lastname: 'Lim',
                get fullname() {
                return this.firstname + ' ' + this.lastname;
                }
            },
            pagesize:'A5',
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
                repname: 'Cheems',
                billno: 'QT20170600001',
                billdate:new Date().toISOString().slice(0,10),
                tackingcode :'34123413234',
                vatrate:7,
                vattype:1,  // 0 novat 1,excute vat 2 includevat
                vat:300,
                name: 'Dũng đẹp trai',
                zipcode: '700000',
                tel: '081-6477729',
                email: 'vandungkitty@email.com',
                note: 'Note Note Note Note Note Note Note',
			},
            // items:[]
            items:[
                  {
                    "id": "0112131143",
                    "name": "iphone7Plusasadasdasdasdasdas",
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
      beforeMount(){
          this.changecss();
      },
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
      }
}
  
</script>

<style lang="scss" scoped>

    * {
    	color:black;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
</style>