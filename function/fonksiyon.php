<?php
include_once('baglan.php');

function p($array){
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}
function girisKontrol(){
  if (!empty($_SESSION['user_mail']) && !empty($_SESSION['user_pass'])) {
    global $db;
    $kull_eposta = $_SESSION['user_mail'];
    $kull_sifre = $_SESSION['user_pass'];
    $kullaniciSayisi = 0;

    $kullaniciKontrol = $db->prepare("SELECT * FROM auth_user WHERE user_email=:mail AND user_password=:pass");
    $kullaniciKontrol->execute(array('mail' => $kull_eposta, 'pass' => $kull_sifre));
    $kullaniciSayisi = $kullaniciKontrol->rowCount();
    if ($kullaniciSayisi == 0) {
      header('Location: giris.php');
    } else {
      if ($_SERVER['REQUEST_URI'] == 'giris.php' || $_SERVER['REQUEST_URI'] == 'tedarikci-giris.php') {
        header('Location: gosterge-paneli.php');
      }
    }
  } else {
    header('Location: giris.php');
  }
}
function yoneticiGiris($data){
  global $db;
  $kull_eposta = trim($data['user_email']);
  $kull_sifre = trim($data['user_password']);
  $kullaniciSayisi = 0;

  $kullaniciKontrol = $db->prepare("SELECT * FROM auth_user WHERE user_email=:mail AND user_password=:pass");
  $kullaniciKontrol->execute(array('mail' => $kull_eposta, 'pass' => $kull_sifre));

  $kullaniciSayisi = $kullaniciKontrol->rowCount();

  if ($kullaniciSayisi > 0) {
    $kullaniciVeri = array();
    $kullaniciVeri = $kullaniciKontrol->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_mail'] = $kull_eposta;
    $_SESSION['user_pass'] = $kull_sifre;
    $_SESSION['user_id'] = $kullaniciVeri['user_id'];
    $_SESSION['user_name'] = $kullaniciVeri['user_name'];
    $_SESSION['user_surname'] = $kullaniciVeri['user_surname'];
    $_SESSION['user_type'] = 'admin';
  }

  return $kullaniciSayisi;
}

function tedarikciGetir($tedarikci_id='Hepsi', $filtre=""){
  global $db;
  $tedarikciler = array();

  if ($tedarikci_id == 'Hepsi') {
    $sorgu = "SELECT * from organization_supplier".$filtre;
    $sorgu_dizisi = array();
  } else {
    $sorgu = "SELECT * from organization_supplier WHERE supplier_id=:sid".$filtre;
    $sorgu_dizisi = array('sid' => $tedarikci_id);
  }

  $tedarikciGetir = $db->prepare($sorgu);
  $tedarikciGetir->execute($sorgu_dizisi);
  $tedarikciler = $tedarikciGetir->fetchAll(PDO::FETCH_ASSOC);

  return $tedarikciler;
}

function aktifTedarikciSayisi(){
  global $db;
  $toplam_sayi = 0;
  $tedarikciVerisi = array();

  $sorgu = "SELECT COUNT(*) as toplam_tedarikci FROM organization_supplier WHERE supplier_status!=:sst";
  $tedarikciGetir = $db->prepare($sorgu);
  $tedarikciGetir->execute(array('sst' => 'waiting'));
  $tedarikciVerisi = $tedarikciGetir->fetch(PDO::FETCH_ASSOC);

  if(!empty($tedarikciVerisi)){
    $toplam_sayi = $tedarikciVerisi['toplam_tedarikci'];
  }

  return $toplam_sayi;
}

function onayBekleyenTedarikciSayisi(){
  global $db;
  $toplam_sayi = 0;
  $tedarikciVerisi = array();

  $sorgu = "SELECT COUNT(*) as toplam_tedarikci FROM organization_supplier WHERE supplier_status=:sst";
  $tedarikciGetir = $db->prepare($sorgu);
  $tedarikciGetir->execute(array('sst' => 'waiting'));
  $tedarikciVerisi = $tedarikciGetir->fetch(PDO::FETCH_ASSOC);

  if(!empty($tedarikciVerisi)){
    $toplam_sayi = $tedarikciVerisi['toplam_tedarikci'];
  }

  return $toplam_sayi;
}

