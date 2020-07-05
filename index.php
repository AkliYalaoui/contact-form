<?php
    // check if user coming from a request

    if($_SERVER['REQUEST_METHOD'] === 'POST'):

          // assign variables
          $user = $_POST['username'];
          $mail = $_POST['email'];
          $cell = $_POST['mobile'];
          $msg  = $_POST['message'];

          // creating  array that contain all errors
          $formErrors = array();

          if(strlen($user) < 4):
            $formErrors[] = 'username must contain at least 4 characters';
          endif;

          if(strlen($user) > 20):
            $formErrors[] = 'max character of username is 20';
          endif;

          if(strlen($msg) < 10):
            $formErrors[] = 'message must contain at least 10 characters';
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
      <div class="container">
          <h1>Contact Us</h1>
          <div class="errors">
              <?php
                  if(isset($formErrors)):
                      foreach ($formErrors as $error):
                         echo $error . '<br/>';
                      endforeach;
                  endif;
              ?>
         </div>
          <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input type="text" name="username" autocomplete="off" placeholder="Type Your Username">
              <i class="fa fa-user fa-fw"></i>
              <input type="email" name="email"  autocomplete="off" placeholder="Please Type a Valid Email">
              <i class="fas fa-envelope fa-fw"></i>
              <input type="text" name="mobile"  autocomplete="off" placeholder="Type Your Cell phone">
              <i class="fas fa-phone fa-fw"></i>
              <textarea name="message" placeholder="Your Message !"></textarea>
              <input type="submit"  value="Send Message">
              <i class="fas fa-paper-plane fa-fw"></i>
          </form>
      </div>
     <!--  end form -->

     <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  </body>
</html>
