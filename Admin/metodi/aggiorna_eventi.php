<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
                if($_SESSION['login']==TRUE){
                }
                else
                {
                 header("Location:../../index.php" );
                }


include '../../connessione.php';
try {
    $sql = "SELECT * FROM staff";
    $id = 1;
    foreach ($connessione->query($sql) as $row) {
        $user = "'".$row['username']."'";
        $key = "evento" . $id;
        $id_evento = $_GET[$key];
        

        if (!$connessione->query("UPDATE staff SET id_evento = $id_evento WHERE username = $user")){
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

echo("<table class = \"table table-bordered\" id=\"tabS\">");
    echo("<tr>");
        echo("<th>id</th>");
        echo("<th>nome</th>");
        echo("<th>cognome</th>");
            include '../../connessione.php';
                try {
                    foreach ($connessione->query("SELECT * FROM `evento` WHERE 1") as $row) {
                    echo("<th>" . $row['nome_evento'] . "</th>");
                    }
                }catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            $connessione = null;
    echo("</tr>");
        include '../../connessione.php';
            $staff = array();
            try {
                foreach ($connessione->query("SELECT * FROM `staff` WHERE 1") as $row) {
                    $staff[] = array($row['nome'], $row['cognome'], $row['id_evento']);
                }
            } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        $connessione = null;
        
        $id = 1;
        for($i = 0; $i < count($staff); $i++) {
            echo("<tr>");
            echo("<td>$id</td>");
            echo("<td>" . $staff[$i][0] . "</td>");
            echo("<td>" . $staff[$i][1] . "</td>");

            include'../../connessione.php';
                try {
                    $sql = "SELECT * FROM `evento` WHERE 1";
                    foreach ($connessione->query($sql) as $row) {
                        if ($row['id_evento'] == $staff[$i][2]) {
                            echo("<td><input type=\"radio\" name=\"evento" . $id . "\" value=" . $row['id_evento'] . " checked></td>");
                        } else {
                            echo("<td><input type=\"radio\" name=\"evento" . $id . "\" value=" . $row['id_evento'] . "></td>");
                        }
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            $connessione = null;

            $id++;
            echo("</tr>");
        }
    echo("</table>");
    $num = count($staff);
    echo("<button type=\"button\" class=\"btn btn-primary bln-lg\" onclick=\"aggiorna($num)\">AGGIORNA</button>");

