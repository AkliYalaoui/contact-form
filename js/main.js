new Vue({
 el: '#app' ,
 data :{
    // to close the alert
    closed : 'display-block',
    // for username input field
    showUser   : 'display-none',
    asterixUser : 'display-block',
    borderUser : '',
    // for Email input field
    showMail   : 'display-none',
    asterixMail : 'display-block',
    borderMail : '',
    // for message input field
    showMsg   : 'display-none',
    asterixMsg : 'display-block',
    borderMsg : '',
    //check for $formErrors
    errorUser : true,
    errorMail : true,
    errorMsg : true,
 },
 methods:{
   closeAlert : function(){
      this.closed = 'display-none';
   },
   showError : function(e){
     switch (e) {
        case 'username':
             if(  this.$refs.username.value.length<4 )
             {
                this.showUser  = 'display-block';
                this.asterixUser  = 'display-block';
                this.borderUser = 'red' ;
                this.errorUser = true;
             }
             else {
                  this.showUser  = 'display-none';
                  this.asterixUser  = 'display-none';
                  this.borderUser = 'green' ;
                  this.errorUser = false;
             }
         break;
         case 'email':
              if(  this.$refs.email.value.length == 0 )
              {
                 this.showMail  = 'display-block';
                 this.asterixMail  = 'display-block';
                 this.borderMail = 'red' ;
                 this.errorMail = true;
              }
              else {
                   this.showMail  = 'display-none';
                   this.asterixMail  = 'display-none';
                   this.borderMail = 'green' ;
                   this.errorMail = false;
                }
         break;
         case 'msg':
              if(  this.$refs.msg.value.length < 10 )
              {
                 this.showMsg  = 'display-block';
                 this.asterixMsg  = 'display-block';
                 this.borderMsg = 'red' ;
                 this.errorMsg = true;
              }
              else {
                   this.showMsg  = 'display-none';
                   this.asterixMsg  = 'display-none';
                   this.borderMsg = 'green' ;
                   this.errorMsg = false;
                }
         break;
       default:
           console.log("err");
     }
   },
   clickable : function(e){
     if(this.erroUser || this.errorMail || this.errorMsg){
       this.showError('username');
       this.showError('email');
       this.showError('msg');
       e.preventDefault();
     }
   }
 }
});
