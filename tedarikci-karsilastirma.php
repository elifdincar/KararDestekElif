<?php include_once('function/fonksiyon.php');
girisKontrol();
$tedarikciler = tedarikciGetir("Hepsi");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nora Yönetim Paneli - Tedarikçi Karşılaştırma</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/chart/apexcharts.min.css">
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
            <div class="bg-white top-chart-earn">
              <select class="form-select selectboxItem" id="firstSupplierSelector">
                <?php foreach ($tedarikciler as $tedarikci){ ?>
                  <option value="<?= $tedarikci['supplier_id']; ?>"><?= $tedarikci['supplier_name']; ?><?= ($tedarikci['supplier_status']=='waiting') ? ' (Onay Bekliyor)' : ''; ?></option>
                <?php } ?>
              </select>

              <select class="form-select selectboxItem" id="secondSupplierSelector">
                <?php foreach ($tedarikciler as $tedarikci){ ?>
                  <option value="<?= $tedarikci['supplier_id']; ?>"><?= $tedarikci['supplier_name']; ?><?= ($tedarikci['supplier_status']=='waiting') ? ' (Onay Bekliyor)' : ''; ?></option>
                <?php } ?>
              </select>

              <div class="btn btn-secondary" id="compareSupplierBtn" data-type="default" style="width: 100%; margin-top:20px;"><i class="fa-solid fa-code-compare"></i> Karşılaştır</div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="bg-white top-chart-earn">
              <div class="filterSelectBoxDiv">
                <select class="form-select filterSelectBox" id="firstGraphSelectBox" disabled>
                  <option value="1" selected>Toplam Sipariş</option>
                  <option value="2">Memnuniyet</option>
                  <option value="3">Teslimat Hızı</option>
                </select>
              </div>
              <div id="firstGraph"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="bg-white top-chart-earn">
              <div class="filterSelectBoxDiv">
                <select class="form-select filterSelectBox" id="secondGraphSelectBox" disabled>
                  <option value="1" selected>Temizlik</option>
                  <option value="2">Gıda</option>
                  <option value="3">Sarf Malzemesi</option>
                </select>
              </div>
              <div id="secondGraph"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="bg-white top-chart-earn">
              <div id="thirdGraph"></div>
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
<script src="assets/js/main.js"></script>
<script>
  var birinci_grafik;
  var ikinci_grafik;
  var ucuncu_grafik;

  function resetSelectBox(){
    $('#firstGraphSelectBox').prop('selectedIndex',0);
    $('#secondGraphSelectBox').prop('selectedIndex',0);
  }

  function activeSelectBox(){
    $('#firstGraphSelectBox').prop('disabled',false);
    $('#secondGraphSelectBox').prop('disabled',false);
  }

  function bosGrafikleriOlustur(){
    var options = {
      series: [],
      chart: {
        height: 350,
        type: 'area'
      },
      title: {
        text: 'Toplam Sipariş Karşılaştırması ',
        align: 'center'
      },
      noData: {
        text: 'Tedarikçileri Seçiniz..'
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
      yaxis: [{
        title: {
          text: 'Toplam Sipariş',
        }
      }]
    };

    birinci_grafik = new ApexCharts(document.querySelector("#firstGraph"), options);
    birinci_grafik.render();


    var options = {
      series: [],
      noData: {
        text: 'Tedarikçileri Seçiniz..'
      },
      title: {
        text: 'Temizlik Malzemesi Fiyat Teklifi Karşılaştırması',
        align: 'center'
      },
      chart: {
        type: 'donut',
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }],
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "₺"
          }
        }
      }
    };

    ikinci_grafik = new ApexCharts(document.querySelector("#secondGraph"), options);
    ikinci_grafik.render();

    var options = {
      series: [],
      noData: {
        text: 'Tedarikçileri Seçiniz..'
      },
      title: {
        text: 'Tedarikçi Firma Stok Kapasitesi Karşılaştırması',
        align: 'center'
      },
      chart: {
        type: 'pie',
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }],
      tooltip: {
        y: {
          formatter: function (val) {
            return "Toplam Kapasite -> "+val+" ürün"
          }
        }
      }
    };

    ucuncu_grafik = new ApexCharts(document.querySelector("#thirdGraph"), options);
    ucuncu_grafik.render();

  }

  $(document).ready(function(){
    bosGrafikleriOlustur();
  });

  $(document).on("click", "#compareSupplierBtn", function(){
    resetSelectBox();
    activeSelectBox();
    var supplier1 = $("#firstSupplierSelector").val();
    var supplier2 = $("#secondSupplierSelector").val();
    var type = $(this).data("type");
    var secim = "0";


    $.ajax({
      type: "POST",
      url: "function/ajax/tedarikciKarsilastirmaGrafikleriGetir.php",
      data: {supplier1, supplier2, secim, type},
      dataType : 'json',
      success: function (response) {
        response[1] = Object.keys(response[1]).map(function (key) { return response[1][key]; });
        response[2] = Object.keys(response[1]).map(function (key) { return response[2][key]; });
        //console.log(response);

        birinci_grafik.updateOptions({
          series: response[0],
          title: {
            text: 'Toplam Sipariş Karşılaştırması'
          }
        });

        ikinci_grafik.updateOptions({
          series: response[1],
          labels: [$("#firstSupplierSelector option:selected").text(), $("#secondSupplierSelector option:selected").text()],
          title: {
            text: 'Temizlik Malzemesi Fiyat Teklifi Karşılaştırması'
          }
        });

        ucuncu_grafik.updateOptions({
          series: response[2],
          labels: [$("#firstSupplierSelector option:selected").text(), $("#secondSupplierSelector option:selected").text()]
        });
      }
    });
  });

  $(document).on("change", "#firstGraphSelectBox", function (){
    var supplier1 = $("#firstSupplierSelector").val();
    var supplier2 = $("#secondSupplierSelector").val();
    var type = "first";
    var secim = $(this).val();

    var leftText = "";
    switch (secim){
      case "1":
        leftText = "Toplam Sipariş";
        break;
      case "2":
        leftText = "Memnuniyet";
        break;
      case "3":
        leftText = "Teslimat Hızı";
        break;
    }

    $.ajax({
      type: "POST",
      url: "function/ajax/tedarikciKarsilastirmaGrafikleriGetir.php",
      data: {supplier1, supplier2, secim, type},
      dataType : 'json',
      success: function (response) {
        //console.log(response);

        birinci_grafik.updateOptions({
          series: response[0],
          yaxis: [{
            title: {
              text: leftText
            }
          }],
          title: {
            text: leftText+' Karşılaştırması'
          }
        });
      }
    });

  });

  $(document).on("change", "#secondGraphSelectBox", function (){
    var supplier1 = $("#firstSupplierSelector").val();
    var supplier2 = $("#secondSupplierSelector").val();
    var type = "second";
    var secim = $(this).val();

    var titleText = "";
    switch (secim){
      case "1":
        titleText = "Temizlik Malzemesi Fiyat Teklifi Karşılaştırması";
        break;
      case "2":
        titleText = "Gıda Malzemesi Fiyat Teklifi Karşılaştırması";
        break;
      case "3":
        titleText = "Sarf Malzemesi Fiyat Teklifi Karşılaştırması";
        break;
    }

    $.ajax({
      type: "POST",
      url: "function/ajax/tedarikciKarsilastirmaGrafikleriGetir.php",
      data: {supplier1, supplier2, secim, type},
      dataType : 'json',
      success: function (response) {
        //console.log(response);

        ikinci_grafik.updateOptions({
          series: response[0],
          labels: [$("#firstSupplierSelector option:selected").text(), $("#secondSupplierSelector option:selected").text()],
          title: {
            text: titleText
          },
        });
      }
    });
  });
</script>
</body>
</html>