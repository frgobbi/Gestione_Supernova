<?php
     
 function nomi($tipo){
    $vet = array();
        include "../connessione.php";
                    
        // esecuzione della query per la selezione dei record
        // query argomento del metodo query()
        try{
            foreach ($connessione->query("SELECT * FROM funzioni_staff NATURAL JOIN funzione WHERE id_staff = $tipo") as $row) {
                            
                $vet[] = array($row['id_funzione'],$row['src'],$row['nome_funzione'],$row['icona']); 
            }
        }
        catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
        
        $connessione = null;
                    
    return $vet;
 }

