<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 28/05/2016
 * Time: 02:43
 */
//------------------------------------------------------------------------------
/*
 * Copyright (C) 2016 Francesco
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
//------------------------------------------------------------------------------
/*Inclusione della libreria PHPExcel, necessaria per la gestione di file Excel
 * utilizzando il linguaggio PHP.
 */
include("../../../Librerie/excel/Classes/PHPExcel.php");
/*Inclusione del file di connessione, necessario ad effettuare la connessione
 * con il database.
 */
include("../../../connessione.php");
/*Funzione "file_extensiont()"
 * La funzione riceve come parametro il nome del file ($filename) e ne
 * restituisce l'estensione.
 */
function file_exensiont($filename) {
    $ext = explode(".", $filename);
    return $ext[count($ext)-1];
}
session_start();
/*I controlli seguenti servono a verificare che l'utente abbia effettuato il
 * login al sito e che disponga dei privilegi necessari ad utilizzare
 * le differenti funzioni.
 */
if (!$_SESSION['login'])
{
    header("Location:../../../index.php");
}
else
{
        //----------------------------------------------------------------------
        /*RECUPERO DEL FILE DALLA FORM HTML.
         * Vengono acquisiti i seguenti parametri:
         * $nome_temporaneo_file => Nome temporaneo, presente nell'array
         * associativo "$_FILES[]", utilizzato da PHP per identificare il file.
         * $nome_file = Nome effettivo del file.
         */
        $nome_temporaneo_file=$_FILES['excel_file']['tmp_name'];
        $nome_file=$_FILES['excel_file']['name'];
        /*Caricamento del file al percorso, mediante l'utilizzo della funzione
         * desiderato, mediante l'utilizzo della funzione "move_uploaded_file()".
         */
        $upload_completed=  move_uploaded_file($nome_temporaneo_file, $nome_file);
        //Verifica dell'effettivo successo nell'upload del file.
        if(!$upload_completed)
        {
            /*Nel caso in cui qualcosa sia andato storto verrà visualizzato
             * un messaggio di errore meidante un messaggio di "alert()" di
             * Javascript.
             */
            echo("<script type=\"text/javascript\">"
                . "alert(\"Attenzione, impossibile caricare il file...\")"
                . "</script>");
        }
        //----------------------------------------------------------------------
        else
        {
            //------------------------------------------------------------------
            //GESTIONE DEL FILE EXCEL.
            /*Verifica dell'estensione del file, estensione accettata: xlsx.
             */
            if(strcmp(file_exensiont($nome_file),"xlsx")==0)
            {
                //Creazione dell'oggetto necessario alla gestione dei file Excel.
                $reader = PHPExcel_IOFactory::createReader('Excel2007');
                //Il file viene aperto in sola lettura.
                $reader->setReadDataOnly(true);
                //Creazione dell'oggetto rappresentante il file Excel.
                $objPHPExcel = $reader->load($nome_file);
                /*Una volta che il file è stato caricato può essere eliminato,
                 * mediante l'utilizzo della funzione "unlink()".
                 */
                unlink($nome_file);
                //Creazione dell'oggetto contenente il foglio di lavoro attuale.
                $objWorksheet = $objPHPExcel->getActiveSheet();
                //Ottenimento del numero di righe.
                $highestRow = $objWorksheet->getHighestRow();
                //Ottengo il numero di colonne.
                $highestColumn = $objWorksheet->getHighestColumn();
                //??.
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                //--------------------------------------------------------------
                /*CICLO DI LETTURA DEL FILE EXCEL.
                 *
                 */
                for ($row = 2; $row <= $highestRow; ++$row) {
                    /*Il contenuto del file Excel acquisito verrà memorizzato, riga
                     * per riga, all'interno dell'array "$array_record[]".
                     */
                    $array_record=array();
                    /*Caricamento dell'array: il ciclo for seguente consente il
                     * caricamento di tutti i valori presenti all'interno della
                     * riga presa in considerazione.
                     */
                    for ($col = 0; $col <= $highestColumnIndex-1; ++$col)
                    {
                        //Ottenimento del valore delle caselle.
                        $array_record[] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    }
                    /*Verifica che tutti i campi interessati siano stati
                     * effettivamente riempiti dall'utente.
                     */
                    if(strcmp($array_record[0],"")!=0 && strcmp($array_record[1],"")!=0 && strcmp($array_record[2],"")!=0 && strcmp($array_record[3],"")!=0)
                    {

                        try
                        {
                            /*Definizione della query necessaria a determinare
                             * a quale categoria fa riferimento il prodotto
                             * esaminato.
                             */
                            $cat = strtoupper($array_record[2]);
                            $query_categoria="SELECT * FROM `categoria` WHERE tipo_cat = '$cat'";
                            /*Esecuzione della query, e ottenimento del numero
                             * di righe restituite: il controllo serve per
                             * determinare se sia o meno necessario
                             * l'inserimento di una nuova categoria di
                             * prodotti.
                             */
                            $num_righe=$connessione->query($query_categoria)->rowCount();
                            /*Definizione delle procedure da eseguire nel
                             * caso in cui il prodotto appartenga ad una
                             * categoria non ancora inserita.
                             */
                            if($num_righe==0)
                            {
                                /*Definizione della query di inserimento di
                                 * una nuova cateogoria di prodotti.
                                 */
                                $insert_new_category="INSERT INTO `categoria`(`id_cat`, `tipo_cat`, `colore`) VALUES (NULL,'$cat','default')";
                                //Esecuzione della query.
                                $connessione->query($insert_new_category);
                                //$query_categoria="SELECT Id_CAT FROM cat_prodotto WHERE cat_prodotto.descrizione='$array_record[3]'";
                                /*Ottenimento dell'id della nuova categoria
                                 * inserita.
                                 */
                                foreach($connessione->query($query_categoria) as $row_cat)
                                {
                                    $id_cat=$row_cat['id_cat'];
                                    break;
                                }

                            }
                            else
                            {
                                /*Nel caso in cui la categoria sia già stata
                                 * definita, verrà direttamente ottenuto
                                 * l'identificativo univoco della categoria
                                 * stessa mediante l'apposita query
                                 * precedentemente definita.
                                 */
                                foreach($connessione->query($query_categoria) as $row_cat)
                                {
                                    $id_cat=$row_cat['id_cat'];
                                    break;
                                }
                            }
                        } catch (PDOException $ex) {
                            echo("Errore: ".$ex->getMessage());
                        }
                            if(strcmp($array_record[3],"NULL")==0){
                                try
                                {
                                    //Definizione della query.
                                    $query="INSERT INTO prodotto(id_prodotto, nome_p, `prezzo`, `id_cat`, `disp`, `vendita`, `button`) VALUES (NULL,'$array_record[0]','$array_record[1]','$id_cat',NULL,'1','1')";
                                    //Esecuzione della query.
                                    $connessione->query($query);
                                } catch (PDOException $ex) {
                                    echo("Errore: ".$ex->getMessage());
                                }
                            } else {
                                try
                                {
                                    //Definizione della query.
                                    $query="INSERT INTO prodotto(id_prodotto, nome_p, `prezzo`, `id_cat`, `disp`, `vendita`, `button`) VALUES (NULL,'$array_record[0]','$array_record[1]','$id_cat','$array_record[3]','1','1')";
                                    //Esecuzione della query.
                                    $connessione->query($query);
                                } catch (PDOException $ex) {
                                    echo("Errore: ".$ex->getMessage());
                                }
                            }

                        }

                    else
                    {
                        /*Nel caso in cui l'utente abbia lasciato alcuni
                         * campi vuoti nel file, lo script restituirà
                         * un messaggio di errore mediante alert di
                         * Javascript.
                         */
                        echo("<script type=\"text/javascript\">"
                            . "alert(\"Attenzione, alcuni campi vuoti...\")"
                            . "</script>");
                    }
                }
            }
            else
            {
                /*Nel caso in cui il file caricato dall'utente non abbia
                 * l'estensione desiderata, esso verrà eliminato e verrà quindi
                 * restituito un messaggio di errore mediante alert di Javascript.
                 */
                unlink($nome_file);
                echo("<script type=\"text/javascript\">"
                    . "alert(\"Attenzione, estensione non corretta...\")"
                    . "</script>");
            }
        }


}

//Reindirizzamento alla pagina di gestione dei prodotti.
echo "<script type='text/javascript'>location.href=\"../../Gprodotto.php\"</script>";
//Distruzione della connessione al database.
$connessione = null;