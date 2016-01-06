<!DOCTYPE html>
<html lang="en">

<!--================================================================================
    Item Name: Materialize - Material Design Admin Template
    Version: 1.0
    Author: GeeksLabs
    Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->


<!-- Mirrored from demo.geekslabs.com/materialize-v1.0/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 May 2015 06:06:17 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Login Page | Materialize - Material Design Admin Template</title>

  <!-- Favicons-->
  <link rel="icon" href="resources/images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="resources/images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>resources/images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="<?php echo base_url(); ?>resources/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo base_url(); ?>resources/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo base_url(); ?>resources/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?php echo base_url(); ?>resources/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo base_url(); ?>resources/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" id="login_form" action="" method="post">
        <div class="row">
          <div class="input-field col s12 center">
            <!-- <img src="resources/images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login"> -->
            <p class="center login-form-text">Quora Clone Admin Panel</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <?php if($this->session->flashdata('success_msg')): ?>
                <?php echo $this->session->flashdata('success_msg'); ?>
                
            <?php endif; ?>
            <?php if($this->session->flashdata('error_msg')): ?>
                <?php echo $this->session->flashdata('error_msg'); ?>
            <?php endif; ?>
            <i class="mdi-social-person-outline prefix"></i>
            <input id="icon" type="text" name="username" AutoCompleteType="Disabled" value="<?php echo $this->input->post('username'); ?>" >
            <label for="username" class="center-align">Username</label>
            <?php echo form_error('username'); ?>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" AutoCompleteType="Disabled" name="password">
            <label for="password">Password</label>
            <?php echo form_error('password'); ?>
          </div>
        </div>
        <div class="row">          
          <!-- <div class="input-field col s12 m12 l12  login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me">Remember me</label>
          </div> -->
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12 Login_button" type="submit">Login</button>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <!-- <p class="margin medium-small"><a href="page-register.html">Register Now!</a></p> -->
          </div>
          <div class="input-field col s6 m6 l6">
              <!-- <p class="margin right-align medium-small"><a href="page-forgot-password.html">Forgot password ?</a></p> -->
          </div>          
        </div>

      </form>
    </div>
  </div>




  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/jquery-1.11.3.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/plugins.js"></script>

</body>


<!-- Mirrored from demo.geekslabs.com/materialize-v1.0/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 May 2015 06:06:20 GMT -->
</html>