function toplamTedarikciSiparisSayisi($filtre=""){
  global $db;
  $sayi = 0;
  $siparisler = array();

  $sorgu = "SELECT COUNT(*) as toplam_siparis FROM sales_stock ".$filtre;
  $siparisGetir = $db->prepare($sorgu);
  $siparisGetir->execute(array());
  $siparisler = $siparisGetir->fetch(PDO::FETCH_ASSOC);

  if(!empty($siparisler)){
    $sayi = $siparisler['toplam_siparis'];
  }

  return $sayi;
}

function toplamSubeSayisi(){
  global $db;
  $sayi = 0;
  $subeler = array();

  $sorgu = "SELECT COUNT(*) as toplam_sube FROM list_branch";
  $subeGetir = $db->prepare($sorgu);
  $subeGetir->execute(array());
  $subeler = $subeGetir->fetch(PDO::FETCH_ASSOC);

  if(!empty($subeler)){
    $sayi = $subeler['toplam_sube'];
  }

  return $sayi;
}

function tedarikcileriGetir($tedarikci_id='Hepsi', $filtre=""){
  global $db;
  $tedarikciler = array();

  if ($tedarikci_id == 'Hepsi') {
    $sorgu = "SELECT * from organization_supplier".$filtre;
    $sorgu_dizisi = array();
  } else {
    $sorgu = "SELECT * from organization_supplier WHERE supplier_id=:sid".$filtre;
    $sorgu_dizisi = array('sid' => $tedarikci_id);
  }

  $tedarikcileriAl = $db->prepare($sorgu);
  $tedarikcileriAl->execute($sorgu_dizisi);
  $tedarikciler = $tedarikcileriAl->fetchAll(PDO::FETCH_ASSOC);

  return $tedarikciler;
}

function tedarikciSiparisleriniGetir($siparis_id='Hepsi', $filtre=""){
  global $db;
  $siparisler = array();

  if ($siparis_id == 'Hepsi') {
    $sorgu = "SELECT * from sales_stock ".$filtre;
    $sorgu_dizisi = array();
  } else {
    $sorgu = "SELECT * from sales_stock WHERE stock_id=:sid ".$filtre;
    $sorgu_dizisi = array('sid' => $siparis_id);
  }

  $siparisleriGetir = $db->prepare($sorgu);
  $siparisleriGetir->execute($sorgu_dizisi);
  $siparisler = $siparisleriGetir->fetchAll(PDO::FETCH_ASSOC);

  return $siparisler;
}

function tedarikciSiparisScoreToplamiGetir($filtre=""){
  global $db;
  $siparisler = array();
  $sonucDizisi = array();
  $toplamPuan = 0;
  $toplamSiparis = 0;

  $sorgu = "SELECT * from sales_stock ".$filtre;
  $sorgu_dizisi = array();

  $siparisleriGetir = $db->prepare($sorgu);
  $siparisleriGetir->execute($sorgu_dizisi);
  $siparisler = $siparisleriGetir->fetchAll(PDO::FETCH_ASSOC);

  foreach ($siparisler as $siparis){
    if($siparis['order_score'] > 0){ //0 puanı olanları hesaba katmıyoruz.
      $toplamPuan += $siparis['order_score'];
      $toplamSiparis++;
    }
  }

  $sonucDizisi['toplam_puan'] = $toplamPuan;
  $sonucDizisi['toplam_siparis'] = $toplamSiparis;

  return $sonucDizisi;
}

