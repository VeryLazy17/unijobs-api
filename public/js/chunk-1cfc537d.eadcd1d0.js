(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1cfc537d"],{"0688":function(t,e,a){"use strict";a.d(e,"a",(function(){return n}));a("ac1f"),a("5319"),a("d3b7"),a("25f0");var n={methods:{formatPrice:function(t){if(t){var e=t.toString().replace(/,/g,"");return e=parseFloat(e),e=new Intl.NumberFormat("en-US",{minimumFractionDigits:0,maximumFractionDigits:2}).format(e),e}return 0}}}},"0fd9":function(t,e,a){"use strict";var n=a("ade3"),r=a("5530"),i=(a("caad"),a("2532"),a("99af"),a("b64b"),a("ac1f"),a("5319"),a("4ec9"),a("d3b7"),a("3ca3"),a("ddb0"),a("159b"),a("4b85"),a("2b0e")),s=a("d9f7"),c=a("80d2"),o=["sm","md","lg","xl"],l=["start","end","center"];function u(t,e){return o.reduce((function(a,n){return a[t+Object(c["F"])(n)]=e(),a}),{})}var d=function(t){return[].concat(l,["baseline","stretch"]).includes(t)},f=u("align",(function(){return{type:String,default:null,validator:d}})),v=function(t){return[].concat(l,["space-between","space-around"]).includes(t)},p=u("justify",(function(){return{type:String,default:null,validator:v}})),m=function(t){return[].concat(l,["space-between","space-around","stretch"]).includes(t)},h=u("alignContent",(function(){return{type:String,default:null,validator:m}})),b={align:Object.keys(f),justify:Object.keys(p),alignContent:Object.keys(h)},g={align:"align",justify:"justify",alignContent:"align-content"};function _(t,e,a){var n=g[t];if(null!=a){if(e){var r=e.replace(t,"");n+="-".concat(r)}return n+="-".concat(a),n.toLowerCase()}}var y=new Map;e["a"]=i["a"].extend({name:"v-row",functional:!0,props:Object(r["a"])(Object(r["a"])(Object(r["a"])({tag:{type:String,default:"div"},dense:Boolean,noGutters:Boolean,align:{type:String,default:null,validator:d}},f),{},{justify:{type:String,default:null,validator:v}},p),{},{alignContent:{type:String,default:null,validator:m}},h),render:function(t,e){var a=e.props,r=e.data,i=e.children,c="";for(var o in a)c+=String(a[o]);var l=y.get(c);return l||function(){var t,e;for(e in l=[],b)b[e].forEach((function(t){var n=a[t],r=_(e,t,n);r&&l.push(r)}));l.push((t={"no-gutters":a.noGutters,"row--dense":a.dense},Object(n["a"])(t,"align-".concat(a.align),a.align),Object(n["a"])(t,"justify-".concat(a.justify),a.justify),Object(n["a"])(t,"align-content-".concat(a.alignContent),a.alignContent),t)),y.set(c,l)}(),t(a.tag,Object(s["a"])(r,{staticClass:"row",class:l}),i)}})},"17b3":function(t,e,a){},"3ff7":function(t,e,a){t.exports=a.p+"img/trush-square.2b9cacac.svg"},"49bb":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"supply",attrs:{id:"supply_mato"}},[n("div",{staticClass:"tabs"},[n("v-tabs",{attrs:{color:"black"},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[n("v-tabs-slider",{attrs:{color:"tab-slider-color"}}),n("v-tab",{attrs:{href:"#tab-1"}},[t._v(" Kirim ")]),n("v-tab",{attrs:{href:"#tab-2"}},[t._v(" Chiqim ")]),n("v-tab",{attrs:{href:"#tab-3"}},[t._v(" Mavjud tayyor matolar ")])],1),n("v-col",{attrs:{cols:"auto"}},[n("div",{staticClass:"d-flex align-center"},[t.$can("read","supply_tayyor_mato_filter")?n("v-btn",{attrs:{elevation:"0"}},[n("img",{attrs:{src:a("b05f"),alt:"filter"}})]):t._e()],1)])],1),n("v-divider"),n("v-tabs-items",{staticClass:"tab-items",model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[n("v-tab-item",{attrs:{value:"tab-1"}},[t.$can("read","supply_tayyor_mato_kirim")?n("Income"):t._e()],1),n("v-tab-item",{attrs:{value:"tab-2"}},[t.$can("read","supply_tayyor_mato_chiqim")?n("Outcome"):t._e()],1),n("v-tab-item",{attrs:{value:"tab-3"}},[t.$can("read","supply_tayyor_mato_mavjud")?n("ExistedReadyMaterial"):t._e()],1)],1)],1)},r=[],i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-data-table",{attrs:{headers:t.headers,items:t.items,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.status",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.direction",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color_code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.date",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.status",fn:function(t){t.item;return[n("div",{staticClass:"d-flex"},[n("img",{attrs:{src:a("caa3"),alt:""}})])]}},{key:"item.direction",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.direction))])])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.color_code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("div",{staticClass:"small_circle",style:{background:a.color_code}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color_code))])])]}},{key:"item.date",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.date))])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_mato_kirim")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_mato_kirim")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])}),n("v-pagination",{staticClass:"my-2",attrs:{length:t.pageCount,"total-visible":"7"},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}}),n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.editModal,callback:function(e){t.editModal=e},expression:"editModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot tahriri")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeEditModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("ValidationObserver",{ref:"formEditIncomeThread",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit,r=e.invalid;return[n("form",{staticClass:"aksessuar_add__content",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeEditModal}},[t._v("Bekor qilish ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading,disabled:r,type:"submit"},on:{click:function(e){t.loader="loading"}}},[t._v("Tahrirlash ")])],1)],1)]}}])})],1)],1),n("DeleteModal",{attrs:{deleteModal:t.deleteModal}})],1)},s=[],c=a("5530"),o=a("1da1"),l=(a("159b"),a("b0c0"),a("96cf"),a("2f62")),u=a("0688"),d=a("bbf1"),f=a("5f48"),v={mixins:[u["a"],d["b"]],components:{DeleteModal:f["a"]},data:function(){return{page:1,pageCount:0,editModal:!1,deleteModal:!1,headers:[{text:"Status",value:"status"},{text:"Qayerdan",value:"direction"},{text:"Kodi",value:"code"},{text:"Nomi",value:"name"},{text:"Massa",value:"amount"},{text:"Rangi",value:"color_code"},{text:"Sana",value:"date"},{text:"Harakatlar",value:"actions",align:"center"}],items:[]}},watch:{page:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(e,a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!e){t.next=3;break}return t.next=3,this.refresh();case 3:case"end":return t.stop()}}),t,this)})));function e(e,a){return t.apply(this,arguments)}return e}()},mounted:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh();case 2:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])({},Object(l["d"])({ready_raw:function(t){return t.supply.ready_raw}})),methods:Object(c["a"])(Object(c["a"])({},Object(l["b"])({fetchReadyRaw:"supply/fetchReadyRaw"})),{},{refresh:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loading=!0,e.next=3,t.fetchReadyRaw({page:t.page,factory:7,type:"painting",parent_id:2});case 3:t.page=t.ready_raw.current_page,t.pageCount=Math.ceil(t.ready_raw.total/10),t.items=t.ready_raw.data,t.items.forEach((function(e){e.direction="Bo`yoqxonadan",e.code=e.order.product.code,e.name=e.order.product.name,e.color_code=e.order.color_code,e.date=t.$dayjs(e.created_at).format("DD-MM-YYYY")})),t.loading=!1;case 8:case"end":return e.stop()}}),e)})))()},closeEditModal:function(){this.editModal=!1}})},p=v,m=a("2877"),h=a("6544"),b=a.n(h),g=a("8336"),_=a("b0af"),y=a("99d9"),x=a("8fea"),k=a("169a"),C=a("891e"),j=Object(m["a"])(p,i,s,!1,null,null,null),O=j.exports;b()(j,{VBtn:g["a"],VCard:_["a"],VCardActions:y["a"],VDataTable:x["a"],VDialog:k["a"],VPagination:C["a"]});var w=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-data-table",{attrs:{headers:t.headers,items:t.items,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.status",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.direction",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color_code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.date",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.status",fn:function(e){var r=e.item;return[n("div",{staticClass:"d-flex justify-start"},[r.status?n("img",{attrs:{src:a("caa3"),alt:""}}):t._e(),r.status?t._e():n("img",{attrs:{src:a("8b44"),alt:""}})])]}},{key:"item.direction",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.direction))])])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.color_code",fn:function(e){var a=e.item;return[a.color_code?n("div",{staticClass:"d-flex justify-center"},[n("div",{staticClass:"small_circle",style:{background:a.color_code}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color_code))])]):n("div",{staticClass:"d-flex justify-center"},[t._v(" - ")])]}},{key:"item.date",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex  justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.date))])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_mato_chiqim")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_mato_chiqim")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])}),n("v-pagination",{staticClass:"my-2",attrs:{length:t.pageCount,"total-visible":"7"},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}}),n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.editModal,callback:function(e){t.editModal=e},expression:"editModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot tahriri")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeEditModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("ValidationObserver",{ref:"formEditIncomeThread",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit,r=e.invalid;return[n("form",{staticClass:"aksessuar_add__content",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeEditModal}},[t._v("Bekor qilish ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading,disabled:r,type:"submit"},on:{click:function(e){t.loader="loading"}}},[t._v("Tahrirlash ")])],1)],1)]}}])})],1)],1),n("DeleteModal",{attrs:{deleteModal:t.deleteModal}})],1)},M=[],S={mixins:[u["a"],d["b"]],components:{DeleteModal:f["a"]},data:function(){return{page:1,pageCount:0,editModal:!1,deleteModal:!1,loading:!1,headers:[{text:"Status",value:"status",align:"left"},{text:"Qayerga",value:"direction",align:"center"},{text:"Kodi",value:"code",align:"center"},{text:"Nomi",value:"name",align:"center"},{text:"Massa",value:"amount",align:"center"},{text:"Rangi",value:"color_code",align:"center"},{text:"Sana",value:"date",align:"center"},{text:"Harakatlar",value:"actions",align:"center"}],items:[]}},watch:{page:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(e,a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!e){t.next=3;break}return t.next=3,this.refresh(e);case 3:case"end":return t.stop()}}),t,this)})));function e(e,a){return t.apply(this,arguments)}return e}()},mounted:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh(t.page);case 2:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])({},Object(l["d"])({order_extra_product:function(t){return t.supply.order_extra_product}})),methods:Object(c["a"])(Object(c["a"])({},Object(l["b"])({fetchOrderExtraProduct:"supply/fetchOrderExtraProduct"})),{},{refresh:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loading=!0,e.next=3,t.fetchOrderExtraProduct({page:t.page,parent_id:2});case 3:t.page=t.order_extra_product.current_page,t.pageCount=Math.ceil(t.order_extra_product.total/10),t.items=t.order_extra_product.data,t.items.forEach((function(e){e.direction=e.order.factory.name,e.type=e.product.product_category.name,e.name=e.product.name,e.code=e.product.code,e.color_code=e.order.color_code,console.log(e.color_code),e.date=t.$dayjs(e.created_at).format("DD-MM-YYYY")})),t.loading=!1;case 8:case"end":return e.stop()}}),e)})))()},closeEditModal:function(){this.editModal=!1}})},$=S,V=Object(m["a"])($,w,M,!1,null,null,null),B=V.exports;b()(V,{VBtn:g["a"],VCard:_["a"],VCardActions:y["a"],VDataTable:x["a"],VDialog:k["a"],VPagination:C["a"]});var R=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-row",[n("v-col",[n("v-data-table",{attrs:{headers:t.headers,items:t.items,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.type",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.type",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.type))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.color",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("div",{staticClass:"small_circle",style:{background:a.color}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_mato_mavjud")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_mato_mavjud")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])})],1),n("div",{staticStyle:{"border-right":"1px solid #ececec"}}),n("v-col",[n("v-data-table",{attrs:{headers:t.headers,items:t.items2,"item-key":"name",loading:t.loading,"disable-sort":"","hide-default-footer":""},scopedSlots:t._u([{key:"header.code",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.type",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.name",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.color",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.amount",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"header.actions",fn:function(e){var a=e.header;return[n("span",{staticClass:"table-header"},[t._v(t._s(a.text))])]}},{key:"item.code",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v("#"+t._s(a.code))])])]}},{key:"item.type",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.type))])])]}},{key:"item.name",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(a.name))])])]}},{key:"item.color",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("div",{staticClass:"small_circle",style:{background:a.color}}),n("span",{staticClass:"text-black"},[t._v(t._s(a.color))])])]}},{key:"item.amount",fn:function(e){var a=e.item;return[n("div",{staticClass:"d-flex justify-center"},[n("span",{staticClass:"text-black"},[t._v(t._s(t.formatPrice(a.amount))+" kg")])])]}},{key:"item.actions",fn:function(e){e.item;return[n("div",{staticClass:"d-flex align-center justify-center"},[t.$can("update","supply_tayyor_mato_mavjud")?n("div",{staticClass:"cursor-pointer mr-2 mt-1"},[n("img",{staticClass:"cursor-pointer",attrs:{src:a("daf0"),alt:"edit"}})]):t._e(),t.$can("delete","supply_tayyor_mato_mavjud")?n("div",{staticClass:"cursor-pointer mt-1"},[n("img",{attrs:{src:a("3ff7"),alt:"edit-2"}})]):t._e()])]}}])})],1)],1),n("v-row",[n("v-col",[n("v-pagination",{staticClass:"my-2",attrs:{length:t.pageCount,"total-visible":"7"},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}})],1)],1),n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.editModal,callback:function(e){t.editModal=e},expression:"editModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot tahriri")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeEditModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("ValidationObserver",{ref:"formEditIncomeThread",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit,r=e.invalid;return[n("form",{staticClass:"aksessuar_add__content",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeEditModal}},[t._v("Bekor qilish ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading,disabled:r,type:"submit"},on:{click:function(e){t.loader="loading"}}},[t._v("Tahrirlash ")])],1)],1)]}}])})],1)],1),n("DeleteModal",{attrs:{deleteModal:t.deleteModal}})],1)},E=[],D=(a("fb6a"),{mixins:[u["a"],d["b"]],components:{DeleteModal:f["a"]},data:function(){return{page:1,pageCount:0,editModal:!1,deleteModal:!1,headers:[{text:"Kodi",value:"code",align:"center"},{text:"Turi",value:"type",align:"center"},{text:"Nomi",value:"name",align:"center"},{text:"Rangi",value:"color",align:"center"},{text:"Massa",value:"amount",align:"center"},{text:"Harakatlar",value:"actions",align:"center"}],items:[],items2:[]}},watch:{page:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(e,a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!e){t.next=3;break}return t.next=3,this.refresh();case 3:case"end":return t.stop()}}),t,this)})));function e(e,a){return t.apply(this,arguments)}return e}()},mounted:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh();case 2:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])({},Object(l["d"])({storage_painted_product:function(t){return t.supply.storage_painted_product}})),methods:Object(c["a"])(Object(c["a"])({},Object(l["b"])({fetchStoragePaintedProduct:"supply/fetchStoragePaintedProduct"})),{},{refresh:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loading=!0,e.next=3,t.fetchStoragePaintedProduct({page:t.page,product_case:"painted",parent_id:2});case 3:t.page=t.storage_painted_product.current_page,t.pageCount=Math.ceil(t.storage_painted_product.total/20),t.items2=t.storage_painted_product.data.slice(10,t.storage_painted_product.data.length),t.items=t.storage_painted_product.data,t.items.forEach((function(t){t.type=t.product.product_category.name,t.code=t.product.code,t.name=t.product.name})),t.loading=!1;case 9:case"end":return e.stop()}}),e)})))()},closeEditModal:function(){this.editModal=!1}})}),I=D,P=a("62ad"),L=a("0fd9"),T=Object(m["a"])(I,R,E,!1,null,null,null),N=T.exports;b()(T,{VBtn:g["a"],VCard:_["a"],VCardActions:y["a"],VCol:P["a"],VDataTable:x["a"],VDialog:k["a"],VPagination:C["a"],VRow:L["a"]});var A={components:{Income:O,Outcome:B,ExistedReadyMaterial:N},data:function(){return{tab:""}}},q=A,Y=a("ce7e"),F=a("71a3"),z=a("c671"),H=a("fe57"),K=a("aac8"),W=a("9a96"),G=Object(m["a"])(q,n,r,!1,null,null,null);e["default"]=G.exports;b()(G,{VBtn:g["a"],VCol:P["a"],VDivider:Y["a"],VTab:F["a"],VTabItem:z["a"],VTabs:H["a"],VTabsItems:K["a"],VTabsSlider:W["a"]})},"4b85":function(t,e,a){},"5f48":function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("v-dialog",{attrs:{"max-width":"400",persistent:""},model:{value:t.deleteModal,callback:function(e){t.deleteModal=e},expression:"deleteModal"}},[n("v-card",{staticClass:"aksessuar_add"},[n("div",{staticClass:"aksessuar_add__title"},[n("span",{staticClass:"text-black"},[t._v("Mahsulot o‘chirilishi")]),n("v-btn",{attrs:{icon:""},on:{click:t.closeDeleteModal}},[n("img",{attrs:{src:a("c715"),alt:"BackButton"}})])],1),n("div",{staticClass:"pb-5 pt-4 mb-3 text-muted border-bottom"},[t._v(" Bu mahsulotni o‘chirmoqchimisiz? ")]),n("v-card-actions",{staticClass:"d-flex justify-space-between"},[n("v-btn",{staticClass:"backBtn",attrs:{text:"",elevation:"0"},on:{click:t.closeDeleteModal}},[t._v("Yo‘q ")]),n("v-btn",{staticClass:"primaryBtn",attrs:{elevation:"0",loading:t.loading}},[t._v("Ha ")])],1)],1)],1)],1)},r=[],i=a("1da1"),s=a("5530"),c=(a("96cf"),a("2f62")),o=a("bbf1"),l={mixins:[o["b"]],props:["deleteModal"],data:function(){return{}},computed:Object(s["a"])({},Object(c["d"])({})),methods:Object(s["a"])(Object(s["a"])({},Object(c["b"])({})),{},{closeDeleteModal:function(){this.deleteModal=!1},removeProduct:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.loader="loading",e.next=3,t.$store.dispatch("code/removeProduct",t.item);case 3:t.$emit("updateTable",!0),t.closeModal(),a="Muvaffaqiyatli ochirildi!",t.$toast.success(a);case 7:case"end":return e.stop()}}),e)})))()}})},u=l,d=a("2877"),f=a("6544"),v=a.n(f),p=a("8336"),m=a("b0af"),h=a("99d9"),b=a("169a"),g=Object(d["a"])(u,n,r,!1,null,"785e1094",null);e["a"]=g.exports;v()(g,{VBtn:p["a"],VCard:m["a"],VCardActions:h["a"],VDialog:b["a"]})},"62ad":function(t,e,a){"use strict";var n=a("ade3"),r=a("5530"),i=(a("a9e3"),a("b64b"),a("ac1f"),a("5319"),a("4ec9"),a("d3b7"),a("3ca3"),a("ddb0"),a("caad"),a("159b"),a("2ca0"),a("4b85"),a("2b0e")),s=a("d9f7"),c=a("80d2"),o=["sm","md","lg","xl"],l=function(){return o.reduce((function(t,e){return t[e]={type:[Boolean,String,Number],default:!1},t}),{})}(),u=function(){return o.reduce((function(t,e){return t["offset"+Object(c["F"])(e)]={type:[String,Number],default:null},t}),{})}(),d=function(){return o.reduce((function(t,e){return t["order"+Object(c["F"])(e)]={type:[String,Number],default:null},t}),{})}(),f={col:Object.keys(l),offset:Object.keys(u),order:Object.keys(d)};function v(t,e,a){var n=t;if(null!=a&&!1!==a){if(e){var r=e.replace(t,"");n+="-".concat(r)}return"col"!==t||""!==a&&!0!==a?(n+="-".concat(a),n.toLowerCase()):n.toLowerCase()}}var p=new Map;e["a"]=i["a"].extend({name:"v-col",functional:!0,props:Object(r["a"])(Object(r["a"])(Object(r["a"])(Object(r["a"])({cols:{type:[Boolean,String,Number],default:!1}},l),{},{offset:{type:[String,Number],default:null}},u),{},{order:{type:[String,Number],default:null}},d),{},{alignSelf:{type:String,default:null,validator:function(t){return["auto","start","end","center","baseline","stretch"].includes(t)}},tag:{type:String,default:"div"}}),render:function(t,e){var a=e.props,r=e.data,i=e.children,c=(e.parent,"");for(var o in a)c+=String(a[o]);var l=p.get(c);return l||function(){var t,e;for(e in l=[],f)f[e].forEach((function(t){var n=a[t],r=v(e,t,n);r&&l.push(r)}));var r=l.some((function(t){return t.startsWith("col-")}));l.push((t={col:!r||!a.cols},Object(n["a"])(t,"col-".concat(a.cols),a.cols),Object(n["a"])(t,"offset-".concat(a.offset),a.offset),Object(n["a"])(t,"order-".concat(a.order),a.order),Object(n["a"])(t,"align-self-".concat(a.alignSelf),a.alignSelf),t)),p.set(c,l)}(),t(a.tag,Object(s["a"])(r,{class:l}),i)}})},"891e":function(t,e,a){"use strict";var n=a("2909"),r=a("5530"),i=(a("a9e3"),a("99af"),a("d3b7"),a("25f0"),a("d81d"),a("17b3"),a("9d26")),s=a("dc22"),c=a("a9ad"),o=a("de2c"),l=a("7560"),u=a("58df");e["a"]=Object(u["a"])(c["a"],Object(o["a"])({onVisible:["init"]}),l["a"]).extend({name:"v-pagination",directives:{Resize:s["a"]},props:{circle:Boolean,disabled:Boolean,length:{type:Number,default:0,validator:function(t){return t%1===0}},nextIcon:{type:String,default:"$next"},prevIcon:{type:String,default:"$prev"},totalVisible:[Number,String],value:{type:Number,default:0},pageAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.page"},currentPageAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.currentPage"},previousAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.previous"},nextAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.next"},wrapperAriaLabel:{type:String,default:"$vuetify.pagination.ariaLabel.wrapper"}},data:function(){return{maxButtons:0,selected:null}},computed:{classes:function(){return Object(r["a"])({"v-pagination":!0,"v-pagination--circle":this.circle,"v-pagination--disabled":this.disabled},this.themeClasses)},items:function(){var t=parseInt(this.totalVisible,10);if(0===t)return[];var e=Math.min(Math.max(0,t)||this.length,Math.max(0,this.maxButtons)||this.length,this.length);if(this.length<=e)return this.range(1,this.length);var a=e%2===0?1:0,r=Math.floor(e/2),i=this.length-r+1+a;if(this.value>r&&this.value<i){var s=1,c=this.length,o=this.value-r+2,l=this.value+r-2-a,u=o-1===s+1?2:"...",d=l+1===c-1?l+1:"...";return[1,u].concat(Object(n["a"])(this.range(o,l)),[d,this.length])}if(this.value===r){var f=this.value+r-1-a;return[].concat(Object(n["a"])(this.range(1,f)),["...",this.length])}if(this.value===i){var v=this.value-r+1;return[1,"..."].concat(Object(n["a"])(this.range(v,this.length)))}return[].concat(Object(n["a"])(this.range(1,r)),["..."],Object(n["a"])(this.range(i,this.length)))}},watch:{value:function(){this.init()}},mounted:function(){this.init()},methods:{init:function(){var t=this;this.selected=null,this.$nextTick(this.onResize),setTimeout((function(){return t.selected=t.value}),100)},onResize:function(){var t=this.$el&&this.$el.parentElement?this.$el.parentElement.clientWidth:window.innerWidth;this.maxButtons=Math.floor((t-96)/42)},next:function(t){t.preventDefault(),this.$emit("input",this.value+1),this.$emit("next")},previous:function(t){t.preventDefault(),this.$emit("input",this.value-1),this.$emit("previous")},range:function(t,e){var a=[];t=t>0?t:1;for(var n=t;n<=e;n++)a.push(n);return a},genIcon:function(t,e,a,n,r){return t("li",[t("button",{staticClass:"v-pagination__navigation",class:{"v-pagination__navigation--disabled":a},attrs:{disabled:a,type:"button","aria-label":r},on:a?{}:{click:n}},[t(i["a"],[e])])])},genItem:function(t,e){var a=this,n=e===this.value&&(this.color||"primary"),r=e===this.value,i=r?this.currentPageAriaLabel:this.pageAriaLabel;return t("button",this.setBackgroundColor(n,{staticClass:"v-pagination__item",class:{"v-pagination__item--active":e===this.value},attrs:{type:"button","aria-current":r,"aria-label":this.$vuetify.lang.t(i,e)},on:{click:function(){return a.$emit("input",e)}}}),[e.toString()])},genItems:function(t){var e=this;return this.items.map((function(a,n){return t("li",{key:n},[isNaN(Number(a))?t("span",{class:"v-pagination__more"},[a.toString()]):e.genItem(t,a)])}))},genList:function(t,e){return t("ul",{directives:[{modifiers:{quiet:!0},name:"resize",value:this.onResize}],class:this.classes},e)}},render:function(t){var e=[this.genIcon(t,this.$vuetify.rtl?this.nextIcon:this.prevIcon,this.value<=1,this.previous,this.$vuetify.lang.t(this.previousAriaLabel)),this.genItems(t),this.genIcon(t,this.$vuetify.rtl?this.prevIcon:this.nextIcon,this.value>=this.length,this.next,this.$vuetify.lang.t(this.nextAriaLabel))];return t("nav",{attrs:{role:"navigation","aria-label":this.$vuetify.lang.t(this.wrapperAriaLabel)}},[this.genList(t,e)])}})},"8b44":function(t,e,a){t.exports=a.p+"img/exitimg.a5bf077e.svg"},b05f:function(t,e,a){t.exports=a.p+"img/filter.3e95d629.svg"},caa3:function(t,e,a){t.exports=a.p+"img/enterimg.18076626.svg"},daf0:function(t,e,a){t.exports=a.p+"img/edit.9866f6a2.svg"}}]);
//# sourceMappingURL=chunk-1cfc537d.eadcd1d0.js.map