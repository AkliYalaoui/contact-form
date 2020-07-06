<?php
    // check if user coming from a request

    if($_SERVER['REQUEST_METHOD'] === 'POST'):

          // assign variables
          $user = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
          $mail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
          $cell = filter_var($_POST['mobile'],FILTER_SANITIZE_NUMBER_INT);
          $msg  = filter_var($_POST['message'],FILTER_SANITIZE_STRING);

          // creating  array that contain all errors
          $formErrors = array();

          if(strlen($user) < 4):
            $formErrors[] = '* username must contain at least <strong>4</strong> characters';
          endif;
          if(strlen($mail) == 0):
             $formErrors[] = '*   email cannot be <strong>empty</strong>';
          endif;
          if(strlen($msg) < 10):
            $formErrors[] = '* message must contain at least <strong>10</strong> characters';
          endif;
          // if no error send the Email
          $headers = 'From: '.$mail. '\r\n';
          if(empty($formErrors)):
            // TO SUBJECT MESSAGE HEADERS PARAMERTERS
              mail('akliyalaoui16@gmail.com','Contact Form',$msg,$headers);
              $user = "";
              $mail = "";
              $cell = "";
              $msg  = "";
              $success = "We have recieved your message ";
          endif;
    endif;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="stylesheet">
  </head>
  <body>

     <!--  start form -->
      <div id="app" class="container">
          <h1>Contact Us</h1>
          <?php if(isset($formErrors) && !empty($formErrors)): ?>
              <div class="alert" v-bind:class="[closed]">
                 <button @click="closeAlert">
                      <i class="fas fa-times close"></i>
                 </button>
                 <?php
                          foreach ($formErrors as $error):
                             echo $error . '<br/>';
                          endforeach;
                   ?>
              </div>
           <?php  endif;?>
           <?php if(isset($success)): ?>
                <div class="alert success"><?php echo $success; ?></div>  
           <?php endif; ?>
          <form  v-on:submit="clickable" class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

              <div class="form-group">
                <input @blur="showError('username')"
                       ref = "username"
                       v-bind:class="[borderUser]"
                       type="text"
                       name="username"
                       autocomplete="off"
                       placeholder="Type Your Username"
                       value="<?php if(isset($user)): echo $user; endif;?>">
                <i class="fa fa-user fa-fw"></i>
                <span class="asterix" v-bind:class="[asterixUser]">*</span>
                <div class="alert custom-alert" v-bind:class="[showUser]">
                    username must contain at least <strong>4</strong> characters
                </div>
              </div>

              <div class="form-group">
                <input
                      @blur="showError('email')"
                       ref = "email"
                       v-bind:class="[borderMail]"
                       type="email"
                       name="email"
                       autocomplete="off"
                       placeholder="Please Type a Valid Email"
                       value="<?php if(isset($mail)): echo $mail; endif;?>">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="asterix" v-bind:class="[asterixMail]">*</span>
                <div class="alert custom-alert" v-bind:class="[showMail]">
                  email cannot be <strong>empty</strong>
                </div>
              </div>

              <input
                    type="text"
                    name="mobile"
                    autocomplete="off"
                    placeholder="Type Your Cell phone"
                    value="<?php if(isset($cell)): echo $cell; endif;?>">
              <i class="fas fa-phone fa-fw"></i>

              <div class="form-group">
                  <textarea
                              @blur="showError('msg')"
                              ref = "msg"
                              v-bind:class="[borderMsg]"
                              name="message"
                              placeholder="Your Message !">
                                <?php if(isset($msg)): echo $msg; endif;?>
                              </textarea>
                  <span class="asterix" v-bind:class="[asterixMsg]" >*</span>
                  <div class="alert custom-alert" v-bind:class="[showMsg]">
                     message must contain at least <strong>10</strong> characters
                  </div>
              </div>

              <input   type="submit"
                       value="Send Message">
              <i class="fas fa-paper-plane fa-fw"></i>
          </form>
      </div>
     <!--  end form -->

     <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
     <script src="js/main.js"></script>
  </body>
</html>
