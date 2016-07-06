<?php

//Genera codice Badge
function generacod($nome, $cognome) {
    $cod = "";
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
        $foto = "ImmaginiApp/Profilo/" . $nome . "_" . $cognome . "." . $ex;
        $tmpNome = $_FILES['img']['tmp_name'];
        move_uploaded_file($tmpNome, "../../" . $foto);
    } else {
            $foto = "ImmaginiApp/Profilo/profiloU.jpg";

    }
    return $foto;
}

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$cognome = filter_input(INPUT_POST, "cognome", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$username = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
$data = filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
$hash_password = password_hash($pass, PASSWORD_BCRYPT);

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
    if ($count != 0) {
        ?>
        <script>
            alert("utente già inserito cambiare username");
            location.href="../Staff.php";
        </script>
        <?php
    } 
    else 
    {
        $sql = ("INSERT INTO `staff` (`nome`, `cognome`, `data_nascita`, `email`, `username`, `pass`, `sesso`, `foto`, `cod`, `id_evento`, `id_staff`) VALUES ('$nome', '$cognome', '$data', '$email', '$username', '$hash_password', '$sesso', '$Pfoto', '$codice', '$evento', '$tipo')");
        $connessione->exec($sql);

    }
} catch (PDOException $e) {
            ?>
            <script>
                alert("utente non inseito");
                location.href="../Staff.php";
            </script>
            <?php
            $connessione = null;
            //header('Refresh:1;url=../Staff.php');
}

$connessione = null;

        include "../../Librerie/Mail/oggettoMail.php";


        $mail->addAddress($email, 'Francesco Gobbi');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('torneosupernova@gmail.com', 'Staff Supernova');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Sei dello Staff';
        $mail->Body    = "<h3>Ciao $nome $cognome, da ora fai parte dello staf del Supernova.</h3><br>
					Per accedere alla piattaforma puoi entrare tramite username e password o tramite badge.<br><br>
					<b>Username:</b>$username<br>
					<b>password:</b>$pass<br>
					<b>codice badge:</b> $codice<br><br><br>
					Saluti staff Supernova.";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients";

        if(!$mail->send()) {
            //echo 'Message could not be sent.';
           //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
        
        $mail = null;
?>

<script>
    alert("nuovo utente inserito");
    location.href="../Staff.php";
</script>

<?php
echo "refreshhhh";
//header('Refresh:1;url=../Staff.php');
$connessione = null;

?>
 


