<!DOCTYPE html>
<html lang="frs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="envoyer.css">
    <!-- <link href="./webfontkit-20230412-114110/stylesheet.css" rel="stylesheet"> -->
    <title>Colis Express</title>
</head>
<body>
    <header class="col-s-12 col-12">
        <h1>Colis Express</h1>
    </header>

    <div id="modal">
        <div class="modal-content">
            <h2>Modification d'envoi</h2>
            <form action="">
                <label>N* d'Immatriculaction :</label><input type="text" id="idvoitToModify" required><br><br>
                <label>Nom de l'Envoyeur :</label><input type="text" id="nomEnvoyeurToModify" required><br><br>
                <label>Email de l'Envoyeur :</label><input type="email" id="emailEnvoyeurToModify" required><br><br>
                <label>Nom du Récepteur :</label><input type="text" id="nomRecepteurToModify" required><br><br>
                <label>Contact du récepteur :</label><input type="text" id="contactRecepteurToModify" required>
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
                <li id="active" onclick="document.location='formulaire.envoyer.php'">Envoyer</li>
                <li onclick="document.location='../Recevoir/formulaire.recevoir.php'">Recevoir</li>
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
<script src="envoyer.js"></script>
</html>