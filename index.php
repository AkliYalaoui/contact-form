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

          if(strlen($user) < 5):
            $formErrors[] = '* username must contain at least <strong>5</strong> characters';
          endif;
          if(strlen($mail) == 0):
             $formErrors[] = '*   email cannot be <strong>empty</strong>';
          endif;
          if(strlen($msg) < 10):
            $formErrors[] = '* message must contain at least <strong>10</strong> characters';
          endif;
          // if no error check the recaptcha then send the Email
          if(empty($formErrors)):
             //recaptcha secret key
              $secret = '6Le1Vq4ZAAAAAFsCjeJXxg7ZYnbf8mr1XHYlnLLb';
              //recaptcha response
              $response = $_POST['g-recaptcha-response'];
              // user ip : optional
              $userip = $_SERVER['REMOTE_ADDR'];
              // send the data to google to check weather user is human or a bot
              $url ="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$userip";
              //API REQUEST & API RESPONSE
              $human = file_get_contents($url);
              // decode json
              $human = json_decode($human);
              //check if user is a human
              if($human->success):
                  //sending the email
                  $headers = 'From: '.$mail. '\r\n';
                  //now i'm using php mail function , this will be updated to phpMailer
                  mail('akliyalaoui16@gmail.com', 'Contact form', $msg, $headers);
                  // remove all data from the form after sending the mail
                  $user = "";
                  $mail = "";
                  $cell = "";
                  $msg  = "";
                  $success = "We have recieved your message ";
              else:
                 $errorRec = 'Cannot send the email , please verify the recaptcha';
              endif;

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>

     <!--  start form -->
      <div class="container">
          <h1>Contact Us</h1>
          <?php if(isset($formErrors) && !empty($formErrors)): ?>
              <div class="alert">
                 <button id="close">
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
           <?php if(isset($errorRec)): ?>
                <div class="alert"><?php echo $errorRec; ?></div>
           <?php endif; ?>
          <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

              <div class="form-group">
                  <input  data-name='username' required pattern=".{5,}" title="username must contain at least 5 characters" type="text" name="username" autocomplete="off" placeholder="Type Your Username"
                          value="<?php if(isset($user)): echo $user; endif;?>">
                  <i class="fa fa-user fa-fw"></i>
                  <div data-error="username">
                      <span class="asterix">*</span>
                      <div class="alert custom-alert">
                          username must contain at least <strong>5</strong> characters
                      </div>
                  </div>
              </div>

              <div class="form-group">
                <input data-name='email' required type="email" name="email" autocomplete="off" placeholder="Please Type a Valid Email"
                       value="<?php if(isset($mail)): echo $mail; endif;?>">
                <i class="fas fa-envelope fa-fw"></i>
                <div data-error="email">
                  <span class="asterix">*</span>
                  <div class="alert custom-alert">
                    email cannot be <strong>empty</strong>
                  </div>
                </div>
              </div>

              <input
                    type="text" name="mobile" autocomplete="off" placeholder="Type Your Cell phone"
                    value="<?php if(isset($cell)): echo $cell; endif;?>">
              <i class="fas fa-phone fa-fw"></i>

              <div class="form-group">
                  <textarea   data-name='msg' required name="message" placeholder="Your Message !"><?php if(isset($msg)): echo $msg; endif;?></textarea>
                  <div data-error="msg">
                      <span class="asterix" >*</span>
                      <div class="alert custom-alert">
                         message must contain at least <strong>10</strong> characters
                      </div>
                  </div>
              </div>
               <div class="g-recaptcha" data-sitekey="6Le1Vq4ZAAAAABFtls_Y02zWgYtQbp5YCCGT3cdP"></div>
              <input   type="submit"
                       value="Send Message">
              <i class="fas fa-paper-plane fa-fw"></i>
          </form>
      </div>
     <!--  end form -->
     <script src="js/main.js"></script>
  </body>
</html>
