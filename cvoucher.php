<?php
  require_once 'class/class.php';
  $pengguna = new Pengguna();

  if(!$pengguna->IsLogged() || !$pengguna->IsAdmin($_SESSION['username']))
  {
    header('location: index.php');
    exit();
  }

    function gaskeun() {
        return sprintf( '%04x-%04x-%04x-%04x-%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );

    }

  if(isset($_POST['cvoucher']))
  {


    if(empty($_POST['rvoc']))
     echo "<script>alert('Result voc tidak boleh kosong!');</script><script>window.history.back()</script>";
    else if(empty($_POST['jvoc']))
     echo "<script>alert('Jumlah nominal voc tidak boleh kosong!');</script><script>window.history.back()</script>";
    else if($_POST['jvoc']<= 0)
     echo "<script>alert('Balance voucher tidak boleh  kurang dari sama dengan 0');</script><script>window.history.back()</script>";
    else
    {
      $rvoc = $_POST['rvoc'];
      $jvoc = $_POST['jvoc'];

      $pengguna->BuatVoucher($rvoc, $jvoc);
    }

  }

  if(isset($_GET['del'])) 
  {
    if($pengguna->Hapusvoc($_GET['del']))
    {
        echo "<script>alert('Berhasil menghapus Voucher');</script><script>window.history.back()</script>";
    }
    else
    {
        echo "<script>alert('Gagal menghapus voucher');</script><script>window.history.back()</script>";
    }
  }
  
    $randomvar = strtoupper(gaskeun());
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>UAS GAME</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.php">UAS PBO GAME</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION['username']; ?> </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="setting.php"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Home <span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="reedem.php">Reedem Code</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="setting.php">Setting</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php if($pengguna->IsAdmin($_SESSION['username'])) {?>
                                <li class="nav-item ">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Admin Menu</a>
                                    <div id="submenu-4" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="alluser.php">Lihat semua user</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="cvoucher.php">Buat Voucher</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="loginlog.php">Log login</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Create Voucher</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Admin</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Create Voucher</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Buat Voucher</h5>
                                <div class="card-body">
                                    <form method="POST" id="basicform" data-parsley-validate="">
                                        <div class="form-group">
                                            <label for="rvoc">Result</label>
                                            <input id="rvoc" name="rvoc" type="text"  value="<?php echo $randomvar; ?>" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jvoc">Jumlah saldo voucher</label>
                                            <input id="jvoc" name="jvoc" type="text" placeholder="Jumlah saldo voucher DM" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                </label>
                                            </div>
                                            <div class="form-group m-0">
                                              <button type="submit" name="cvoucher" value="cvoucher" class="btn btn-primary btn-block">
                                                Buat Voucher
                                              </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">List Voucher</h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Key</th>
                                                        <th>status</th>
                                                        <th>Balance</th>
                                                        <th>Dibuat oleh</th>
                                                        <th>Reedem By</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php $i=0; foreach($pengguna->Pilihsemuavoucher() as $data) 
                                                  {  $i++; ?>
                                                  <tr>
                                                    <td><?php echo @$i ?></td>
                                                    <td><?php echo $data['key'];?></td> 
                                                    <td><?php echo $pengguna->statusvoucher($data['status']);?></td>
                                                    <td><?php echo $pengguna->FormatNumber($data['balance']);?></td>
                                                    <td><?php echo $data['dibuatoleh'];?></td>  
                                                    <td><?php echo $data['reedemby'];?></td>
                                                    <td><a class="btn btn-space btn-danger" href="cvoucher.php?del=<?php echo $data['vid'];?>">Delete</a></td>
                                                  </tr>
                                                  <?php } ?>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="/asets/js/uas-project.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
</body>
 
</html>