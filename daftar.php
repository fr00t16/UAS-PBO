<?php

  require_once 'class/class.php';
  $pengguna = new Pengguna();

  if($pengguna->IsLogged())
  {
    header('location: home.php');
    exit();
  }

  if(isset($_POST['daftar']))
  {

    if(empty($_POST['name']))
      echo "<script>alert('Form username tidak boleh kosong!');</script><script>window.history.back()</script>";
    else if(empty($_POST['email']))
      echo "<script>alert('Form E-mail tidak boleh kosong!');</script><script>window.history.back()</script>";
    else if(empty($_POST['password']))
     echo "<script>alert('Form password tidak boleh kosong!');</script><script>window.history.back()</script>";
    else if(empty($_POST['repassword']))
     echo "<script>alert('Form repassword tidak boleh kosong!');</script><script>window.history.back()</script>";
    else if(empty($_POST['jeniskelamin']))
     echo "<script>alert('Form jenis kelamin wajib di isi!');</script><script>window.history.back()</script>";
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
     echo "<script>alert('Format email tidak Valid! ');</script><script>window.history.back()</script>";
    else 
    {
      $username = $_POST['name'];
      $email    = $_POST['email'];
      $password = $_POST['password'];
      $repassword = $_POST['repassword'];
      $jeniskelamin = $_POST['jeniskelamin'];

      $pengguna->Daftar($username, $email, $password, $repassword, $jeniskelamin);
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="asets/css/style.css">
  
  <script type="text/javascript" src="asets/js/jquery.js"></script>
  <script src="/asets/js/uas-project.js"></script>
</head>
<body class="uas-game-page">
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-md-center h-100">
        <div class="card-wrapper">
          <div class="brand">
            <center><img src="asets/img/logo.png" alt="logo"></center>
          </div>
          <div class="card fat">
            <div class="card-body">
              <h4 class="card-title">Daftar</h4>
              <form method="POST" class="uas-game-validation" novalidate="">
                <div class="form-group">
                  <label for="name">username</label>
                  <input id="name" type="text" pattern="[A-Za-z0-9_]{0,100}" class="form-control" name="name" required autofocus>
                  <div class="invalid-feedback">
                    Form Tidak boleh kosong atau tidak boleh menggunakan simbol
                  </div>
                </div>

                <div class="form-group">
                  <label for="email">Alamat E-Mail</label>
                  <input id="email" type="email" class="form-control" name="email" required>
                  <div class="invalid-feedback">
                    Alamat E-mail tidak valid!
                  </div>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" type="password" class="form-control" name="password" required data-eye>
                  <div class="invalid-feedback">
                    Form password tidak boleh kosong
                  </div>
                </div>

                <div class="form-group">
                  <label for="password">Re-Type Password</label>
                  <input id="repassword" type="password" class="form-control" name="repassword" required data-eye>
                  <div class="invalid-feedback">
                    Form Re-Password tidak boleh kosong
                  </div>
                </div>

                <div class="form-group">
                  <label for="jeniskelamin">Jenis Kelamin: </label>
                  <input id="jeniskelamin" type="radio" name="jeniskelamin" id="jeniskelaminpria" value="1">Laki - Laki
                  <input id="jeniskelamin" type="radio" name="jeniskelamin" id="jeniskelaminwanita" value="2">Perempuan       
                  <div class="invalid-feedback">
                    Jenis Kelamin wajib di pilih 
                  </div>
                </div>


                <div class="form-group m-0">
                  <button type="submit" name="daftar" value="daftar" class="btn btn-primary btn-block">
                    Daftar
                  </button>
                </div>
                <div class="mt-4 text-center">
                  Kamu sudah punya akun? silahkan login disini <a href="index.php">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>