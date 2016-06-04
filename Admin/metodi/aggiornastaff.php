<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if ($_SESSION['login'] == TRUE) {
    
} else {
    header("Location:../../index.php");
}


include '../../connessione.php';
try {
    $sql = "SELECT * FROM staff";
    $id = 1;
    foreach ($connessione->query($sql) as $row) {
        $user = "'" . $row['username'] . "'";
        $key = "funzione" . $id;
        $id_staff = $_GET[$key];
        //echo $id_staff ." ".$key;


        if (!$connessione->query("UPDATE staff SET id_staff = $id_staff WHERE username = $user")) {
            ?>
            <script>
                alert("Errore nell'aggiornamento");
            </script>
            <?php

        }
        $id++;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$connessione = null;

//CANCELLAZIONE RIGA
include '../../connessione.php';
$nomi = filter_input(INPUT_GET, "elimina", FILTER_SANITIZE_STRING);
$parti = explode(",", $nomi);

if (count($parti) > 0) {
    for ($i = 0; $i < count($parti); $i++) {
        try {
            $sql = "SELECT * FROM staff";
            foreach ($connessione->query($sql) as $row) {
                $nome = $parti[$i];
                $var = strcmp($nome, $row['username']);
                if ($var == 0) {
                    if (!$connessione->query("DELETE FROM `staff` WHERE `username` = '$nome'")) {
                        ?>
                        <script>
                            alert("Errore nell'aggiornamento");
                        </script>
                        <?php

                    }
                }
            }
        } catch (PDOException $e) {
            echo 'errore';
            echo "Error: " . $e->getMessage();
        }
    }
}
$connessione = null;
//Tabella
echo("<table class = \"table table-bordered riquadri\" id=\"tabT\"");
echo("<tr>");
echo("<th>id</th>");
echo("<th>nome</th>");
echo("<th>cognome</th>");

include '../../connessione.php';
try {
    foreach ($connessione->query("SELECT * FROM `tipo_staff` WHERE 1") as $row) {
        echo("<th>" . $row['descrizione'] . "</th>");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$connessione = null;
?>
<th>ELIMINA</th>
</tr>
<?php

include '../../connessione.php';
$Tstaff = array();
try {
    foreach ($connessione->query("SELECT * FROM `staff` WHERE 1") as $row) {
        $Tstaff[] = array($row['nome'], $row['cognome'], $row['id_staff'], $row['username']);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$connessione = null;
$id = 1;
for ($i = 0; $i < count($Tstaff); $i++) {
    echo("<tr>");
    echo("<td>$id</td>");
    echo("<td>" . $Tstaff[$i][0] . "</td>");
    echo("<td>" . $Tstaff[$i][1] . "</td>");

    include'../../connessione.php';
    try {
        $sql = "SELECT * FROM `tipo_staff` WHERE 1";
        foreach ($connessione->query($sql) as $row) {
            if ($row['id_staff'] == $Tstaff[$i][2]) {
                echo("<td><input type=\"radio\" name=\"funzione" . $id . "\" value=" . $row['id_staff'] . " checked></td>");
            } else {
                echo("<td><input type=\"radio\" name=\"funzione" . $id . "\" value=" . $row['id_staff'] . "></td>");
            }
        }
        echo("<td><input type=\"checkbox\" name=\"elimina\" value=\"" . $Tstaff[$i][3] . "\"></td>");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $id++;
    echo("</tr>");
}
echo("</table>");

$num = count($Tstaff);
echo("<button id=\"bottone\" type=\"button\" class=\"btn btn-primary bln-lg\" onclick=\"staff($num)\">AGGIORNA</button>");
$connessione = null;
