<!DOCTYPE html>
<html lang="frs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport-length" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="acceuil.css">
    <!-- <link href="./webfontkit-20230412-114110/stylesheet.css" rel="stylesheet"> -->
    <title>Colis Express</title>
</head>
<body>
    <?php
        require "connect.php";
        $delete = "DELETE FROM colis WHERE idcolis NOT IN (SELECT idcolis FROM envoyer);";
        $conn->exec($delete);
        $req1 = $conn->prepare("SELECT COUNT(codeit) FROM itineraire;");
        $req2 = $conn->prepare("SELECT COUNT(idvoit) FROM voiture;");
        $req3 = $conn->prepare("SELECT COUNT(idenvoi) FROM envoyer;");
        $req4 = $conn->prepare("SELECT COUNT(idrecept) FROM recevoir;");
        $req5 = $conn->prepare("SELECT COUNT(idcolis) FROM colis;");
        $req6 = $conn->prepare("SELECT SUM(frais) FROM envoyer;");

        $req1->execute();       $fech1 = $req1->fetch();        $totalitineraire = $fech1[0];
        $req2->execute();       $fech2 = $req2->fetch();        $totalvoiture = $fech2[0];
        $req3->execute();       $fech3 = $req3->fetch();        $totalenvoi = $fech3[0];
        $req4->execute();       $fech4 = $req4->fetch();        $totalrecoi = $fech4[0];
        $req5->execute();       $fech5 = $req5->fetch();        $totalcolis = $fech5[0];
        $req6->execute();       $fech6 = $req6->fetch();        $recette = $fech6[0];
        
    ?>
    <header>
        <h1>Colis Express</h1>
    </header>

    <!-- <div style="text-align: center; padding-bottom:100px">
        <img src="./img/kisspng-mercedes-benz-sprinter - Copie.png">
        <p style="font-size: 40px;">Colis Express</p> 
    </div> -->

    <div class="menu">
        <div>
            <h2>Itinéraires</h2>
            <div class="img">
                <img src="./img/kisspng-computer-icons.png">
            </div>
            <p> TOTAL<span> <?= $totalitineraire ?> </span> </p> 
            <button onclick="document.location='./Itineraire/afficher.itineraire.php'">Voir plus</button>
        </div>

        <div>
            <h2>Voitures</h2>
            <div class="img">
                <img src="./img/pngegg.png">
            </div>
            <p>TOTAL<span> <?= $totalvoiture ?> </span></p>
            <button onclick="document.location='./Voiture/afficher.voiture.php'">Voir plus</button>
        </div>

        <div>
            <h2>Envoyer</h2>
            <div class="img">
                <img src="./img/colis-livre.png">
            </div>
            <p>TOTAL<span> <?= $totalenvoi ?> </span></p>
            <button onclick="document.location='./Envoyer/formulaire.envoyer.php'">Voir plus</button>
        </div>
    </div>
        
    <div class="menu">
        <div>
            <h2>Recevoir</h2>
            <div class="img">
                <img src="./img/livraison-de-colis">
            </div>
            <p>TOTAL<span> <?= $totalrecoi ?> </span></p>
            <button onclick="document.location='./Recevoir/formulaire.recevoir.php'">Voir plus</button>
        </div>

        <div>
            <h2>Colis</h2>
            <div class="img">
                <img src="./img/suivi-de-commande">
            </div>
            <p>TOTAL<span> <?= $totalcolis ?> </span></p>
            <button onclick="document.location='./Colis/afficher.colis.php'">Voir plus</button>
        </div>  
        
        <div id="recette">
            <h2>Recette</h2>
            <p><span> <?= $recette ?> </span> Ar</p>
            <div class="img">
                <img src="./img/money-management.png">
            </div>
        </div>  
        
    </div>
    <footer>
        <h2>Colis Express</h2>
        <div>Copyright © Tous droits réservés.</div>
    </footer>
</body>

</html>