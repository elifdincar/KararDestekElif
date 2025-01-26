<?php
setlocale(LC_ALL, 'tr_TR');

ob_start();
if (!isset($_SESSION)){
  session_start();
}

defined("SITE_URL") ? null : define("SITE_URL", 'http://norayp.lc/');
error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
  $db= new PDO("mysql:host=localhost;dbname=noradb",'noradbusr',']yFngCkgBg2g[rXm');
  $db->exec("set names utf8");
  //echo 'Veri tabanı bağlantısı başarılı';

} catch (PDOException $e) {
  echo $e->getMessage();
}
?>