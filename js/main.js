new Vue({
 el: '#app' ,
 data :{
    closed : 'display-block'
 },
 methods:{
   closeAlert : function(){
      this.closed = 'display-none';
   }
 }
});
