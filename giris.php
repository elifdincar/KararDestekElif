<?php
include("function/fonksiyon.php");

if (!empty($_POST) && isset($_GET['islem']) && $_GET['islem'] == 'giris') {
  $sonuc = yoneticiGiris($_POST);
  if ($sonuc > 0) {
    header("Location: gosterge-paneli.php");
  } else {
    header("Location: giris.php?sonuc=basarisiz");
  }
} elseif(isset($_GET['islem']) && $_GET['islem'] == 'cikis'){
  session_destroy();
  header('Location: giris.php?sonuc=cikildi');
} ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nora Yönetim Paneli - Yönetici Girişi</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
  <link rel="stylesheet" href="assets/css/login-style.css">
</head>

<body>
<div class="main">
  <h1>Nora Yönetim Paneli</h1>
  <h3>Yönetici Girişi</h3>

  <form action="giris.php?islem=giris" method="post">
    <label for="user_email">
      E-posta:
    </label>
    <input type="text" id="user_email" name="user_email"
           placeholder="E-posta adresinizi giriniz" required>

    <label for="password">
      Şifre:
    </label>
    <input type="password" id="user_password" name="user_password"
           placeholder="Şifrenizi giriniz" required>

    <div class="wrap">
      <button type="submit">
        Giriş
      </button>
    </div>
  </form>
</div>
</body>
<?php if(isset($_GET['sonuc']) && $_GET['sonuc']=='basarisiz'){ ?>
  <p class="errorMessage">E-posta veya Şifre yanlış! Lütfen tekrar deneyiniz.</p>
<?php } elseif(isset($_GET['sonuc']) && $_GET['sonuc']=='cikildi'){ ?>
  <p class="errorMessage">Başarılı bir şekilde çıkış yaptınız.</p>
<?php } ?>
</html>