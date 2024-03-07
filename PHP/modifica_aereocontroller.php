<?php
    session_start();
    if(!isset($_SESSION['nome_utente'])){
        header("Location: login.php");
    }
    if($_SESSION['ruolo'] == "Amministratore"){
        $nome_utente = $_SESSION['nome_utente'];
        $connessione = new mysqli('localhost', 'root', '', 'progetto');
        if($connessione->connect_errno){
            echo("Connessione fallita: ".$connessione->connect_error.".");
            exit();
        }else{
            $immatricolazione = $_POST['immatricolazione'];
            $immatricolazione = strtoupper($immatricolazione);
            $modello = $_POST['modello'];
            $compagnia = $_POST['compagnia'];
            $posizione = $_POST['posizione'];
            $stato = $_POST['stato'];
            $pista_id = $_POST['pista_id'];
            $parcheggio_id = $_POST['parcheggio_id'];
            $aeroporto_icao = $_POST['aeroporto_icao'];
            $aeroporto_icao = strtoupper($aeroporto_icao);
            if(!is_int($pista_id)){
                $pista_id = NULL;
            }
            if(!is_int($parcheggio_id)){
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
            $connessione->query("UPDATE aerei SET modello = '".$modello."', compagnia = '".$compagnia."', posizione = '".$posizione."', stato = '".$stato."', aeroporto_icao = '".$aeroporto_icao."' WHERE immatricolazione = '".$immatricolazione."'");
            if($pista_id != NULL){
                $connessione->query("UPDATE aerei SET pista_id = '".$pista_id."' WHERE immatricolazione = '".$immatricolazione."'");
            }
            if($parcheggio_id != NULL){
                $connessione->query("UPDATE aerei SET parcheggio_id = '".$parcheggio_id."' WHERE immatricolazione = '".$immatricolazione."'");
            }
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }
?>