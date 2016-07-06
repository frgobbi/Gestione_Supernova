<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 13/06/2016
 * Time: 11:24
 */
session_start();
$evento = $_SESSION['id_evento'];
if(!isset($_POST['numeroSQ']) && !isset($_POST['gironi'])) {
    echo "<script type='text/javascript'>location.href=AssegAssegnaGironi.phphp</script>";
}
    $SqudreGirone = filter_input(INPUT_POST, "numeroSQ", FILTER_SANITIZE_NUMBER_INT);
    $Gironi = isset($_POST['gironi']) ? $_POST['gironi'] : array();
    $numG = count($Gironi);
    $squadre = array();
    $matsorteggio =array();

include "../../connessione.php";
try{
    foreach ($connessione->query("SELECT id_sq, nomeSQ FROM squadra WHERE id_evento = $evento") as $row){
        $squadre[] = array($row['id_sq'], $row['nomeSQ']);
    }
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
//Inizializzo l'array per i gironi
for($i=0;$i<$numG;$i++){
    $vet = array();
    for($j=0;$j<$SqudreGirone;$j++){
        $vet[$j] = -1;
    }
    $matsorteggio[] = $vet;
}
$numSquadre = ($numG*$SqudreGirone)-1;


/*do{
    $var = rand(0, (4-1));
    echo $var."<br>";
} while($var !=0);*/

for($i=0;$i<$numG;$i++){
    for($j=0;$j<$SqudreGirone;$j++){
        do{
            $b= FALSE;
            $var=(array_rand($squadre,1));
            //$var--;
            for($ia=0;$ia<$numG;$ia++){
                for($ja=0;$ja<$SqudreGirone;$ja++){
                    if($var==$matsorteggio[$ia][$ja])
		 				{
                            $b=TRUE;
                        }
					 }
            }
        }
        while($b!=FALSE);
        //echo $var."<br>";
        $matsorteggio[$i][$j]= $var;
	}
}

for($i=0;$i<$numG;$i++){
    $id_girone = $Gironi[$i];
        for($j=0;$j<$SqudreGirone;$j++){
            $indice = $matsorteggio[$i][$j];
            $id_sq = $squadre[$indice][0];
            try{
                $connessione->exec("UPDATE `squadra` SET `id_girone` = '$id_girone' WHERE `squadra`.`id_sq` = $id_sq");
            } catch (PDOException $e){
                echo"error:".$e->getMessage();
            }
        }
}
$connessione = null;
echo "<script type='text/javascript'>location.href=\"../Gironi.php\"</script>";
