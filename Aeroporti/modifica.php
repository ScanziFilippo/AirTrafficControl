<?php
    session_start();
    if(!isset($_SESSION['nome_utente'])){
        header("Location: ../Controllori/login");
    }
    $nome_utente = $_SESSION['nome_utente'];
    $connessione = new mysqli('localhost', 'root', '', 'progetto');

    $_SESSION['aeroporto_icao'] = $connessione->query("SELECT icao FROM aeroporti WHERE id = '$_SESSION[aeroporto_id]'")->fetch_assoc()['icao'];
    $_SESSION['aeroporto_iata'] = $connessione->query("SELECT iata FROM aeroporti WHERE id = '$_SESSION[aeroporto_id]'")->fetch_assoc()['iata'];
    $_SESSION['aeroporto_nome'] = $connessione->query("SELECT nome FROM aeroporti WHERE id = '$_SESSION[aeroporto_id]'")->fetch_assoc()['nome'];
    $_SESSION['aeroporto_citta'] = $connessione->query("SELECT citta FROM aeroporti WHERE id = '$_SESSION[aeroporto_id]'")->fetch_assoc()['citta'];
    $_SESSION['aeroporto_nazione'] = $connessione->query("SELECT nazione FROM aeroporti WHERE id = '$_SESSION[aeroporto_id]'")->fetch_assoc()['nazione'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifica aeroporto</title>
<link rel="stylesheet" href="../CSS/index.css">    </head>
    <body style="padding-left:20px; padding-top:20px">
        Modifica dell'aeroporto<br><br>
        <form action="modificacontroller" method="post">
            <input type="text" name="icao" placeholder="icao" style="text-transform:uppercase" readonly="readonly" value="<?php echo $_SESSION['aeroporto_icao']; ?>">
            <input type="text" name="iata" placeholder="iata" style="text-transform:uppercase" value="<?php echo $_SESSION['aeroporto_iata']; ?>">
            <input type="text" name="nome" placeholder="nome" value="<?php echo $_SESSION['aeroporto_nome']; ?>">
            <input type="text" name="citta" placeholder="citta" value="<?php echo $_SESSION['aeroporto_citta']; ?>">
            <input type="text" name="nazione" placeholder="nazione" value="<?php echo $_SESSION['aeroporto_nazione']; ?>">
            <input type="submit">
        </form>
        <br>
        <a href="../Controllori/profilo">Torna al profilo</a>
    </body>
    <?php
        if(isset($_GET['err'])){?>
            <p> <?php echo $_GET['err']; ?> </p>
            <?php 
        }
    ?>
</html>