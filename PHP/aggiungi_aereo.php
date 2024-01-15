<?php
    session_start();
    if(!isset($_SESSION['nome_utente'])){
        header("Location: login.php");
    }
    $nome_utente = $_SESSION['nome_utente'];
    $connessione = new mysqli('localhost', 'root', '', 'progetto');
    $compagnie = $connessione->query("SELECT nome FROM compagnie ORDER BY nome");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aggiungi aereo</title>
    </head>
    <body>
        Aggiungi un aereo<br><br>
        <form action="aggiungi_aereocontroller.php" method="post" enctype="multipart/form-data">
            <input type="text" name="immatricolazione" placeholder="immatricolazione">
            <input list="aerei" name="modello" placeholder="modello">
                <datalist id="aerei">
                    <option value="A220">
                    <option value="A300">
                    <option value="A320">
                    <option value="A330">
                    <option value="A340">
                    <option value="A350">
                    <option value="A380">
                    <option value="BAC Concorde">
                    <option value="Boom Overture">
                    <option value="B707">
                    <option value="B717">
                    <option value="B727">
                    <option value="B737">
                    <option value="B747">
                    <option value="B757">
                    <option value="B767">
                    <option value="B777">
                    <option value="B787">
                    <option value="C130">
                    <option value="C17">
                    <option value="C5">
                    <option value="CRJ200">
                    <option value="CRJ700">
                    <option value="CRJ900">
                    <option value="CRJ1000">
                    <option value="E170">
                    <option value="E175">
                    <option value="E190">
                    <option value="E195">
                    <option value="MD11">
                    <option value="MD80">
                    <option value="MD90">
                    <option value="MD95">
                </datalist>
            <input list="compagnie" name="compagnia" placeholder="compagnia">
                <datalist id="compagnie">
                    <?php
                        while($compagnie_row = $compagnie->fetch_assoc()){
                            echo("<option value='".$compagnie_row['nome']."'>");
                        }
                    ?>
                </datalist>
            <input type="number" name="passeggeri" placeholder="passeggeri">
            <input type="file" name="foto_aereo" placeholder="foto_aereo">
            <input type="file" name="foto_compagnia" placeholder="foto_compagnia">
            <input type="text" name="posizione" placeholder="posizione">
            <input type="text" name="stato" placeholder="stato">
            <input type="number" name="pista_id" placeholder="pista_id">
            <input type="number" name="parcheggio_id" placeholder="parcheggio_id">
            <input type="text" name="aeroporto_icao" placeholder="aeroporto_icao">
            <input type="submit">
        </form>
        <br>
        <a href="index.php">Torna alla home</a>
    </body>
</html>