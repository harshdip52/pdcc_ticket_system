<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
<link rel="stylesheet" href="<?= base_url();?>style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="screen-1">
  <svg class="logo" >
  </svg>
  <div class="logo" style="text-align:center;">
                  <a href="index" class="navbar-brand"><img src="<?=base_url();?>/assets/img/logo/logo_pdcc.jpg"></a>
                
              </div>
			  <br>
  <div class="email">
  
    <label for="email">Email Address</label>
    <div class="sec-2">
      <ion-icon name="mail-outline"></ion-icon>
      <input type="email" name="email" placeholder="Username@gmail.com"/>
    </div>
  </div>
  <div class="password">
    <label for="password">Password</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      <input class="pas" type="password" name="password" placeholder="············"/>
      <ion-icon class="show-hide" name="eye-outline"></ion-icon>
    </div>
  </div>
  <a href="<?=base_url();?>admin/index">
  <button class="login">Login </button>
  </a>
  <div class="footer"><span> <a href="<?=base_url();?>/dist/AgentLogin.html">Agent Dashboard</a></span><span> <a href="<?=base_url();?>/dist/SupportLogin.html">Support Dashboard</a></span><span> <a href="<?=base_url();?>/dist/VisitorLogin.html">Visitor Dashboard</a></span></div>
  
</div>
<!-- partial -->
  
</body>
</html>