function tedarikciSiparisTeslimatZamaniToplamiGetir($filtre=""){
  global $db;
  $siparisler = array();
  $sonucDizisi = array();
  $toplamGun = 0;
  $toplamSiparis = 0;

  $sorgu = "SELECT * from sales_stock ".$filtre;
  $sorgu_dizisi = array();

  $siparisleriGetir = $db->prepare($sorgu);
  $siparisleriGetir->execute($sorgu_dizisi);
  $siparisler = $siparisleriGetir->fetchAll(PDO::FETCH_ASSOC);

  foreach ($siparisler as $siparis){
    if($siparis['delivery_date'] != NULL && $siparis['delivery_date'] != " "){ //Teslim edilmemiş siparişleri hesaba katmıyoruz.
      $teslimatTarihi = strtotime($siparis['delivery_date']);
      $siparisTarihi = strtotime($siparis['stock_date']);
      $gunFarki = $teslimatTarihi - $siparisTarihi;

      $toplamGun += round(abs($gunFarki) / (60 * 60 * 24)); //abs fonksiyonu negatif sayıları pozitife çevirmek için kullanılır. round ise küsüratlı sayıları yuvarlar.
      $toplamSiparis++;
    }
  }

  $sonucDizisi['toplam_gun'] = $toplamGun;
  $sonucDizisi['toplam_siparis'] = $toplamSiparis;

  return $sonucDizisi;
}

function tedarikciIsminiGetir($tedarikci_id){
  global $db;
  $firma_ismi = '';

  $sorgu = "SELECT supplier_name FROM organization_supplier WHERE supplier_id=:sid";
  $tedarikciGetir = $db->prepare($sorgu);
  $tedarikciGetir->execute(array('sid' => $tedarikci_id));
  $tedarikciVT = $tedarikciGetir->fetch(PDO::FETCH_ASSOC);

  if(!empty($tedarikciVT)){
    $firma_ismi = $tedarikciVT['supplier_name'];
  }

  return $firma_ismi;
}

function subeleriGetir($filtre=""){
  global $db;
  $subeler = array();

  $sorgu = "SELECT * from list_branch ".$filtre;
  $sorgu_dizisi = array();

  $subeGetir = $db->prepare($sorgu);
  $subeGetir->execute($sorgu_dizisi);
  $subeler = $subeGetir->fetchAll(PDO::FETCH_ASSOC);

  return $subeler;
}

function tedarikciTeklifleriniGetir($filtre=""){
  global $db;
  $teklifler = array();
  $sonucDizisi = array();
  $toplamFiyat = 0;
  $toplamUrun = 0;

  $sorgu = "SELECT * from sales_supplierpriceoffer sspo INNER JOIN list_product lp ON lp.product_id=sspo.product_id ".$filtre;
  $sorgu_dizisi = array();

  $siparisleriGetir = $db->prepare($sorgu);
  $siparisleriGetir->execute($sorgu_dizisi);
  $teklifler = $siparisleriGetir->fetchAll(PDO::FETCH_ASSOC);

  foreach ($teklifler as $teklif){
    if($teklif['list_price'] > 0){
      $toplamFiyat += $teklif['list_price'];
      $toplamUrun++;
    }
  }

  $sonucDizisi['toplam_fiyat'] = $toplamFiyat;
  $sonucDizisi['toplam_urun'] = $toplamUrun;

  return $sonucDizisi;
}

function tedarikciStokKapasiteGetir($tedarikci_id, $filtre=""){
  global $db;
  $tedarikci = array();
  $toplam_kapasite = 0;

  $sorgu = "SELECT supplier_capacity from organization_supplier WHERE supplier_id=:sid".$filtre;
  $sorgu_dizisi = array('sid' => $tedarikci_id);

  $tedarikciGetir = $db->prepare($sorgu);
  $tedarikciGetir->execute($sorgu_dizisi);
  $tedarikci = $tedarikciGetir->fetch(PDO::FETCH_ASSOC);

  if(!empty($tedarikci)){
    $toplam_kapasite = $tedarikci['supplier_capacity'];
  }

  return $toplam_kapasite;
}