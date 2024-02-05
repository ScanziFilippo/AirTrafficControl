<?php
    session_start();
    if(!isset($_SESSION['nome_utente'])){
        header("Location: Controllori/login.php");
    }
    $connessione = new mysqli('localhost', 'root', '', 'progetto');
?>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <h1>Benvenuto
            <a href="Controllori/profilo.php">
                <?php 
                    echo $_SESSION['nome_utente'];
                ?>
            </a>
        </h1>
        <a href="aggiungi_aereo.php"><h2>Aggiungi aereo</h2></a>
        <!--<table>-->
        <?php
            if($connessione->query("SELECT * FROM aerei WHERE aeroporto_icao = '".$_SESSION['aeroporto_icao']."'")->num_rows > 0){
                /*echo("            <b><tr>
                <th>Immatricolazione</th>
                <th>Modello</th>
                <th>Compagnia</th>
                <th>Foto aereo</th>
                <th>Foto compagnia</th>
                <th>Posizione</th>
                <th>Bandiera</th>
            </tr><b>    
            ");*/
            }
        ?>
        <?php
            $aerei = $connessione->query("SELECT * FROM aerei WHERE aeroporto_icao = '".$_SESSION['aeroporto_icao']."' AND stato = 'in volo'");
            echo("<div><h3 style=padding:10px;
            >In aria</h3>");
            while($aerei_row = $aerei->fetch_assoc()){
                /*echo("<tr>");
                echo("<td>".$aerei_row['immatricolazione']."</td>");
                echo("<td>".$aerei_row['modello']."</td>");
                echo("<td>".$aerei_row['compagnia']."</td>");
                echo("<td><img src='../IMG/Aerei/".$aerei_row['modello']."' width='200px'></td>");
                echo("<td><img src='../IMG/Compagnie/".$aerei_row['compagnia']."' width='200px'></td>");
                echo("<td>".$aerei_row['posizione']."</td>");
                //echo("<td>".$aerei_row['stato']."</td>");
                echo("<td><img src='https://flagsapi.com/". strtoupper(substr($aerei_row['immatricolazione'], 0, 2)) . "/flat/64.png'></td>");
                //echo("<td><a href='modifica_aereo.php?immatricolazione=".$aerei_row['immatricolazione']."'>Modifica</a></td>");
                echo("</tr>");*/
                echo("<div style=display:inline-block;padding:10px;> 
                    <div style=display:inline-block;>
                        <img src='../IMG/Aerei/".$aerei_row['modello']."' width='200px'>
                    </div>
                    <div style=display:inline-block;>
                    <p>Immatricolazione: ".$aerei_row['immatricolazione']."</p>
                        <p>Modello: ".$aerei_row['modello']."</p>
                        <p>Compagnia: ".$aerei_row['compagnia']."</p>
                        <p>Posizione: ".$aerei_row['posizione']."</p>
                        <img src='https://flagsapi.com/". strtoupper(substr($aerei_row['immatricolazione'], 0, 2)) . "/flat/64.png' width='32px'><br><br>
                        <a href='modifica_aereo.php?immatricolazione=".$aerei_row['immatricolazione']."'>Modifica</a>
                    </div>
                </div>");
            }
            echo("</div>");
            $aerei = $connessione->query("SELECT * FROM aerei WHERE aeroporto_icao = '".$_SESSION['aeroporto_icao']."' AND stato = 'fermo'");
            echo("<div><h3 style=padding:10px;
            >Fermo</h3>");
            while($aerei_row = $aerei->fetch_assoc()){
                echo("<div style=display:inline-block;padding:10px;> 
                    <div style=display:inline-block;>
                        <img src='../IMG/Aerei/".$aerei_row['modello']."' width='200px'><br>
                    </div>
                    <div style=display:inline-block;>
                    <p>Immatricolazione: ".$aerei_row['immatricolazione']."</p>
                        <p>Modello: ".$aerei_row['modello']."</p>
                        <p>Compagnia: ".$aerei_row['compagnia']."</p>
                        <p>Posizione: Parcheggio ".$aerei_row['parcheggio_id']."</p>
                        <img src='https://flagsapi.com/". strtoupper(substr($aerei_row['immatricolazione'], 0, 2)) . "/flat/64.png' width='32px'><br><br>
                        <a href='modifica_aereo.php?immatricolazione=".$aerei_row['immatricolazione']."'>Modifica</a>
                    </div>
                </div>");
            }
            echo("</div>");
            $aerei = $connessione->query("SELECT * FROM aerei WHERE aeroporto_icao = '".$_SESSION['aeroporto_icao']."' AND stato = 'in attesa'");
            echo("<div><h3 style=padding:10px;
            >In attesa</h3>");
            while($aerei_row = $aerei->fetch_assoc()){
                echo("<div style=display:inline-block;padding:10px;> 
                    <div style=display:inline-block;>
                        <img src='../IMG/Aerei/".$aerei_row['modello']."' width='200px'><br>
                    </div>
                    <div style=display:inline-block;>
                    <p>Immatricolazione: ".$aerei_row['immatricolazione']."</p>
                        <p>Modello: ".$aerei_row['modello']."</p>
                        <p>Compagnia: ".$aerei_row['compagnia']."</p>
                        <p>Posizione: Pista ".$aerei_row['pista_id']."</p>
                        <img src='https://flagsapi.com/". strtoupper(substr($aerei_row['immatricolazione'], 0, 2)) . "/flat/64.png' width='32px'><br><br>
                        <a href='modifica_aereo.php?immatricolazione=".$aerei_row['immatricolazione']."'>Modifica</a>
                    </div>
                </div>");
            }
            echo("</div>");
            $aerei = $connessione->query("SELECT * FROM aerei WHERE aeroporto_icao = '".$_SESSION['aeroporto_icao']."' AND stato = 'decollando'");
            echo("<div><h3 style=padding:10px;
            >Decollando</h3>");
            while($aerei_row = $aerei->fetch_assoc()){
                echo("<div style=display:inline-block;padding:10px;> 
                    <div style=display:inline-block;>
                        <img src='../IMG/Aerei/".$aerei_row['modello']."' width='200px'><br>
                    </div>
                    <div style=display:inline-block;>
                    <p>Immatricolazione: ".$aerei_row['immatricolazione']."</p>
                        <p>Modello: ".$aerei_row['modello']."</p>
                        <p>Compagnia: ".$aerei_row['compagnia']."</p>
                        <p>Posizione: Pista ".$aerei_row['pista_id']."</p>
                        <img src='https://flagsapi.com/". strtoupper(substr($aerei_row['immatricolazione'], 0, 2)) . "/flat/64.png' width='32px'><br><br>
                        <a href='modifica_aereo.php?immatricolazione=".$aerei_row['immatricolazione']."'>Modifica</a>
                    </div>
                </div>");
            }
            echo("</div>");
            $aerei = $connessione->query("SELECT * FROM aerei WHERE aeroporto_icao = '".$_SESSION['aeroporto_icao']."' AND stato = 'atterrando'");
            echo("<div><h3 style=padding:10px;
            >Atterrando</h3>");
            while($aerei_row = $aerei->fetch_assoc()){
                echo("<div style=display:inline-block;padding:10px;> 
                    <div style=display:inline-block;>
                        <img src='../IMG/Aerei/".$aerei_row['modello']."' width='200px'><br>
                    </div>
                    <div style=display:inline-block;>
                    <p>Immatricolazione: ".$aerei_row['immatricolazione']."</p>
                        <p>Modello: ".$aerei_row['modello']."</p>
                        <p>Compagnia: ".$aerei_row['compagnia']."</p>
                        <p>Posizione: Pista ".$aerei_row['pista_id']."</p>
                        <img src='https://flagsapi.com/". strtoupper(substr($aerei_row['immatricolazione'], 0, 2)) . "/flat/64.png' width='32px'><br><br>
                        <a href='modifica_aereo.php?immatricolazione=".$aerei_row['immatricolazione']."'>Modifica</a>
                    </div>
                </div>");
            }
            echo("</div>");
            
            ?>
        <!--</table>-->
    </body>
</html>