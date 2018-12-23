<?php
/**
 *  OhMyLottery
 *
 * Created by PhpStorm.
 * User: kcala
 * Date: 16/02/2018
 * Time: 21:48
 */

$api = array(
  0=>array('decimos'=>100000),
  1=> array(
    'url'=>'http://api.elpais.com/ws/LoteriaNavidadPremiados',
    'decimos'=>100000,
    'premios'=>array(400000=>4000000,125000=>1250000,50000=> 500000,20000=> 200000,6000=>  60000,2000=>  20000,1250=>  12500,960=>   9600,100=>   1000,20=>    200)
  ),
  2=>array(
    'url'=>'http://api.elpais.com/ws/LoteriaNinoPremiados',
    'decimos'=>100000,
    'premios'=>array()
  )
);

try {
    if ($_POST) {
      if(isset($_POST['sorteo']) && isset($_POST['csv'])){
        $sorteo = $_POST['sorteo'];
        $prize =  str_replace('"','',str_replace(" ","",$_POST['csv']));
        $tmp = explode(",", trim($prize));
        $list = array();
        $q = 0;

        // Convertir csv a array USER[decimos][]
        for($i = 0; $i < $api[$sorteo]['decimos'] ;$i++){
          $tempLin = explode(':', $tmp[$i]);
          if($tempLin[1] != ''){
            $newArray[$tempLin[1]]['decimos'][] = $tempLin[0];
            $newArray[$tempLin[1]]['premio'] = 0;
            $q++;
          }
        }
        if($sorteo == 0){

          $premiosCSV = explode('#',$_POST['premios']);
          foreach($premiosCSV as $key=>$val){
            $valu = preg_replace('~\D~',"",$val);
            $premiosARR[substr($valu, 0, 5)] = substr($valu, 5);
          }
          foreach($newArray as $user=>$list){
            $decimos = $list['decimos'];
            foreach($decimos as $val){
              $decimoActual = (ltrim($val, 0) == '') ? 0 : ltrim($val, 0);
              $newArray[$user]['premio'] += (isset($premiosARR[$decimoActual])) ? $premiosARR[$decimoActual] : 0;
            }
          }
        }else{
          foreach($newArray as $user=>$list){
            $decimos = $list['decimos'];
            foreach($decimos as $val){
              $value = (ltrim($val, 0) == '') ? 0 : ltrim($val, 0);
              $result = file_get_contents($api[$sorteo]['url'].'?n='.$value);
              $json = json_decode(str_replace('busqueda=','',$result), true);
              if($json['premio'] != 0){
                $newArray[$user]['premio'] += $api[$sorteo]['premios'][$json['premio']];
              }
            }
          }
        }
        foreach($newArray as $user=>$list){
            $echo .= "UPDATE alpha_money set money = money + ".$list['premio']." where userid = (SELECT u.userid FROM alpha_users u WHERE u.username = '".$user."')<br/>";
        }
        echo $echo;
      }else{
        throw new Exception('Request not valid');
      }
    } else {
        throw new Exception('Not Post');
    }
}catch(Exception $e){
    header("Location: index.php?t=".$e->getMessage());
}
