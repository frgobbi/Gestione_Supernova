<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$cod = "";

//Genera codice Badge
function generacod($nome, $cognome) {
    $b = 0;
    while ($b == 0) {
        $Cnome = substr($nome, 0, 1);
        $Cnome = strtoupper($Cnome);
        $Ccognome = substr($cognome, 0, 1);
        $Ccognome = strtoupper($Ccognome);
        $num = rand(0, 9);
        for ($i = 0; $i < 2; $i++) {
            $num = $num . rand(0, 9);
        }

        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 2; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        $str = strtoupper($str);

        $cod = $Cnome . $Ccognome . $num . $str;

        $connessione=null;
        include '../../connessione.php';
        try {
            $sql = "SELECT COUNT(*) AS utenti FROM staff WHERE cod='$cod'";
            foreach ($connessione->query($sql) as $row) {
                if ($row['utenti'] > 0) {
                    $b = 0;
                } else {
                    $b = 1;
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    $connessione = null;

    return($cod);
}

function caricamentoFoto($nome, $cognome, $sesso) {
    if ($_FILES['img']['name'] != "") {

        $nomeF = $_FILES['img']['name'];
        $estensione = $_FILES['img']['type'];

        $app = explode("/", $estensione);
        $ex = $app[1];

        $nomeF = $_FILES['img']['name'];
        //$nomeF =$matricola.".".$estensione;
        $foto = "immagini/imgstaff" . $nome . "_" . $cognome . "." . $ex;
        $tmpNome = $_FILES['img']['tmp_name'];
        move_uploaded_file($tmpNome, "../../" . $foto);
    } else {
        $app = strcasecmp($sesso, "maschio");
        if ($app == 0) {
            $foto = "immagini/imgstaff/profiloU.jpg";
        } else {
            $foto = "immagini/imgstaff/profiloD.jpg";
        }
    }
    return $foto;
}

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$cognome = filter_input(INPUT_POST, "cognome", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$username = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
//$pass = password_hash($pass);

$sesso = filter_input(INPUT_POST, "sesso", FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, "tipo", FILTER_SANITIZE_NUMBER_INT);
$evento = filter_input(INPUT_POST, "Sevento", FILTER_SANITIZE_NUMBER_INT);
$Pfoto = caricamentoFoto($nome, $cognome, $sesso);
$codice = generacod($nome, $cognome);
 /*echo($codice."<br/>");
  echo($nome."<br/>");
  echo($cognome."<br/>");
  echo($email."<br/>");
  echo($username."<br/>");
  echo($pass."<br/>");
  echo($sesso."<br/>");
  echo($tipo."<br/>");
  echo($evento."<br/>");
  echo($Pfoto."<br/>"); */

include '../../connessione.php';
try {
    $sql = $connessione->query("SELECT * FROM staff WHERE username='$username'");
    $count = $sql->rowCount();
    echo($count);
    if ($count != 0) {
        ?>
        <script>
            alert("utente già inserito cambiare username");
        </script>
        <?php
    } 
    else 
    {
        $sql = ("INSERT INTO `supernova`.`staff` (`nome`, `cognome`, `email`, `username`, `password`, `sesso`, `data_iscrizione`, `foto`, `cod`, `id_evento`, `id_staff`) VALUES ('$nome', '$cognome', '$email', '$username', '$pass', '$sesso', NOW(), '$Pfoto', '$codice', '$evento', '$tipo')");
        $connessione->exec($sql);
            ?>
            <script>
                alert("utente non inseito");
            </script>
            <?php
            $connessione = null;
            header('Refresh:1;url=../Staff.php');
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$connessione = null;
?>
<script>
    alert("nuovo utente inserito");
</script>

<?php
$connessione = null;
header('Refresh:0.5;url=../Staff.php');
?>
 


