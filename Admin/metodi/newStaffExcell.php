<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $file = $_FILES['file']['tmp_name'];
  $newFile = $_FILES['file']['name'];
  $percorso = "fileTemporanei/" . $newFile;

  $esito = move_uploaded_file($file, $percorso);
  if (!$esito) {
  echo("<script>" .
  "alert(\"Il file non è stato caricato correttamente!!!\n Per favore riprovare!.\");" .
  "</script>");
  header('refresh:1;url=../Staff.php');
  }
  
//header('Content-Type: text/plain');
require('excell/php-excel-reader/excel_reader2.php');
require('excell/SpreadsheetReader.php');


$StartMem = memory_get_usage();
/* echo '---------------------------------'.PHP_EOL;
  echo 'Starting memory: '.$StartMem.PHP_EOL;
  echo '---------------------------------'.PHP_EOL; */

try {
    $Spreadsheet = new SpreadsheetReader($percorso);
    $BaseMem = memory_get_usage();

    $Sheets = $Spreadsheet->Sheets();

    /* echo '---------------------------------'.PHP_EOL;
      echo 'Spreadsheets:'.PHP_EOL;
      print_r($Sheets);
      echo '---------------------------------'.PHP_EOL;
      echo '---------------------------------'.PHP_EOL; */

    foreach ($Sheets as $Index => $Name) {
        /* echo '---------------------------------'.PHP_EOL;
          echo '*** Sheet '.$Name.' ***'.PHP_EOL;
          echo '---------------------------------'.PHP_EOL; */

        $Time = microtime(true);

        $Spreadsheet->ChangeSheet($Index);

        foreach ($Spreadsheet as $Key => $Row) {
            //echo $Key.': '.PHP_EOL;
            if ($Key != 0) {
                foreach ($Row as $valore) {
                    $vettore[] = $valore;
                }
                echo$vettore[0] . PHP_EOL;
                echo$vettore[1] . PHP_EOL;
                echo$vettore[2] . PHP_EOL;
                echo$vettore[3] . PHP_EOL;
                echo$vettore[4] . PHP_EOL;
                echo$vettore[5] . PHP_EOL;
                echo$vettore[6] . PHP_EOL;
                echo$vettore[7] . PHP_EOL;
                echo$vettore[8] . PHP_EOL;
                $codice = generacod($vettore[0], $vettore[1]);
                $Pfoto = PFoto($vettore[6]);
                $data = strtotime($vettore[2]);
                $newformat = date('Y-m-d', $data);
                echo $newformat.PHP_EOL;
                echo $codice . PHP_EOL;
                echo $Pfoto . PHP_EOL;
                echo $data;
                 include '../../connessione.php';
                  try {
                  $sql = "INSERT INTO `staff`(`nome`, `cognome`, `data_nascita`, `email`, `username`, `pass`, `sesso`, `foto`, `cod`, `id_evento`, `id_staff`) VALUES ('$vettore[0]','$vettore[1]','$newformat','$vettore[3]','$vettore[4]','$vettore[5]','$vettore[6]','$Pfoto','$codice',$vettore[8],$vettore[7])";
                  $connessione->exec($sql);
                  } catch (PDOException $e) {
                  echo "error: ".$e->getMessage();
                  }
                  $connessione = null; 
                $vettore = array();
            }
            $CurrentMem = memory_get_usage();

            /* echo 'Memory: '.($CurrentMem - $BaseMem).' current, '.$CurrentMem.' base'.PHP_EOL;
              echo '---------------------------------'.PHP_EOL;

              if ($Key && ($Key % 500 == 0))
              {
              echo '---------------------------------'.PHP_EOL;
              echo 'Time: '.(microtime(true) - $Time);
              echo '---------------------------------'.PHP_EOL;
              } */
        }

        /* echo PHP_EOL.'---------------------------------'.PHP_EOL;
          echo 'Time: '.(microtime(true) - $Time);
          echo PHP_EOL;

          echo '---------------------------------'.PHP_EOL;
          echo '*** End of sheet '.$Name.' ***'.PHP_EOL;
          echo '---------------------------------'.PHP_EOL; */
    }
} catch (Exception $E) {
    echo $E->getMessage();
}

if (unlink($percorso)) {
  echo 'il file è stato cancellato';
}else{
  echo 'il file NON è stato cancellato';
}

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

function PFoto($sesso) {
    $app = strcasecmp($sesso, "maschio");
    if ($app == 0) {
        $foto = "immagini/imgstaff/profiloU.jpg";
    } else {
        $foto = "immagini/imgstaff/profiloD.jpg";
    }
    return $foto;
}
