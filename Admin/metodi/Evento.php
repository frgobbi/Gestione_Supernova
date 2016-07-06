<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 11/06/2016
 * Time: 15:05
 */
include "../../connessione.php";
$sql = "SELECT * FROM `evento`";
$vet = array();
$id=0;
try{
    foreach ($connessione->query($sql) as $row){

        $vet[] = array($row['id_evento'],$row['nome_evento']);
        $id++;
    }
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}

$connessione = null;

/*echo json_encode($vet);*/

echo "[";
for($i=0;$i<count($vet);$i++){
    if($i == (count($vet)-1)){
        echo "{";
        echo "\"id\": \"".$vet[$i][0]."\",";
        echo "\"nome\": \"".$vet[$i][1]."\"";
        echo "}";
    } else{
        echo "{";
        echo "\"id\": \"".$vet[$i][0]."\",";
        echo "\"nome\": \"".$vet[$i][1]."\"";
        echo "},";
    }
}
echo "]";