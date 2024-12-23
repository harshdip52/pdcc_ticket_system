<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <!-- <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'> -->
 <link rel="stylesheet" href="<?= base_url(); ?>style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="screen-1">
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
      <!-- <a href="<?= base_url(); ?>admin/index">
  <button class="login">Login </button>
  </a> -->
      <br>
      <input type="submit" value="Login" class="login" style="cursor:pointer;">
    </form>
    <div class="footer">
	<span> <a href="#">Agent Dashboard</a></span>
	<span> <a href="#">Support Dashboard</a></span>
	<span> <a href="#">Visitor Dashboard</a></span>
    </div>

  </div>
  <!-- partial -->

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
</script>

</html>