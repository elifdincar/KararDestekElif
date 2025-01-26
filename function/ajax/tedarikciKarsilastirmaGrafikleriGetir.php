<?php
include("../fonksiyon.php");

$grafikVerileri = array();
if(!empty($_POST['supplier1']) && !empty($_POST['supplier2']) && isset($_POST['secim']) && !empty($_POST['type'])){
  $supplier1 = $_POST['supplier1'];
  $supplier2 = $_POST['supplier2'];
  $secim = $_POST['secim'];
  $type = $_POST['type'];
  //$tedarikciSiparisleri = tedarikciSiparisleriniGetir('Hepsi', " WHERE supplier_id='".$supplier_id."'");

  switch ($secim){
    case "0":
      switch ($type){
        case "default":
          //Toplam Sipariş
          $grafikVerileri['grafik1'][0]['name'] = tedarikciIsminiGetir($supplier1);
          $grafikVerileri['grafik1'][0]['data'][0] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-6 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][1] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-5 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][2] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-4 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][3] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-3 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][4] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-2 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][5] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-1 month'))."' AND supplier_id='".$supplier1."'");

          $grafikVerileri['grafik1'][1]['name'] = tedarikciIsminiGetir($supplier2);
          $grafikVerileri['grafik1'][1]['data'][0] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-6 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][1] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-5 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][2] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-4 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][3] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-3 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][4] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-2 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][5] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-1 month'))."' AND supplier_id='".$supplier2."'");
          //Toplam Sipariş

          //Temizlik Kategorisi
          $gecici_dizi = array();
          $fiyat_hesabi = 0;
          $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier1."' AND lp.category_id='1' ");
          if($gecici_dizi['toplam_urun'] > 0){
            $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
          }
          $grafikVerileri['grafik2'][0] = floatval($fiyat_hesabi);

          $gecici_dizi = array();
          $fiyat_hesabi = 0;
          $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier2."' AND lp.category_id='1'");
          if($gecici_dizi['toplam_urun'] > 0){
            $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
          }
          $grafikVerileri['grafik2'][1] = floatval($fiyat_hesabi);
          //Temizlik Kategorisi

          //Toplam Stok Kapasitesi
          $grafikVerileri['grafik3'][0] = intval(tedarikciStokKapasiteGetir($supplier1));
          $grafikVerileri['grafik3'][1] = intval(tedarikciStokKapasiteGetir($supplier2));
          //Toplam Stok Kapasitesi
          break;
      }
      break;
    case "1":
      switch ($type){
        case "first": //1.grafik Toplam Sipariş Seçeneği
          $grafikVerileri['grafik1'][0]['name'] = tedarikciIsminiGetir($supplier1);
          $grafikVerileri['grafik1'][0]['data'][0] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-6 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][1] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-5 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][2] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-4 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][3] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-3 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][4] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-2 month'))."' AND supplier_id='".$supplier1."'");
          $grafikVerileri['grafik1'][0]['data'][5] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-1 month'))."' AND supplier_id='".$supplier1."'");

          $grafikVerileri['grafik1'][1]['name'] = tedarikciIsminiGetir($supplier2);
          $grafikVerileri['grafik1'][1]['data'][0] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-6 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][1] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-5 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][2] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-4 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][3] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-3 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][4] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-2 month'))."' AND supplier_id='".$supplier2."'");
          $grafikVerileri['grafik1'][1]['data'][5] = toplamTedarikciSiparisSayisi(" WHERE MONTH(stock_date)='".date('m', strtotime('-1 month'))."' AND supplier_id='".$supplier2."'");
          break;
        case "second": //2.grafik Temizlik Kategorisi
          $gecici_dizi = array();
          $fiyat_hesabi = 0;
          $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier1."' AND lp.category_id='1' ");
          if($gecici_dizi['toplam_urun'] > 0){
            $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
          }
          $grafikVerileri['grafik2'][0] = floatval($fiyat_hesabi);

          $gecici_dizi = array();
          $fiyat_hesabi = 0;
          $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier2."' AND lp.category_id='1'");
          if($gecici_dizi['toplam_urun'] > 0){
            $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
          }
          $grafikVerileri['grafik2'][1] = floatval($fiyat_hesabi);
          break;
      }
      break;
    case "2":
      switch ($type){
        case "first": //1.grafik Memnuniyet Seçeneği
          $grafikVerileri['grafik1'][0]['name'] = tedarikciIsminiGetir($supplier1);
          $month = 6;
          for ($i = 1; $i<7; $i++){
            $gecici_dizi = array();
            $memnuniyet_hesabi = 0;
            $gecici_dizi = tedarikciSiparisScoreToplamiGetir(" WHERE MONTH(stock_date)='".date('m', strtotime('-'.$month.' month'))."' AND supplier_id='".$supplier1."'");
            if($gecici_dizi['toplam_siparis'] > 0){
              $memnuniyet_hesabi = number_format($gecici_dizi['toplam_puan'] / $gecici_dizi['toplam_siparis'],2);
            }
            $grafikVerileri['grafik1'][0]['data'][$i-1] = $memnuniyet_hesabi;
            $month--;
          }
          unset($month);


          $grafikVerileri['grafik1'][1]['name'] = tedarikciIsminiGetir($supplier2);
          $month = 6;
          for ($i = 1; $i<7; $i++){
            $gecici_dizi = array();
            $memnuniyet_hesabi = 0;
            $gecici_dizi = tedarikciSiparisScoreToplamiGetir(" WHERE MONTH(stock_date)='".date('m', strtotime('-'.$month.' month'))."' AND supplier_id='".$supplier2."'");
            if($gecici_dizi['toplam_siparis'] > 0){
              $memnuniyet_hesabi = number_format($gecici_dizi['toplam_puan'] / $gecici_dizi['toplam_siparis'],2);
            }
            $grafikVerileri['grafik1'][1]['data'][$i-1] = $memnuniyet_hesabi;
            $month--;
          }
          unset($month);
          break;
        case "second": //2.grafik Gıda Kategorisi
          $gecici_dizi = array();
          $fiyat_hesabi = 0;
          $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier1."' AND lp.category_id='2' ");
          if($gecici_dizi['toplam_urun'] > 0){
            $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
          }
          $grafikVerileri['grafik2'][0] = floatval($fiyat_hesabi);

          $gecici_dizi = array();
          $fiyat_hesabi = 0;
          $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier2."' AND lp.category_id='2'");
          if($gecici_dizi['toplam_urun'] > 0){
            $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
          }
          $grafikVerileri['grafik2'][1] = floatval($fiyat_hesabi);
          break;
      }
      break;
    case "3":
      switch ($type){
        case "first": //1.grafik Teslimat Hızı Seçeneği
          $grafikVerileri['grafik1'][0]['name'] = tedarikciIsminiGetir($supplier1);
          $month = 6;
          for ($i = 1; $i<7; $i++){
            $gecici_dizi = array();
            $hiz_hesabi = 0;
            $gecici_dizi = tedarikciSiparisTeslimatZamaniToplamiGetir(" WHERE MONTH(stock_date)='".date('m', strtotime('-'.$month.' month'))."' AND supplier_id='".$supplier1."'");
            if($gecici_dizi['toplam_siparis'] > 0){
              $hiz_hesabi = number_format($gecici_dizi['toplam_gun'] / $gecici_dizi['toplam_siparis'],2);
            }
            $grafikVerileri['grafik1'][0]['data'][$i-1] = $hiz_hesabi;
            $month--;
          }
          unset($month);


          $grafikVerileri['grafik1'][1]['name'] = tedarikciIsminiGetir($supplier2);
          $month = 6;
          for ($i = 1; $i<7; $i++){
            $gecici_dizi = array();
            $hiz_hesabi = 0;
            $gecici_dizi = tedarikciSiparisTeslimatZamaniToplamiGetir(" WHERE MONTH(stock_date)='".date('m', strtotime('-'.$month.' month'))."' AND supplier_id='".$supplier2."'");
            if($gecici_dizi['toplam_siparis'] > 0){
              $hiz_hesabi = number_format($gecici_dizi['toplam_gun'] / $gecici_dizi['toplam_siparis'],2);
            }
            $grafikVerileri['grafik1'][1]['data'][$i-1] = $hiz_hesabi;
            $month--;
          }
          unset($month);
          
          break;
          case "second": //2.grafik Sarf Malzemeleri Kategorisi
            $gecici_dizi = array();
            $fiyat_hesabi = 0;
            $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier1."' AND lp.category_id='3' ");
            if($gecici_dizi['toplam_urun'] > 0){
              $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
            }
            $grafikVerileri['grafik2'][0] = floatval($fiyat_hesabi);

            $gecici_dizi = array();
            $fiyat_hesabi = 0;
            $gecici_dizi = tedarikciTeklifleriniGetir(" WHERE sspo.supplier_id='".$supplier2."' AND lp.category_id='3'");
            if($gecici_dizi['toplam_urun'] > 0){
              $fiyat_hesabi = number_format($gecici_dizi['toplam_fiyat'] / $gecici_dizi['toplam_urun'],2);
            }
            $grafikVerileri['grafik2'][1] = floatval($fiyat_hesabi);
          break;
      }
      break;
  }

  $grafikVerileri = array_values($grafikVerileri);
  $input = mb_convert_encoding($grafikVerileri, "UTF-8", "auto");
  echo json_encode($input);
} else{
  echo 'Hata!';
}


