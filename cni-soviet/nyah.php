<?php
/**
 *  OhMyLottery
 *
 * Created by PhpStorm.
 * User: kcala
 * Date: 16/02/2018
 * Time: 21:48
 */
try {
    if ($_POST or 1==1) {
        $json = '{';
        $first = 0;
        foreach(explode("\r\n", $_POST['csv']) as $every){
            $line = explode(";", $every);
            $lain = $first ? ',' : '';
            $lain .= '"'.str_replace('http://rivalregions.com/#slide/profile/','',$line[0]).'":{';
            $lain .= '"name":"-",';
            $lain .= '"reason":"'.$line[2].'",';
            $lain .= '"initial_country":"'.$line[1].'",';
            $lain .= '"level":'.$line[3];
            $lain .= '}';
            $json .= $lain;
            $first++;
        }
        $json .= '}';
        echo $json;
    } else {
        throw new Exception('Not Post');
    }
}catch(Exception $e){
    header("Location: index.php?t=".$e->getMessage());
}