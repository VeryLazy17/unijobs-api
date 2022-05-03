(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-276f44a8"],{"0688":function(t,e,a){"use strict";a.d(e,"a",(function(){return n}));a("ac1f"),a("5319"),a("d3b7"),a("25f0");var n={methods:{formatPrice:function(t){if(t){var e=t.toString().replace(/,/g,"");return e=parseFloat(e),e=new Intl.NumberFormat("en-US",{minimumFractionDigits:0,maximumFractionDigits:2}).format(e),e}return 0}}}},"0fd9":function(t,e,a){"use strict";a("4b85");var n=a("2b0e"),s=a("d9f7"),r=a("80d2");const i=["sm","md","lg","xl"],c=["start","end","center"];function l(t,e){return i.reduce((a,n)=>(a[t+Object(r["F"])(n)]=e(),a),{})}const o=t=>[...c,"baseline","stretch"].includes(t),d=l("align",()=>({type:String,default:null,validator:o})),u=t=>[...c,"space-between","space-around"].includes(t),f=l("justify",()=>({type:String,default:null,validator:u})),v=t=>[...c,"space-between","space-around","stretch"].includes(t),p=l("alignContent",()=>({type:String,default:null,validator:v})),m={align:Object.keys(d),justify:Object.keys(f),alignContent:Object.keys(p)},h={align:"align",justify:"justify",alignContent:"align-content"};function g(t,e,a){let n=h[t];if(null!=a){if(e){const a=e.replace(t,"");n+="-"+a}return n+="-"+a,n.toLowerCase()}}const b=new Map;e["a"]=n["a"].extend({name:"v-row",functional:!0,props:{tag:{type:String,default:"div"},dense:Boolean,noGutters:Boolean,align:{type:String,default:null,validator:o},...d,justify:{type:String,default:null,validator:u},...f,alignContent:{type:String,default:null,validator:v},...p},render(t,{props:e,data:a,children:n}){let r="";for(const s in e)r+=String(e[s]);let i=b.get(r);if(!i){let t;for(t in i=[],m)m[t].forEach(a=>{const n=e[a],s=g(t,a,n);s&&i.push(s)});i.push({"no-gutters":e.noGutters,"row--dense":e.dense,["align-"+e.align]:e.align,["justify-"+e.justify]:e.justify,["align-content-"+e.alignContent]:e.alignContent}),b.set(r,i)}return t(e.tag,Object(s["a"])(a,{staticClass:"row",class:i}),n)}})},"17b3":function(t,e,a){},"2b9c":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"supply",attrs:{id:"supply_mato"}},[n("div",{staticClass:"tabs"},[n("v-tabs",{attrs:{color:"black"},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[n("v-tabs-slider",{attrs:{color:"tab-slider-color"}}),n("v-tab",{attrs:{href:"#tab-1"}},[t._v(" Kirim ")]),n("v-tab",{attrs:{href:"#tab-2"}},[t._v(" Chiqim ")]),n("v-tab",{attrs:{href:"#tab-3"}},[t._v(" Mavjud tayyor yoqalar ")])],1),n("v-col",{attrs:{cols:"auto"}},[n("div",{staticClass:"d-flex align-center"},[t.$can("read","supply_tayyor_yoqa_filter")?n("v-btn",{attrs:{elevation:"0"}},[n("img",{attrs:{src:a("b05f"),alt:"filter"}})]):t._e()],1)])],1),n("v-divider"),n("v-tabs-items",{staticClass:"tab-items",model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[n("v-tab-item",{attrs:{value:"tab-1"}},[t.$can("read","supply_tayyor_yoqa_kirim")?n("Income"):t._e()],1),n("v-tab-item",{attrs:{value:"tab-2"}},[t.$can("read","supply_tayyor_yoqa_chiqim")?n("Outcome"):t._e()],1),n("v-tab-item",{attrs:{value:"tab-3"}},[t.$can("read","supply_tayyor_yoqa_mavjud")?n("ExistedReadyCollar"):t._e()],1)],1)],1)},s=[],r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-data-table",{attrs:{headers:t.headers,items:t.items,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.status",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.direction",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color_code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.date",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.status",fn:function(t){t.item;return[n("div",{staticClass:"d-flex"},[n("img",{attrs:{src:a("caa3"),alt:""}})])]}},{key:"item.direction",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.direction))])])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.color_code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("div",{staticClass:"small_circle",style:{background:a.color_code}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color_code))])])]}},{key:"item.date",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.date))])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_yoqa_kirim")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_yoqa_kirim")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])}),n("v-pagination",{staticClass:"my-2",attrs:{length:t.pageCount,"total-visible":"7"},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}}),n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.editModal,callback:function(e){t.editModal=e},expression:"editModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot tahriri")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeEditModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("ValidationObserver",{ref:"formEditIncomeThread",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit,s=e.invalid;return[n("form",{staticClass:"aksessuar_add__content",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeEditModal}},[t._v("Bekor qilish ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading,disabled:s,type:"submit"},on:{click:function(e){t.loader="loading"}}},[t._v("Tahrirlash ")])],1)],1)]}}])})],1)],1),n("DeleteModal",{attrs:{deleteModal:t.deleteModal}})],1)},i=[],c=a("5530"),l=a("1da1"),o=(a("159b"),a("b0c0"),a("96cf"),a("2f62")),d=a("0688"),u=a("bbf1"),f=a("5f48"),v={mixins:[d["a"],u["b"]],components:{DeleteModal:f["a"]},data:function(){return{page:1,pageCount:0,editModal:!1,deleteModal:!1,headers:[{text:"Status",value:"status"},{text:"Qayerdan",value:"direction"},{text:"Kodi",value:"code"},{text:"Nomi",value:"name"},{text:"Massa",value:"amount"},{text:"Rangi",value:"color_code"},{text:"Sana",value:"date"},{text:"Harakatlar",value:"actions",align:"center"}],items:[],styles:{background:"blue"}}},watch:{page:function(){var t=Object(l["a"])(regeneratorRuntime.mark((function t(e,a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!e){t.next=3;break}return t.next=3,this.refresh();case 3:case"end":return t.stop()}}),t,this)})));function e(e,a){return t.apply(this,arguments)}return e}()},mounted:function(){var t=this;return Object(l["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh();case 2:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])({},Object(o["d"])({ready_raw:function(t){return t.supply.ready_raw}})),methods:Object(c["a"])(Object(c["a"])({},Object(o["b"])({fetchReadyRaw:"supply/fetchReadyRaw"})),{},{refresh:function(){var t=this;return Object(l["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loading=!0,e.next=3,t.fetchReadyRaw({page:t.page,factory:7,type:"painting",parent_id:3});case 3:t.page=t.ready_raw.current_page,t.pageCount=Math.ceil(t.ready_raw.total/10),t.items=t.ready_raw.data,t.items.forEach((function(e){e.direction="Bo`yoqxonadan",e.code=e.order.product.code,e.name=e.order.product.name,e.color_code=e.order.color_code,e.date=t.$dayjs(e.created_at).format("DD-MM-YYYY")})),t.loading=!1;case 8:case"end":return e.stop()}}),e)})))()},closeEditModal:function(){this.editModal=!1}})},p=v,m=a("2877"),h=a("6544"),g=a.n(h),b=a("8336"),_=a("b0af"),y=a("99d9"),x=a("8fea"),k=a("169a"),C=a("891e"),j=Object(m["a"])(p,r,i,!1,null,null,null),w=j.exports;g()(j,{VBtn:b["a"],VCard:_["a"],VCardActions:y["a"],VDataTable:x["a"],VDialog:k["a"],VPagination:C["a"]});var M=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-data-table",{attrs:{headers:t.headers,items:t.items,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.status",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.direction",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color_code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.date",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.status",fn:function(t){t.item;return[n("div",{staticClass:"d-flex justify-start"},[n("img",{attrs:{src:a("8b44"),alt:""}})])]}},{key:"item.direction",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.direction))])])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.color_code",fn:function(e){var a=e.item;return[a.color_code?n("div",{staticClass:"d-flex justify-center"},[n("div",{staticClass:"small_circle",style:{background:a.color_code}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color_code))])]):n("div",{staticClass:"d-flex justify-center"},[t._v(" - ")])]}},{key:"item.date",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.date))])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_yoqa_chiqim")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_yoqa_chiqim")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])}),n("v-pagination",{staticClass:"my-2",attrs:{length:t.pageCount,"total-visible":"7"},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}}),n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.editModal,callback:function(e){t.editModal=e},expression:"editModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot tahriri")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeEditModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("ValidationObserver",{ref:"formEditIncomeThread",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit,s=e.invalid;return[n("form",{staticClass:"aksessuar_add__content",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeEditModal}},[t._v("Bekor qilish ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading,disabled:s,type:"submit"},on:{click:function(e){t.loader="loading"}}},[t._v("Tahrirlash ")])],1)],1)]}}])})],1)],1),n("DeleteModal",{attrs:{deleteModal:t.deleteModal}})],1)},O=[],S={mixins:[d["a"],u["b"]],components:{DeleteModal:f["a"]},data:function(){return{page:1,pageCount:0,editModal:!1,deleteModal:!1,loading:!1,headers:[{text:"Status",value:"status",align:"left"},{text:"Qayerga",value:"direction",align:"center"},{text:"Kodi",value:"code",align:"center"},{text:"Nomi",value:"name",align:"center"},{text:"Massa",value:"amount",align:"center"},{text:"Rangi",value:"color_code",align:"center"},{text:"Sana",value:"date",align:"center"},{text:"Harakatlar",value:"actions",align:"center"}],items:[]}},watch:{page:function(){var t=Object(l["a"])(regeneratorRuntime.mark((function t(e,a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!e){t.next=3;break}return t.next=3,this.refresh(e);case 3:case"end":return t.stop()}}),t,this)})));function e(e,a){return t.apply(this,arguments)}return e}()},mounted:function(){var t=this;return Object(l["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh(t.page);case 2:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])({},Object(o["d"])({order_extra_product:function(t){return t.supply.order_extra_product}})),methods:Object(c["a"])(Object(c["a"])({},Object(o["b"])({fetchOrderExtraProduct:"supply/fetchOrderExtraProduct"})),{},{refresh:function(){var t=this;return Object(l["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loading=!0,e.next=3,t.fetchOrderExtraProduct({page:t.page,parent_id:3});case 3:t.page=t.order_extra_product.current_page,t.pageCount=Math.ceil(t.order_extra_product.total/10),t.items=t.order_extra_product.data,t.items.forEach((function(e){e.direction=e.order.factory.name,e.type=e.product.product_category.name,e.name=e.product.name,e.code=e.product.code,e.color_code=e.order.color_code,e.date=t.$dayjs(e.created_at).format("DD-MM-YYYY")})),t.loading=!1;case 8:case"end":return e.stop()}}),e)})))()},closeEditModal:function(){this.editModal=!1}})},$=S,V=Object(m["a"])($,M,O,!1,null,null,null),B=V.exports;g()(V,{VBtn:b["a"],VCard:_["a"],VCardActions:y["a"],VDataTable:x["a"],VDialog:k["a"],VPagination:C["a"]});var R=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-row",[n("v-col",[n("v-data-table",{attrs:{headers:t.headers,items:t.items,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.type",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color_code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-start"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.type",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.type))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.color_code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("div",{staticClass:"small_circle",style:{background:a.color_code}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color_code))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_yoqa_mavjud")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_yoqa_mavjud")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])})],1),n("div",{staticStyle:{"border-right":"1px solid #ececec"}}),n("v-col",[n("v-data-table",{attrs:{headers:t.headers,items:t.items2,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.type",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color_code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-start"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.type",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.type))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.color_code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("div",{staticClass:"small_circle",style:{background:a.color_code}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color_code))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_yoqa_mavjud")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_yoqa_mavjud")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])})],1)],1),n("v-row",[n("v-col",[n("v-pagination",{staticClass:"my-2",attrs:{length:t.pageCount,"total-visible":"7"},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}})],1)],1),n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.editModal,callback:function(e){t.editModal=e},expression:"editModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot tahriri")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeEditModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("ValidationObserver",{ref:"formEditIncomeThread",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit,s=e.invalid;return[n("form",{staticClass:"aksessuar_add__content",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeEditModal}},[t._v("Bekor qilish ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading,disabled:s,type:"submit"},on:{click:function(e){t.loader="loading"}}},[t._v("Tahrirlash ")])],1)],1)]}}])})],1)],1),n("DeleteModal",{attrs:{deleteModal:t.deleteModal}})],1)},E=[],D=(a("fb6a"),{mixins:[d["a"],u["b"]],components:{DeleteModal:f["a"]},data:function(){return{page:1,pageCount:0,editModal:!1,deleteModal:!1,headers:[{text:"Kodi",value:"code",align:"center"},{text:"Turi",value:"type",align:"center"},{text:"Nomi",value:"name",align:"center"},{text:"Rangi",value:"color_code",align:"center"},{text:"Massa",value:"amount",align:"center"},{text:"Harakatlar",value:"actions",align:"center"}],items:[],items2:[]}},watch:{page:function(){var t=Object(l["a"])(regeneratorRuntime.mark((function t(e,a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!e){t.next=3;break}return t.next=3,this.refresh();case 3:case"end":return t.stop()}}),t,this)})));function e(e,a){return t.apply(this,arguments)}return e}()},mounted:function(){var t=this;return Object(l["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh();case 2:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])({},Object(o["d"])({storage_painted_product:function(t){return t.supply.storage_painted_product}})),methods:Object(c["a"])(Object(c["a"])({},Object(o["b"])({fetchStoragePaintedProduct:"supply/fetchStoragePaintedProduct"})),{},{refresh:function(){var t=this;return Object(l["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loading=!0,e.next=3,t.fetchStoragePaintedProduct({page:t.page,product_case:"painted",parent_id:3});case 3:t.page=t.storage_painted_product.current_page,t.pageCount=Math.ceil(t.storage_painted_product.total/20),t.items2=t.storage_painted_product.data.slice(10,t.storage_painted_product.data.length),t.items=t.storage_painted_product.data,t.items.forEach((function(t){t.code=t.product.code,t.type=t.product.product_category.name,t.name=t.product.name,t.color_code=t.color})),t.loading=!1;case 9:case"end":return e.stop()}}),e)})))()},closeEditModal:function(){this.editModal=!1}})}),q=D,I=a("62ad"),P=a("0fd9"),L=Object(m["a"])(q,R,E,!1,null,null,null),T=L.exports;g()(L,{VBtn:b["a"],VCard:_["a"],VCardActions:y["a"],VCol:I["a"],VDataTable:x["a"],VDialog:k["a"],VPagination:C["a"],VRow:P["a"]});var N={components:{Income:w,Outcome:B,ExistedReadyCollar:T},data:function(){return{tab:""}}},A=N,Y=a("ce7e"),F=a("71a3"),z=a("c671"),H=a("fe57"),K=a("aac8"),W=a("9a96"),G=Object(m["a"])(A,n,s,!1,null,null,null);e["default"]=G.exports;g()(G,{VBtn:b["a"],VCol:I["a"],VDivider:Y["a"],VTab:F["a"],VTabItem:z["a"],VTabs:H["a"],VTabsItems:K["a"],VTabsSlider:W["a"]})},"3ff7":function(t,e,a){t.exports=a.p+"img/trush-square.2b9cacac.svg"},"4b85":function(t,e,a){},"5f48":function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.deleteModal,callback:function(e){t.deleteModal=e},expression:"deleteModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot o‘chirilishi")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeDeleteModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("div",{staticClass:"pb-5 pt-4 mb-3 text-muted border-bottom"},[t._v(" Bu mahsulotni o‘chirmoqchimisiz? ")]),n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeDeleteModal}},[t._v("Yo‘q ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading}},[t._v("Ha ")])],1)],1)],1)],1)},s=[],r=a("1da1"),i=a("5530"),c=(a("96cf"),a("2f62")),l=a("bbf1"),o={mixins:[l["b"]],props:["deleteModal"],data:function(){return{}},computed:Object(i["a"])({},Object(c["d"])({})),methods:Object(i["a"])(Object(i["a"])({},Object(c["b"])({})),{},{closeDeleteModal:function(){this.deleteModal=!1},removeProduct:function(){var t=this;return Object(r["a"])(regeneratorRuntime.mark((function e(){var a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loader="loading",e.next=3,t.$store.dispatch("code/removeProduct",t.item);case 3:t.$emit("updateTable",!0),t.closeModal(),a="Muvaffaqiyatli ochirildi!",t.$toast.success(a);case 7:case"end":return e.stop()}}),e)})))()}})},d=o,u=a("2877"),f=a("6544"),v=a.n(f),p=a("8336"),m=a("b0af"),h=a("99d9"),g=a("169a"),b=Object(u["a"])(d,n,s,!1,null,"785e1094",null);e["a"]=b.exports;v()(b,{VBtn:p["a"],VCard:m["a"],VCardActions:h["a"],VDialog:g["a"]})},"62ad":function(t,e,a){"use strict";a("4b85");var n=a("2b0e"),s=a("d9f7"),r=a("80d2");const i=["sm","md","lg","xl"],c=(()=>i.reduce((t,e)=>(t[e]={type:[Boolean,String,Number],default:!1},t),{}))(),l=(()=>i.reduce((t,e)=>(t["offset"+Object(r["F"])(e)]={type:[String,Number],default:null},t),{}))(),o=(()=>i.reduce((t,e)=>(t["order"+Object(r["F"])(e)]={type:[String,Number],default:null},t),{}))(),d={col:Object.keys(c),offset:Object.keys(l),order:Object.keys(o)};function u(t,e,a){let n=t;if(null!=a&&!1!==a){if(e){const a=e.replace(t,"");n+="-"+a}return"col"!==t||""!==a&&!0!==a?(n+="-"+a,n.toLowerCase()):n.toLowerCase()}}const f=new Map;e["a"]=n["a"].extend({name:"v-col",functional:!0,props:{cols:{type:[Boolean,String,Number],default:!1},...c,offset:{type:[String,Number],default:null},...l,order:{type:[String,Number],default:null},...o,alignSelf:{type:String,default:null,validator:t=>["auto","start","end","center","baseline","stretch"].includes(t)},tag:{type:String,default:"div"}},render(t,{props:e,data:a,children:n,parent:r}){let i="";for(const s in e)i+=String(e[s]);let c=f.get(i);if(!c){let t;for(t in c=[],d)d[t].forEach(a=>{const n=e[a],s=u(t,a,n);s&&c.push(s)});const a=c.some(t=>t.startsWith("col-"));c.push({col:!a||!e.cols,["col-"+e.cols]:e.cols,["offset-"+e.offset]:e.offset,["order-"+e.order]:e.order,["align-self-"+e.alignSelf]:e.alignSelf}),f.set(i,c)}return t(e.tag,Object(s["a"])(a,{class:c}),n)}})},"891e":function(t,e,a){"use strict";a("17b3");var n=a("9d26"),s=a("dc22"),r=a("a9ad"),i=a("de2c"),c=a("7560"),l=a("58df");e["a"]=Object(l["a"])(r["a"],Object(i["a"])({onVisible:["init"]}),c["a"]).extend({name:"v-pagination",directives:{Resize:s["a"]},props:{circle:Boolean,disabled:Boolean,length:{type:Number,default:0,validator:t=>t%1===0},nextIcon:{type:String,default:"$next"},prevIcon:{type:String,default:"$prev"},totalVisible:[Number,String],value:{type:Number,default:0},pageAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.page"},currentPageAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.currentPage"},previousAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.previous"},nextAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.next"},wrapperAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.wrapper"}},data(){return{maxButtons:0,selected:null}},computed:{classes(){return{"v-pagination":!0,"v-pagination--circle":this.circle,"v-pagination--disabled":this.disabled,...this.themeClasses}},items(){const t=parseInt(this.totalVisible,10);if(0===t)return[];const e=Math.min(Math.max(0,t)||this.length,Math.max(0,this.maxButtons)||this.length,this.length);if(this.length<=e)return this.range(1,this.length);const a=e%2===0?1:0,n=Math.floor(e/2),s=this.length-n+1+a;if(this.value>n&&this.value<s){const t=1,e=this.length,s=this.value-n+2,r=this.value+n-2-a,i=s-1===t+1?2:"...",c=r+1===e-1?r+1:"...";return[1,i,...this.range(s,r),c,this.length]}if(this.value===n){const t=this.value+n-1-a;return[...this.range(1,t),"...",this.length]}if(this.value===s){const t=this.value-n+1;return[1,"...",...this.range(t,this.length)]}return[...this.range(1,n),"...",...this.range(s,this.length)]}},watch:{value(){this.init()}},mounted(){this.init()},methods:{init(){this.selected=null,this.$nextTick(this.onResize),setTimeout(()=>this.selected=this.value,100)},onResize(){const t=this.$el&&this.$el.parentElement?this.$el.parentElement.clientWidth:window.innerWidth;this.maxButtons=Math.floor((t-96)/42)},next(t){t.preventDefault(),this.$emit("input",this.value+1),this.$emit("next")},previous(t){t.preventDefault(),this.$emit("input",this.value-1),this.$emit("previous")},range(t,e){const a=[];t=t>0?t:1;for(let n=t;n<=e;n++)a.push(n);return a},genIcon(t,e,a,s,r){return t("li",[t("button",{staticClass:"v-pagination__navigation",class:{"v-pagination__navigation--disabled":a},attrs:{disabled:a,type:"button","aria-label":r},on:a?{}:{click:s}},[t(n["a"],[e])])])},genItem(t,e){const a=e===this.value&&(this.color||"primary"),n=e===this.value,s=n?this.currentPageAriaLabel:this.pageAriaLabel;return t("button",this.setBackgroundColor(a,{staticClass:"v-pagination__item",class:{"v-pagination__item--active":e===this.value},attrs:{type:"button","aria-current":n,"aria-label":this.$vuetify.lang.t(s,e)},on:{click:()=>this.$emit("input",e)}}),[e.toString()])},genItems(t){return this.items.map((e,a)=>t("li",{key:a},[isNaN(Number(e))?t("span",{class:"v-pagination__more"},[e.toString()]):this.genItem(t,e)]))},genList(t,e){return t("ul",{directives:[{modifiers:{quiet:!0},name:"resize",value:this.onResize}],class:this.classes},e)}},render(t){const e=[this.genIcon(t,this.$vuetify.rtl?this.nextIcon:this.prevIcon,this.value<=1,this.previous,this.$vuetify.lang.t(this.previousAriaLabel)),this.genItems(t),this.genIcon(t,this.$vuetify.rtl?this.prevIcon:this.nextIcon,this.value>=this.length,this.next,this.$vuetify.lang.t(this.nextAriaLabel))];return t("nav",{attrs:{role:"navigation","aria-label":this.$vuetify.lang.t(this.wrapperAriaLabel)}},[this.genList(t,e)])}})},"8b44":function(t,e,a){t.exports=a.p+"img/exitimg.a5bf077e.svg"},b05f:function(t,e,a){t.exports=a.p+"img/filter.3e95d629.svg"},caa3:function(t,e,a){t.exports=a.p+"img/enterimg.18076626.svg"},daf0:function(t,e,a){t.exports=a.p+"img/edit.9866f6a2.svg"}}]);
//# sourceMappingURL=chunk-276f44a8.04d3a545.js.map