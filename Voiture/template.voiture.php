<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="voiture.css">
    <!-- <link href="./webfontkit-20230412-114110/stylesheet.css" rel="stylesheet"> -->
    <title>Colis Express</title>
</head>
<body>
    <header class="col-s-12 col-12">
        <h1>Colis Express</h1>
    </header>

    <div class="modals" id="modalForVoit">
        <div class="modal-content">
            <h2>Modification d'une voiture</h2>
            <form action="">
                <label>N* d'Immatriculation :</label><input type="text" id="idvoitToModify" name="idvoitToModify" required><br><br>
                <label>Designation :</label><input type="text" id="designToModify" name="designToModify" required>
            </form>
            <div class="center">
                <input type="button" value="Confirmer" id="confirmerModifVoit" class="vert"><input type="button" id="closeModalForVoit" value="Annuler" class="close">
            </div>
        </div>
    </div>
    <div class="modals" id="modalForDes">
        <div class="modal-content">
            <h2>Modification</h2>
            <form action="">
                <label>Itinéraire :</label><input type="text" id="codeitToModify" name="codeitToModify" required><br><br>
                <label>Frais :</label><input type="number" min="2000" id="fraisToModify" name="fraisToModify" required>    
            </form>
            <div class="center">
                <input type="button" value="Confirmer" id="confirmerModifDes" class="vert"><input type="button" id="closeModalForDes" value="Annuler" class="close">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="menu col-s-3 col-2">
            <ul>
                <li onclick="document.location='../index.php'">Acceuil</li>  
                <li onclick="document.location='../Itineraire/afficher.itineraire.php'">Itinéraires</li>
                <li id="active" onclick="document.location='afficher.voiture.php'">Voitures</li>
                <li onclick="document.location='../Envoyer/formulaire.envoyer.php'">Envoyer</li>
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
<script src="voiture.js"></script>
</html>