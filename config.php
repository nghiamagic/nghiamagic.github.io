<?php
    session_start();
    $ketnoi['host'] = 'localhost';
    $ketnoi['dbname'] = 'phpmyadmin';
    $ketnoi['username'] = 'root';
    $ketnoi['password'] = '';
    mysql_connect("{$ketnoi['host']}","{$ketnoi['username']}","{$ketnoi['password']}") or die("Không thể kết nối database");
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db( "{$ketnoi['dbname']}") or die("Không thể chọn database");
    if (isset($_SESSION['username']) && $_SESSION['username']){
    $uid = $_SESSION['username'];
    $data = mysql_fetch_array(mysql_query("SELECT * FROM `thanhvien` WHERE `uid` = '".$uid."' LIMIT 1"));
    }
    $home = 'http://'.$_SERVER['HTTP_HOST'].'';// lấy tên miền
    
  function getAmungStats($amung) {
    if(!isset($amung)) return false;

    $url = 'http://whos.amung.us/sitecount/' . $amung . '/';
    $result = '';
    if (function_exists('curl_init')) {
      $http_headers                           = array();
      $http_headers[]                         = 'Expect:';
      $http_headers[]                         = 'Content-Type: text/plain';
      $http_headers[]                         = 'Host: whos.amung.us';
      $opts                                   = array();
      $opts[CURLOPT_URL]                      = $url;
      $opts[CURLOPT_HTTPHEADER]               = $http_headers;
      $opts[CURLOPT_CONNECTTIMEOUT]           = 5;
      $opts[CURLOPT_TIMEOUT]                  = 10;
      $opts[CURLOPT_USERAGENT]                = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17';
      $opts[CURLOPT_HEADER]                   = FALSE;
      $opts[CURLOPT_RETURNTRANSFER]           = TRUE;

      # Initialize PHP/CURL handle
      $ch = curl_init();
      curl_setopt_array($ch, $opts);
      # Create return array
      $result = curl_exec($ch);
      curl_close($ch);
    } elseif (ini_get('allow_url_fopen')) {
      $result = file_get_contents($url);
    }

    return intval($result);
}
?>