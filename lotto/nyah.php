<?php
/**
 *  OhMyLottery
 *
 * Created by PhpStorm.
 * User: kcala
 * Date: 16/02/2018
 * Time: 21:48
 */
//$db = array(
//    array("Abradolf" => 3),
//    array("AddNegro" => 80),
//    array("Adrian" => 10),
//    array("Aitor Astorga" => 60),
//    array("Alvarino20" => 10),
//    array("ApioD3stroyer" => 2),
//    array("Cebolla_OldMan" => 20),
//    array("Cipriano Martos" => 400),
//    array("Cristobal Montoro" => 5),
//    array("David Gonzalez Caraballo" => 80),
//    array("Dios dedado de Asgardia" => 200),
//    array("Echenique Rojo" => 40),
//    array("Eliteloir" => 10),
//    array("Ignacion66" => 2),
//    array("Iker" => 10),
//    array("Inigo Zoco" => 60),
//    array("Irony" => 250),
//    array("Katakuri" => 1),
//    array("Lenil" => 10),
//    array("Lord Stalin de Asgardia" => 600),
//    array("Luciano Destroyer" => 20),
//    array("M.Izeta" => 80),
//    array("Magotp" => 250),
//    array("Manema17" => 3),
//    array("Marc Gomez Perez" => 40),
//    array("Nacho Fatule" => 10),
//    array("Nepomu" => 30),
//    array("Penultimo" => 27),
//    array("QuoVadix" => 2),
//    array("Rafnarac" => 6),
//    array("Rick Sanchez" => 20),
//    array("Sambar" => 25),
//    array("San Cid El Pasificador" => 20),
//    array("Sir Stalin" => 10),
//    array("Sr. Luis Vera" => 100),
//    array("Toti Cid" => 5),
//    array("Vincis Pioleteado" => 200),
//    array("???? ?????????" => 60)
//);
#################################################################
#################################################################

try {
    if ($_POST) {
        $c_tickets = 0;
        if (isset($_POST['csv'])){
            $array = explode(",", str_replace(array("\r\n","\r","\n"),',',trim($_POST['csv'])));
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
            $newArray = array_values($newArray);

            $current = round(rand(0, count($newArray) - 1));
            echo $counter++ . ';' . key($newArray[$current]) . $newArray[$current][key($newArray[$current])].'<br/>';

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