<?php
    session_start();
    if(!isset($_SESSION['nome_utente'])){
        header("Location: login.php");
    }
    $nome_utente = $_SESSION['nome_utente'];
    $connessione = new mysqli('localhost', 'root', '', 'progetto');

    if($connessione->connect_errno){
        echo("Connessione fallita: ".$connessione->connect_error.".");
        exit();
    }else{
        try{
            $immatricolazione = $_POST['immatricolazione'];
            $modello = $_POST['modello'];
            $compagnia = $_POST['compagnia'];
            $passeggeri = $_POST['passeggeri'];
            $posizione = $_POST['posizione'];
            $stato = $_POST['stato'];
            $pista_id = $_POST['pista_id'];
            $parcheggio_id = $_POST['parcheggio_id'];
            $aeroporto_icao = $_POST['aeroporto_icao'];
            if($pista_id == ""){
                $pista_id = NULL;
            }
            if($parcheggio_id == ""){
                $parcheggio_id = NULL;
            }
            $target_dir_aerei = "../IMG/Aerei/";
            $target_dir_compagnie = "../IMG/Compagnie/";
            $target_file_aereo = $target_dir_aerei . $modello;
            $target_file_compagnia = $target_dir_compagnie . $compagnia;
            $uploadOk = 1;        
            $imageFileType_aereo = strtolower(pathinfo($target_file_aereo,PATHINFO_EXTENSION));
            $imageFileType_compagnia = strtolower(pathinfo($target_file_compagnia,PATHINFO_EXTENSION));  
            $target_dir_aerei = $target_dir_aerei . $immatricolazione . ".jpeg";
            $target_dir_compagnie = $target_dir_compagnie . $compagnia . ".jpeg";    
            if($_FILES['foto_aereo'] != "" and $_FILES['foto_compagnia'] != ""){
                $check1 = getimagesize($_FILES["foto_aereo"]["tmp_name"]);
                $check2 = getimagesize($_FILES["foto_compagnia"]["tmp_name"]);
                if($check1 !== false and $check2 !== false) {
                $uploadOk = 1;
                } else {
                echo "File is not an image.";
                $uploadOk = 0;
                }
                if ($_FILES["foto_aereo"]["size"] > 10000000 or $_FILES["foto_compagnia"]["size"] > 10000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
            }else{
                $foto_aereo = NULL;
                $foto_compagnia = NULL;
            }
            
              
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            }else {
                if (move_uploaded_file($_FILES["foto_aereo"]["tmp_name"], $target_file_aereo) and move_uploaded_file($_FILES["foto_compagnia"]["tmp_name"], $target_file_compagnia)) {
                  echo "The files have been uploaded.";
                  $foto_aereo = $target_file_aereo;
                  $foto_compagnia = $target_file_compagnia;
                  $connessione->query("INSERT INTO aerei (immatricolazione, modello, compagnia, passeggeri, foto_aereo, foto_compagnia, posizione, stato, pista_id, parcheggio_id, aeroporto_icao) VALUES ('$immatricolazione', '$modello', '$compagnia', '$passeggeri', '$foto_aereo', '$foto_compagnia', '$posizione', '$stato', '$pista_id', '$parcheggio_id', '$aeroporto_icao')");
                  header("Location: index.php");      
                } else {
                  echo "Sorry, there was an error uploading your file.";
                  echo $target_file_aereo;
                }
            }
        }
        catch(Exception $e){
            echo("Errore nella query: ".$e->getMessage());
        }
    }
?>