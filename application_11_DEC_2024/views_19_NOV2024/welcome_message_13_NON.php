<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <!-- <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> -->
  <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->
  <!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'> -->

  <link rel="stylesheet" href="<?= base_url(); ?>style.css">
  <link rel="icon" href="<?= base_url(); ?>assets/img/fevicon_pdcc.jpg">
  <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/default/style.min.css" rel="stylesheet">
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

  
</head>

<body>

<div class="screen-1">
    <svg class="logo">
    </svg>
    <div class="logo" style="text-align:center;">
      <a href="index" class="navbar-brand"><img src="<?= base_url(); ?>/assets/img/logo/logo_pdcc.jpg"></a>
    </div>
    <br>
    <form action="<?= base_url(); ?>welcome/index" method="post">
      <div class="container">

        <div class="col-md-12 row">
          <div class="email">
            <label for="email">Email</label>
            <div class="sec-2">
              <ion-icon name="mail-outline"></ion-icon>
              <input type="text" name="username" placeholder="Username@gmail.com" required />
            </div>
          </div>
        </div>
        <Br>
        <div class="col-md-12 row">

          <div class="password">
            <label for="password">Password</label>
            <div class="sec-2">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input class="pas" id="password" type="password" name="password" placeholder="············" required />
              <a>
                <ion-icon id="seePasseord" class="show-hide" name="eye-outline" onclick="pwdTOText()" style="height:15px;width:100px;"></ion-icon>
              </a>
            </div>
          </div>
        </div>
        <Br>
        <div class="col-md-12 row">

          <div class="row">
            <div class="col-md-6 row">
              <div class="pull-right">
                <label for="captcha" id="captchaGeneratedAjax"><?php echo $captcha['image']; ?></label>
              </div>
            </div>
            <div class="col-md-6 row">
              <div class="pull-left">
                <i style="font-size:16px;cursor:pointer;" id="refreshCaptchaBtn" class="fa">&#xf021;</i>
              </div>
            </div>
            <br>
            <br>
          </div>

          <div class="row">
            <input class="form-control" type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if (!empty($userCaptcha)) {
 echo $userCaptcha; } ?>" required />
            <span class="text-danger"><?php echo $this->session->flashdata('captcha_error'); ?></span>
            <span class="text-danger"><?php echo $this->session->flashdata('login_error'); ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <br>
        <input type="submit" value="Login" class="btn btn-md btn-primary" style="cursor:pointer;">
      </div>
    </form>
    <div class="footer"><span> <a href="<?= base_url(); ?>/dist/AgentLogin.html">Agent Dashboard</a></span><span> <a href="<?= base_url(); ?>/dist/SupportLogin.html">Support Dashboard</a></span><span> <a href="<?= base_url(); ?>/dist/VisitorLogin.html">Visitor Dashboard</a></span></div>

  </div>

<!--  <div class="screen-1">
    <svg class="logo">
    </svg>
    <div class="logo" style="text-align:center;">
      <a href="index" class="navbar-brand"><img src="<?= base_url(); ?>/assets/img/logo/logo_pdcc.jpg"></a>
    </div>
    <br>
    <form action="<?= base_url(); ?>welcome/index" method="post">
      <div class="email">
        <label for="email">Email</label>
        <div class="sec-2">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="text" name="username" placeholder="Username@gmail.com" required />
        </div>
      </div>
      <br>
      <div class="password">
        <label for="password">Password</label>
        <div class="sec-2">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input class="pas" id="password" type="password" name="password" placeholder="············" required />
          <a >
            <ion-icon  id="seePasseord" class="show-hide" name="eye-outline" onclick="pwdTOText()" style="height:15px;width:100px;"></ion-icon>
          </a>
        </div>
      </div>
      <br>
      <input type="submit" value="Login" class="login" style="cursor:pointer;">
    </form>
  </div>
   !-->

</body>
<script>
  function pwdTOText() {
    // var div1 = document.getElementById("password");
    // var x = div1.getAttribute("type");
    // alert(x);
    // if (x.type == "password") {
    //   // x.type = "text";
    //   // $("#signupform-password").attr('type', 'text');
    //   document.getElementById('password').type = 'text';
    // } else {
    //   // x.type = "password";
    //   document.getElementById('password').type = 'password';
    // }

    let btn = document.querySelector('#seePasseord');
    let input = document.querySelector('#password');

    btn.addEventListener('click', () => {
      if (input.type === "password") {
        input.type = "text"
      } else {
        input.type = "password"
      }
    })
  }

  $(document).ready(function() {
    $("#refreshCaptchaBtn").on("click", function() {
      $.ajax({
        url: "<?= base_url() ?>Welcome/generateCaptchaAjax",
        type: "get",
        dataType: 'text',
        cache: false,
        success: function(result) {
          if (result) {
            var resultCaptcha = JSON.parse(result);
            $('#captchaGeneratedAjax').html(resultCaptcha.captcha.image);
          } else {
            $("#captcha_error").html("Error While Generating Captcha Please Try Again!");
          }
        }
      });
    });

  });
</script>

</html>