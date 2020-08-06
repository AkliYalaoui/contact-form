var $formErrors = [];

//hide All error
var dataErros = document.querySelectorAll('*[data-error] .alert');
for(err of dataErros){
  err.style.display = "none";
}
//check for errors When submiting the form
document.querySelector('form.contact-form').onsubmit = function(e) {
  if($formErrors.length > 0){
    e.preventDefault();
  }else{
    if(document.querySelector('input[data-name="username"]').value.length < 5){
        $formErrors.length ++;
        document.querySelector('[data-error="username"] .alert').style.display = "block";
        document.querySelector('input[data-name="username"]').style.borderColor = "#dc7575";
    }
    if(document.querySelector('input[data-name="email"]').value.length < 5){
        $formErrors.length ++;
        document.querySelector('[data-error="email"] .alert').style.display = "block";
        document.querySelector('input[data-name="email"]').style.borderColor = "#dc7575";
    }
    if(document.querySelector('textarea[data-name="msg"]').value.length < 5){
        $formErrors.length ++;
        document.querySelector('[data-error="msg"] .alert').style.display = "block";
        document.querySelector('textarea[data-name="msg"]').style.borderColor = "#dc7575";
    }
    if($formErrors.length > 0){
      e.preventDefault();
    }
  }
};
//hide alert
var closeBtn  = document.getElementById('close');
if(closeBtn !== null){
  closeBtn.onclick = function(){
      this.parentElement.style.display = "none";
  };
}
//check For Required Fields
var requiredField =  document.querySelectorAll('*[data-name]');
for(required of requiredField){
  required.onblur = function(){
        var data_name = this.getAttribute('data-name');
        var value_length = this.value.length;
        var $query = "[data-error="+ data_name+"] .alert";
        var error  = document.querySelector($query);
          switch (data_name) {
            case "msg":
                  if(value_length < 10){
                      error.style.display = "block";
                      this.style.borderColor  = "#dc7575";
                      $formErrors.length++;
                  }else{
                    if($formErrors.length > 0){
                        $formErrors.length--;
                      }
                        error.style.display = "none";
                        this.style.borderColor  = "#8fd48f";
                  }
            break;
            case "username":
                    if(value_length < 5){
                        error.style.display = "block";
                        this.style.borderColor  = "#dc7575";
                        $formErrors.length++;
                    }else{
                      if($formErrors.length > 0){
                          $formErrors.length--;
                        }
                          error.style.display = "none";
                          this.style.borderColor  = "#8fd48f";
                    }
            break;
            case "email":
                      if(value_length == 0){
                          error.style.display = "block";
                          this.style.borderColor  = "#dc7575";
                          $formErrors.length++;
                      }else{
                            if($formErrors.length > 0){
                                $formErrors.length--;
                              }
                            error.style.display = "none";
                            this.style.borderColor  = "#8fd48f";
                      }
            break;
            default:
                console.log('Error Occured');
          }
  }
}
