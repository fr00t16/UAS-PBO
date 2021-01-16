<?php


  require_once 'class/class.php';
  $pengguna = new Pengguna();

  if($pengguna->IsLogged())
  {
    header('location: home.php');
    exit();
  }


  if(isset($_POST['login']))
  {

    if(empty($_POST['userlogin']))
      echo "<script>alert('Form login harus di isi!');</script><script>window.history.back()</script>"; 
    else if(empty($_POST['password']))
     echo "<script>alert('Form password harus di isi!');</script><script>window.history.back()</script>"; 
    else
    {
      $userlogin = $_POST['userlogin'];
      $password = $_POST['password'];

      $pengguna->Login($userlogin, $password);
    }

  }
?>

<head>
  <meta charset="utf-8">
  <meta name="author" content="Kodinger">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script type="text/javascript" src="asets/js/jquery.js"></script>
  <script src="/asets/js/uas-project.js"></script>
</head>

<body class="uas-game">
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-md-center h-100">
        <div class="card-wrapper">
          <div class="brand">
            <center><img src="asets/img/logo.png" alt="logo"></center>
          </div>
          <div class="card fat">
            <div class="card-body">
              <h4 class="card-title">Login</h4>
              <form method="POST" class="my-login-validation" novalidate="">
                <div class="form-group">
                  <label for="userlogin">Alamat E-mail atau username</label>
                  <input id="userlogin" type="text" class="form-control" name="userlogin" value="" required autofocus>
                  <div class="invalid-feedback">
                    Form E-mail / username tidakboleh kosong!
                  </div>
                </div>

                <div class="form-group">
                  <label for="password">Password
                  </label>
                  <input id="password" type="password" class="form-control" name="password" required data-eye>
                    <div class="invalid-feedback">
                      Form password tidak boleh kosong!
                    </div>
                </div>

                <div class="form-group m-0">
                  <button type="submit" name="login" value="login" class="btn btn-primary btn-block">
                    Login
                  </button>
                </div>
                <div class="mt-4 text-center">
                  Kamu tidak punya akun? <a href="daftar.php">Daftar disini!</a>
                </div>
              </form>
            </div>
          </div>
          <div class="footer">
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
