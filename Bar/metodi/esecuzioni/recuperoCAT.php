<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 30/05/2016
 * Time: 08:43
 */
include "../../../connessione.php";
$sql = "SELECT * FROM categoria";
$vet = array();
$id=0;
try{
    foreach ($connessione->query($sql) as $row){

        $vet[] = array($row['id_cat'],$row['tipo_cat']);
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

