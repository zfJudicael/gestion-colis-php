<?php ob_start(); ?>
    <form action="envoyer.colis.php" method="POST">
        <fieldset>
        <label>N* d'Immatricuation :</label>
        <input required type="text" name="idvoit" placeholder="Numéro voiture.."><br>
        <label>Désignation colis :</label>
        <input required type="text" name="designColis" placeholder="Désignation colis.."><br>
        <label>Poids :</label>
        <input required type="number" name="poids" min="1" max="100" placeholder="Poids colis.."><br>
        <label>Nom de l'Envoyeur :</label>
        <input required type="text" name="nomEnvoyeur" placeholder="Nom envoyeur.."><br>
        <label>Email de l'Envoyeur :</label>
        <input required type="email" name="emailEnvoyeur" placeholder="Email envoyeur.."><br>
        <label>Nom récepteur :</label>
        <input required type="text" name="nomRecepteur" placeholder="Nom récepteur.."><br>
        <label>Contact du récepteur :</label>
        <input required type="text" name="contactRecepteur" placeholder="Contact récepteur.."><br>
        <?php
            require "../connect.php";
            $delete = "DELETE FROM colis WHERE idcolis NOT IN (SELECT idcolis FROM envoyer);";
            $conn->exec($delete);
        ?>
        <div class="center">
            <input class="vert" type="submit" value="Envoyer">
        </div>
        </fieldset>
    </form>
    <button id="listeEnvoyer" onclick="document.location='afficher.envoyer.php'">Archive des envois</button>
    
<?php
    $titre = "Envoyer un colis";
    $content = ob_get_clean();
    require_once "template.envoyer.php";
?>