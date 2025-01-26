<?php
include("../fonksiyon.php");

$grafikVerileri = array();
if(!empty($_POST['supplier_id']) && $_POST['supplier_id'] > 0){
  $supplier_id = $_POST['supplier_id'];
  //$tedarikciSiparisleri = tedarikciSiparisleriniGetir('Hepsi', " WHERE supplier_id='".$supplier_id."'");

  //========= GRAFİK 1 =========
  //Toplam Sipariş
  $grafikVerileri['grafik1'][0]['name'] = 'Toplam Sipariş';
  $grafikVerileri['grafik1'][0]['data'][0] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-6 month'))."' AND supplier_id='".$supplier_id."'");
  $grafikVerileri['grafik1'][0]['data'][1] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-5 month'))."' AND supplier_id='".$supplier_id."'");
  $grafikVerileri['grafik1'][0]['data'][2] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-4 month'))."' AND supplier_id='".$supplier_id."'");
  $grafikVerileri['grafik1'][0]['data'][3] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-3 month'))."' AND supplier_id='".$supplier_id."'");
  $grafikVerileri['grafik1'][0]['data'][4] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-2 month'))."' AND supplier_id='".$supplier_id."'");
  $grafikVerileri['grafik1'][0]['data'][5] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-1 month'))."' AND supplier_id='".$supplier_id."'");
  //Toplam Sipariş

  //Memnuniyet Hesabı
  $grafikVerileri['grafik1'][1]['name'] = 'Memnuniyet';
  $month = 6;
  for ($i = 1; $i<7; $i++){
    $gecici_dizi = array();
    $memnuniyet_hesabi = 0;
    $gecici_dizi = tedarikciSiparisScoreToplamiGetir(" WHERE MONTH(stock_date)='".date('m', strtotime('-'.$month.' month'))."' AND supplier_id='".$supplier_id."'");
    if($gecici_dizi['toplam_siparis'] > 0){
      $memnuniyet_hesabi = number_format($gecici_dizi['toplam_puan'] / $gecici_dizi['toplam_siparis'],2);
    }
    $grafikVerileri['grafik1'][1]['data'][$i-1] = $memnuniyet_hesabi;
    $month--;
  }
  unset($month);
  //Memnuniyet Hesabı

  //Hız Hesabı
  $grafikVerileri['grafik1'][2]['name'] = 'Teslimat Hızı';
  $month = 6;
  for ($i = 1; $i<7; $i++){
    $gecici_dizi = array();
    $hiz_hesabi = 0;
    $gecici_dizi = tedarikciSiparisTeslimatZamaniToplamiGetir(" WHERE MONTH(stock_date)='".date('m', strtotime('-'.$month.' month'))."' AND supplier_id='".$supplier_id."'");
    if($gecici_dizi['toplam_siparis'] > 0){
      $hiz_hesabi = number_format($gecici_dizi['toplam_gun'] / $gecici_dizi['toplam_siparis'],2);
    }
    $grafikVerileri['grafik1'][2]['data'][$i-1] = $hiz_hesabi;
    $month--;
  }
  unset($month);
  //Hız Hesabı
  //========= GRAFİK 1 =========

  //========= GRAFİK 2 =========
  //Toplam Sipariş
  $grafikVerileri['grafik21'][0]['name'] = 'Toplam Sipariş';
  $grafikVerileri['grafik21'][0]['data'] = $grafikVerileri['grafik1'][0]['data'];
  //Toplam Sipariş

  //Memnuniyet Hesabı
  $grafikVerileri['grafik22'][1]['name'] = 'Memnuniyet';
  $grafikVerileri['grafik22'][1]['data'] = $grafikVerileri['grafik1'][1]['data'];
  //Memnuniyet Hesabı

  //Hız Hesabı
  $grafikVerileri['grafik23'][2]['name'] = 'Teslimat Hızı';
  $grafikVerileri['grafik23'][2]['data'] = $grafikVerileri['grafik1'][2]['data'];
  //Hız Hesabı
  //========= GRAFİK 2 =========


  //========= GRAFİK 3 =========
  //Toplam Sipariş
  $grafikVerileri['grafik3'][0]['name'] = 'Teslimat Hızı';
  $grafikVerileri['grafik3'][0]['type'] = 'column';
  $grafikVerileri['grafik3'][0]['data'] = $grafikVerileri['grafik1'][2]['data'];
  //Toplam Sipariş

  //Memnuniyet Hesabı
  $grafikVerileri['grafik3'][1]['name'] = 'Memnuniyet';
  $grafikVerileri['grafik3'][1]['type'] = 'line';
  $grafikVerileri['grafik3'][1]['data'] = $grafikVerileri['grafik1'][1]['data'];
  //Memnuniyet Hesabı
  //========= GRAFİK 3 =========


  //========= GRAFİK 4 =========
  //Temizlik Kategorisi
  $grafikVerileri['grafik41'][0]['name'] = 'Temizlik Ürünleri';
  $month = 6;
  for ($i = 1; $i<7; $i++){
    $gecici_dizi = array();
    $fiyat_hesabi = 0;
    $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE MONTH(sspo.price_date)='".date('m', strtotime('-'.$month.' month'))."' AND sspo.supplier_id='".$supplier_id."' AND lp.category_id='1' ");
    if($gecici_dizi['toplam_urun'] > 0){
      $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
    }
    $grafikVerileri['grafik41'][0]['data'][$i-1] = $fiyat_hesabi;
    $month--;
  }
  unset($month);
  //Temizlik Kategorisi

  //Gıda Kategorisi
  $grafikVerileri['grafik42'][0]['name'] = 'Gıda Ürünleri';
  $month = 6;
  for ($i = 1; $i<7; $i++){
    $gecici_dizi = array();
    $fiyat_hesabi = 0;
    $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE MONTH(sspo.price_date)='".date('m', strtotime('-'.$month.' month'))."' AND sspo.supplier_id='".$supplier_id."' AND lp.category_id='2'");
    if($gecici_dizi['toplam_urun'] > 0){
      $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
    }
    $grafikVerileri['grafik42'][0]['data'][$i-1] = $fiyat_hesabi;
    $month--;
  }
  unset($month);
  //Gıda Kategorisi

  //Sarf Malzemeleri Kategorisi
  $grafikVerileri['grafik43'][0]['name'] = 'Sarf Malzemesi Ürünleri';
  $month = 6;
  for ($i = 1; $i<7; $i++){
    $gecici_dizi = array();
    $fiyat_hesabi = 0;
    $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE MONTH(sspo.price_date)='".date('m', strtotime('-'.$month.' month'))."' AND sspo.supplier_id='".$supplier_id."' AND lp.category_id='3'");
    if($gecici_dizi['toplam_urun'] > 0){
      $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
    }
    $grafikVerileri['grafik43'][0]['data'][$i-1] = $fiyat_hesabi;
    $month--;
  }
  unset($month);
  //Sarf Malzemeleri Kategorisi

  //Tüm Kategoriler
  $grafikVerileri['grafik44'][0]['name'] = 'Temizlik Ürünleri';
  $grafikVerileri['grafik44'][1]['name'] = 'Gıda Ürünleri';
  $grafikVerileri['grafik44'][2]['name'] = 'Sarf Malzemesi Ürünleri';
  $grafikVerileri['grafik44'][0]['data'] = $grafikVerileri['grafik41'][0]['data'];
  $grafikVerileri['grafik44'][1]['data'] = $grafikVerileri['grafik42'][0]['data'];
  $grafikVerileri['grafik44'][2]['data'] = $grafikVerileri['grafik43'][0]['data'];
  //Tüm Kategoriler
  //========= GRAFİK 4 =========

  $grafikVerileri = array_values($grafikVerileri);
  $input = mb_convert_encoding($grafikVerileri, "UTF-8", "auto");
  echo json_encode($input);
} else{
  echo 'Hata!';
}


