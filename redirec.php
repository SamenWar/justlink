<?php

require_once('redirec.php');
$key = htmlspecialchars($_GET['key']);
if(empty($_GET['key'])){}
else{
    @$select = mysql_fetch_assoc(mysql_query("SELECT * FROM `short` WHERE `short_key` = '".$key."'"));
    if($select){
        $result = [
            'url' => $select['url'],
            'key' => $select['short_key']
        ];


        header('location: '.$result['url']);

    }
}
?>