<?php
require_once('mysql.php');
$link = ['link'=>$_POST['link']];

if(empty($_POST['submit'])){}
if(empty($_POST['link'])){}
else{
    @$select = mysql_fetch_assoc();
    mysql_fetch_assoc(mysql_query("SELECT * FROM 'short' WHERE 'uri'='".$link."'"));
    if($select){
        $result = [
            'url' => $select['url'],
            'key' => $select['short_key'],
            'link'=> 'http:/'.$_SERVER['HTTP_HOST'].'/-'.$select['short_key']
        ];
        print_r($result);
    }
    else {
        /*---- Генерация уникального id  взято и публичного доступа в интернете----*/
        $letters = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        $count = strlen($letters);
        $intval = time();
        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $last = $intval % $count;
            $intval = ($intval - $last) / $count;
            $result .= $letters[$last];
        }
        mysql_query("INSERT INTO `short` (`id`, `url`, `short_key`) VALUES (NULL, '".$link."', '".$result.$intval."') ");
        @$select = mysql_fetch_assoc(mysql_query("SELECT * FROM `short` WHERE `url` = '".$link."'"));
        $result = [
            'url'  => $select['url'],
            'key'  => $select['short_key'],
            'link' => 'http://'.$_SERVER['HTTP_HOST'].'/q/'.$select['short_key']
        ];
    }
}