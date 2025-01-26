<?php include_once('function/fonksiyon.php');
girisKontrol();
$tedarikciler = tedarikcileriGetir('Hepsi', " WHERE supplier_status!='waiting'");
$subeler = subeleriGetir();

if(empty($_GET['sid'])){
  $_GET['sid'] = 1;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nora Yönetim Paneli - Gösterge Paneli</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/chart/apexcharts.min.css">
  <link rel="stylesheet" href="assets/css/sass.css?v=<?= filemtime('assets/css/sass.css'); ?>">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime('assets/css/style.css'); ?>">

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
            <img src="assets/img/supplier.svg" alt="" class="icon">
            <p class="count bg-clc"><?= count($tedarikciler); ?></p>
          </a>

          <div class="dropdown-menu">
            <div class="dp-main-menu">
              <?php foreach ($tedarikciler as $tedarikci){ ?>
                <a href="?sid=<?= $tedarikci['supplier_id']; ?>" class="dropdown-item"><?= $tedarikci['supplier_name']; ?></a>
              <?php } ?>

            </div>
          </div>
        </li>

        <li class="nav-item dropdown user-profile-dropdown">
          <a href="" class="nav-link user" id="Notify" data-bs-toggle="dropdown">
            <img src="assets/img/user.svg" alt="" class="icon">
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
                <div class="col-sm-4">
                  <div class="last-month">
                    <h5>Gösterge Paneli</h5>
                    <div class="earn">
                      <h2><?= $_SESSION['user_name'].' '.$_SESSION['user_surname'] ?></h2>
                      <p>Yönetici</p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-8 my-2 ps-0">
                  <div class="classic-tabs">
                    <ul>
                    <?php foreach ($subeler as $sube){ ?>
                      <li class="activity-item mt-3" style="list-style: none; float:left; margin-left: 30px;">
                        <img src="<?= $sube['branch_img_url']; ?>" width="250" height="250" style="border: 2px solid #ae5037; border-radius: 5%;">
                        <p style="margin-left: 5px;">
                          <strong>Şube Adı:</strong> <?= $sube['branch_name']; ?><br>
                          <strong>Adres:</strong> <?= $sube['branch_address']; ?><br>
                          <strong>Telefon:</strong> <?= $sube['branch_phone']; ?><br>
                          <i class="fa-brands fa-instagram fa-lg" style="font-weight: bold;"></i> <?= $sube['branch_instagram']; ?><br>
                        </p>
                      </li>
                    <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="wre-sec">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-6 my-1 bdr-cls">
                    <div class="earn-view">
                      <span class="fa-solid fa-truck earn-icon"></span>

                      <div class="earn-view-text">
                        <p class="name-text">
                          Aktif Tedarikçi Sayısı
                        </p>
                        <h6 class="balance text">
                          <?= aktifTedarikciSayisi(); ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-6 my-1 bdr-cls">
                    <div class="earn-view">
                      <span class="fa-solid fa-truck-arrow-right earn-icon"></span>

                      <div class="earn-view-text">
                        <p class="name-text">
                          Onay Bekleyen Tedarikçi Sayısı
                        </p>
                        <h6 class="balance text">
                          <?= onayBekleyenTedarikciSayisi(); ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-6 my-1 bdr-cls">
                    <div class="earn-view">
                      <span class="fa-solid fa-dolly earn-icon"></span>

                      <div class="earn-view-text">
                        <p class="name-text">
                          Toplam Sipariş Sayısı
                        </p>
                        <h6 class="balance text">
                          <?= toplamTedarikciSiparisSayisi(); ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-6 my-1 bdr-cls">
                    <div class="earn-view">
                      <span class="fa-solid fa-shop earn-icon"></span>

                      <div class="earn-view-text">
                        <p class="name-text">
                          Toplam Şube Sayısı
                        </p>
                        <h6 class="balance text">
                          <?= toplamSubeSayisi(); ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="bg-white top-chart-earn">
              <div id="chart-example1"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="bg-white top-chart-earn">
              <div class="col-lg-4" style="padding: 0px 8px 8px 8px;">
                <select class="form-select" id="secondGraphSelector">
                  <option value="1" selected>Toplam Sipariş</option>
                  <option value="2">Memnuniyet</option>
                  <option value="3">Teslimat Hızı</option>
                  <option value="4">Hepsi</option>
                </select>
              </div>
              <div class="col-lg-12">
                <div id="chart-example2"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="bg-white top-chart-earn">
              <div id="chart-example3"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="bg-white top-chart-earn">
              <div class="col-lg-4" style="padding: 0px 8px 8px 8px;">
                <select class="form-select" id="forthGraphSelector">
                  <option value="5" selected>Temizlik</option>
                  <option value="6">Gıda</option>
                  <option value="7">Sarf Malzemesi</option>
                  <option value="8">Hepsi</option>
                </select>
              </div>
              <div class="col-lg-12">
                <div id="chart-example4"></div>
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
<script src="assets/js/chart/apexcharts.min.js"></script>
<script src="assets/js/main.js?v=<?= filemtime('assets/js/main.js'); ?>"></script>
<script>
  var general_response;
  var birinci_grafik;
  var ikinci_grafik;
  var ucuncu_grafik;
  var dorduncu_grafik;

  function bosGrafikOlustur(){
    var options = {
      chart: {
        height: 350,
        type: 'bar',
      },
      dataLabels: {
        enabled: false
      },
      series: [],
      title: {
        text: 'Toplam Sipariş | Memnuniyet | Teslimat Hızı - Sütun Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
        align: 'center'
      },
      noData: {
        text: 'Yükleniyor...'
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          borderRadius: 5,
          borderRadiusApplication: 'end'
        },
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
      },
      yaxis: {
        title: {
          text: 'Toplam Sayı'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val
          }
        }
      }
    }
    birinci_grafik = new ApexCharts(
      document.querySelector("#chart-example1"),
      options
    );
    birinci_grafik.render();


    var options = {
      series: [],
      noData: {
        text: 'Yükleniyor...'
      },
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      title: {
        text: 'Toplam Sipariş - Çizgi Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
        align: 'center'
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
      }
    };

    ikinci_grafik = new ApexCharts(document.querySelector("#chart-example2"), options);
    ikinci_grafik.render();

    var options = {
      series: [],
      noData: {
        text: 'Yükleniyor...'
      },
      chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Teslimat Hızı | Memnuniyet - Sütun Çizgi Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
        align: 'center'
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
      },
      labels: ['Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
      yaxis: [{
        title: {
          text: 'Teslimat Hızı',
        },

      }, {
        opposite: true,
        title: {
          text: 'Memnuniyet'
        }
      }]
    };

    ucuncu_grafik = new ApexCharts(document.querySelector("#chart-example3"), options);
    ucuncu_grafik.render();

    var options = {
      series: [],
      chart: {
        height: 350,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        categories: ['Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık']
      },
      title: {
        text: 'Temizlik Ürünleri Fiyat Değişimi - Çizgi Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
        align: 'center'
      },
    };

    dorduncu_grafik = new ApexCharts(document.querySelector("#chart-example4"), options);
    dorduncu_grafik.render();

  }

  $(document).ready(function(){
    bosGrafikOlustur();
    var supplier_id = '<?= $_GET["sid"]; ?>';

    $.ajax({
      type: "POST",
      url: "function/ajax/gostergePaneliGrafikVerileriniGetir.php",
      data: {supplier_id},
      dataType : 'json',
      success: function (response) {
        general_response = response;
        general_response[2] = Object.keys(general_response[2]).map(function (key) { return general_response[2][key]; });
        general_response[3] = Object.keys(general_response[3]).map(function (key) { return general_response[3][key]; });
        console.log(general_response);

        birinci_grafik.updateOptions({
          series: response[0]
        });

        ikinci_grafik.updateOptions({
          series: response[1]
        });

        ucuncu_grafik.updateOptions({
          series: response[4]
        });

        dorduncu_grafik.updateOptions({
          series: response[5]
        });

      }
    });
  });

  $(document).on("change", "#secondGraphSelector", function(){
    var secim = $(this).val();
    var secimText = "Toplam Sipariş";

    switch (secim) {
      case "1":
      case "2":
      case "3":
        switch (secim){
          case "1":
            secimText = "Toplam Sipariş";
            break;
          case "2":
            secimText = "Memnuniyet";
            break;
          case "3":
            secimText = "Teslimat Hızı";
            break;
        }
        ikinci_grafik.updateOptions({
          series: general_response[secim],
          title: {
            text: secimText+' - Çizgi Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
            align: 'center'
          }
        });
        break;
      case "4":
        ikinci_grafik.updateOptions({
          series: general_response[0],
          title: {
            text: 'Toplam Sipariş | Memnuniyet | Teslimat Hızı - Çizgi Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
            align: 'center'
          },
        });
        break;
      default:
        ikinci_grafik.updateOptions({
          series: general_response[1]
        });
        break;
    }
  });

  $(document).on("change", "#forthGraphSelector", function(){
    var secim = $(this).val();
    var secimText = "Temizlik ürünleri";

    switch (secim) {
      case "5":
      case "6":
      case "7":
      case "8":
        switch (secim){
          case "5":
            secimText = "Temizlik Ürünleri";
            break;
          case "6":
            secimText = "Gıda Ürünleri";
            break;
          case "7":
            secimText = "Sarf Malzemesi Ürünleri";
            break;
          case "8":
            secimText = "Tüm Kategoriler";
            break;
        }
        dorduncu_grafik.updateOptions({
          series: general_response[secim],
          title: {
            text: secimText+' - Çizgi Grafiği (<?= tedarikciIsminiGetir($_GET["sid"]); ?>)',
            align: 'center'
          }
        });
        break;
      default:
        dorduncu_grafik.updateOptions({
          series: general_response[5]
        });
        break;
    }
  });
</script>

</body>
</html>