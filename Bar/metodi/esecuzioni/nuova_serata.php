<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 24/05/2016
 * Time: 22:23
 */
$evento = $_GET['evento'];
$b = 0;
$date = date("Y-m-d");

$data ;
$incasso;
$num;
$Nevento;

include "../../../connessione.php";

try {
    $sql = "INSERT INTO `serata`(`d_ord`, `id_evento`, `chiusura`, `n_ordini`) VALUES ('$date',$evento,0,0)";
    $connessione->exec($sql);
}catch (PDOException $e){
    echo "error: ".$e->getMessage();
}

try{

    foreach ($connessione->query("SELECT * FROM `serata` INNER JOIN evento on serata.id_evento = evento.id_evento WHERE d_ord = '$date'") as $row){
        $data = $row['d_ord'];
        //$incasso = $row['incasso'];
        $num = $row['n_ordini'];
        $Nevento = $row['nome_evento'];
    }
} catch (PDOException $e){
    //echo "error:".$e->getMessage();
    $b = 1;
}
$connessione = null;
echo json_encode(
    array("esito"=>$b,
        "dataS"=>$data,
        "evento"=>$Nevento,
        //"incasso"=>$incasso,
        "numero"=>$num)
);
/*echo "{ ".
        "esito : ".$b.", ".
        "data :".$data.", ".
        "evento : ".$Nevento.", ".
        "incasso : ".$incasso.", ".
        "numero : ".$num.
        "}";
*/
