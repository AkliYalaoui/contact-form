new Vue({
 el: '#app' ,
 data :{
    closed : 'display-block',
    show   : 'display-none'
 },
 methods:{
   closeAlert : function(){
      this.closed = 'display-none';
   },
   showError : function(e){

     switch (e) {
        case 'username':
            this.show = this.$refs.username.value.length<4 ? 'display-block': 'display-none';
         break;
       default:
           console.log("err");
     }
   }
 }
});
