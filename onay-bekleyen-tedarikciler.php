<?php include_once('function/fonksiyon.php');
girisKontrol();
$tedarikciler = array();
$tedarikciler = tedarikciGetir('Hepsi', " WHERE supplier_status='waiting'");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nora Yönetim Paneli - Onay Bekleyen Tedarikçiler</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/sass.css">
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<div class="main-wrapper">
  <!-- NAVBAR -->
  <div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm expand-header">
      <div class="header-left d-flex">
        <div class="logo">
          <img src="assets/img/logo_menu.png" width="100" height="50" alt="Nora Yönetim Paneli">
        </div>
        <a href="#" class="sidebarCollapse" id="toogleSidebar" data-placement="bottom">
          <span class="fa fa-bars"></span>
        </a>
      </div>
      <ul class="navbar-item flex-row ml-auto">
        <li class="nav-item dropdown user-profile-dropdown">
          <a href="" class="nav-link user" id="Notify" data-bs-toggle="dropdown">
            <img src="assets/img/user.svg" alt="" class="icon">
            <p class="count">5</p>
          </a>

          <div class="dropdown-menu">
            <div class="user-profile-section">
              <div class="media mx-auto">
                <img src="assets/img/profile.svg" alt="" class="img-fluid mr-2">
                <div class="media-body">
                  <h5><?= $_SESSION['user_name'].' '.$_SESSION['user_surname']; ?></h5>
                  <p><?= ($_SESSION['user_type'] == 'admin') ? 'Yönetici' : 'Tedarikçi'; ?></p>
                </div>
              </div>
            </div>
            <div class="dp-main-menu">
              <a href="giris.php?islem=cikis" class="dropdown-item"><span class="fa-solid fa-right-from-bracket"></span>Çıkış</a>
            </div>
          </div>
        </li>
      </ul>
    </header>
  </div>
  <!-- NAVBAR -->

  <!-- SIDEBAR -->
  <div class="left-menu">
    <div class="menubar-content">
      <nav class="animated bounceInDown">
        <ul id="sidebar">
          <li>
            <a href="gosterge-paneli.php"><i class="fa-solid fa-home"></i>Gösterge Paneli</a>
          </li>
          <li>
            <a href="aktif-tedarikciler.php"><i class="fa-solid fa-truck-fast"></i>Aktif Tedarikçiler</a>
          </li>
          <li>
            <a href="onay-bekleyen-tedarikciler.php"><i class="fa-solid fa-truck-arrow-right"></i>Onay Bekleyen Tedarikçiler</a>
          </li>
          <li>
            <a href="tedarikci-karsilastirma.php"><i class="fa-solid fa-code-compare"></i>Tedarikçi Karşılaştırma</a>
          </li>
        </ul>
      </nav>
      <div class="row date-leftside">
        <p><?= date('d.m.Y'); ?></p>
      </div>
    </div>
  </div>
  <!-- SIDEBAR -->

  <div class="content-wrapper">
    <section class="dashboard-top-sec">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="bg-white top-chart-earn">
              <div class="row">
                <div class="container-page">
                  <h2>Onay Bekleyen Tedarikçiler</h2>
                  <p>Aşağıda onay bekleyen tedarikçi listesini görebilirsiniz.</p>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Tedarikçi ID</th>
                      <th>Tedarikçi Firma Adı</th>
                      <th>Tedarikçi E-posta</th>
                      <th>Tedarikçi Kodu</th>
                      <th>Tedarikçi Durumu</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($tedarikciler as $tedarikci){ ?>
                      <tr>
                        <td><?= $tedarikci['supplier_id']; ?></td>
                        <td><?= $tedarikci['supplier_name']; ?></td>
                        <td><?= $tedarikci['supplier_email']; ?></td>
                        <td><?= $tedarikci['supplier_code']; ?></td>
                        <td><?php
                          switch ($tedarikci['supplier_status']){
                            case 'enable':
                              echo 'Aktif';
                              break;
                            case 'disable':
                              echo 'Pasif';
                              break;
                            case 'waiting':
                              echo 'Onay Bekliyor';
                              break;
                          }
                          ?></td>
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
    </section>
  </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>