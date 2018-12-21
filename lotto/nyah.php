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
    if ($_POST) {

        $c_tickets = 0;
        if (isset($_POST['csv'])){
            $array = explode(",", str_replace('\\r\\n',',',trim($_POST['csv'])));
            foreach($array as $val){
                $t = explode(';',$val);
                $newArray[] = array($t[0]=>$t[1]);
                $c_tickets += $t[1];
            }
            $c_person = count($newArray);

        }elseif (!isset($_POST['tickets']) || !isset($_POST['person'])) {
            $tickets = $_POST['tickets'];
            $person = $_POST['person'];
            foreach($tickets as $key=>$val){
                $c_tickets+=is_numeric($val)?$val:0;
            }

            $c_person = count($person);
            $newArray = array();

            foreach($person as $key=>$val){
                $newArray[] = array($val=>$tickets[$key]);
            }
        }else{
            throw new Exception('Error POST');
        }

        echo 'Total Tickes:'.$c_tickets.'<br/>';
        echo 'Participantes Totales: '.$c_person.'<br/>';

        for ($counter = 0; $counter < $c_tickets; $x++) {

            $current = floor(rand(0, count($newArray)));
            //echo $current.'</br>';
            echo str_pad($counter++, 5, "0", STR_PAD_LEFT) . ';' . key($newArray[$current]).'<br/>';

            if($newArray[$current][key($newArray[$current])] > 1){
                $newArray[$current][key($newArray[$current])]--;
            }else {
                unset($newArray[$current]);
            }
        }
    } else {
        throw new Exception('Not Post');
    }
}catch(Exception $e){
    header("Location: index.php?t=".$e->getMessage());
}
