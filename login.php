<?php
  // error_reporting(0);
  include_once('conn_user.php');
  $library = new user ();

  session_start();

  if(isset($_SESSION['is_login'])){
      if($_SESSION['is_login'] == 'login')
      {
        header('location:main/');
      }
  }

  if(isset($_POST['login']))
  {
    $user_nip = htmlentities($_POST['user_nip'], ENT_COMPAT,'ISO-8859-1', true);
    $user_password = htmlentities(md5($_POST['user_password']), ENT_COMPAT,'ISO-8859-1', true);

    if ($user_nip == '' OR $user_password == ''){
      header('location:login.php?message="wrong"');
    }

    else {
      if ($library->login($user_nip, $user_password)){
        header('location:login.php?message=success_login');
      }
      else{
        header('location:login.php?message=wrong');
      }
    }
  }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | DPK-PB Kota Palembang</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="">

      <?php
        if (isset($_GET['message'])){
            if ($_GET['message'] == "wrong"){
            echo "<div class='alert alert-danger' role='alert'>
                    Proses Login Gagal!
                  </div>";
            }
            else if($_GET['message'] == "success_login"){
            echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Login Berhasil! mengalihkan....
                </div>';
            echo '<meta http-equiv="refresh" content="1;url=main/">';
            $_SESSION['is_login'] = 'login';
            }
        }
      ?>

      <img class="mb-4" src="assets/img/damkar.png" alt="" width="72" height="72">

        <div style="margin-bottom: 30px">
          <h1 class="h3 mb-3 font-weight-normal">Login DPK-PB</h1>
        </div>

        <div style="margin-bottom: 20px">
          <label for="user_nip" class="sr-only">Username (NIP)</label>
          <input type="text" class="form-control" placeholder="NIP" name="user_nip" autocomplete="off" onkeypress="return isNumber(event)" maxlength="20" required autofocus>
        </div>

        <div style="margin-bottom: 20px">
          <label for="user_password" class="sr-only">Password</label>
          <input type="password" class="form-control" placeholder="Password.." name="user_password" required>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>

        <p class="mt-4 mb-2 text-muted">
          Dinas Pemadam Kebakaran. dan Penanggulangan Bencana Kota Palembang (DPK-PB) <br> <br> 
          &copy; 2021
        </p>
    </form>
  </body>
</html>