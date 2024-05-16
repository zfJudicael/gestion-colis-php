<!DOCTYPE html>
<html lang="frs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="recevoir.css">
    <!-- <link href="./webfontkit-20230412-114110/stylesheet.css" rel="stylesheet"> -->
    <title>Colis Express</title>
</head>
<body>
    <header class="col-s-12 col-12">
        <h1>Colis Express</h1>
    </header>

    <div id="modal">
        <div class="modal-content">
            <h2>Modification de reception</h2>
            <form action="">
                <label>Id réception :</label><input type="text" id="idRecept" readonly><br><br>
                <label>Numéro du colis :</label><input type="number" id="idcolisToModify" required><br>
            </form>
            <div class="center">
                <input type="button" value="Confirmer" id="confirmerModif" class="vert"><input type="button" id="close" value="Annuler">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="menu col-s-3 col-2">
            <ul>
                <li onclick="document.location='../index.php'">Acceuil</li>  
                <li onclick="document.location='../Itineraire/afficher.itineraire.php'">Itinéraires</li>
                <li onclick="document.location='../Voiture/afficher.voiture.php'">Voitures</li>
                <li onclick="document.location='../Envoyer/formulaire.envoyer.php'">Envoyer</li>
                <li id="active" onclick="document.location='formulaire.recevoir.php'">Recevoir</li>
                <li onclick="document.location='../Colis/afficher.colis.php'">Colis</li>
            </ul>
        </div>

        <div class="main col-s-7 col-10">
            <div class="titre">
                <h2><?= $titre ?></h2>
            </div>
            
            <?= $content ?>
        </div>

    </div>

    <footer class="col-s-12 col-12">
        <h2>Colis Express</h2>
        <div>Copyright © Tous droits réservés.</div>
    </footer>
</body>
<script src="recevoir.js"></script>
</html>