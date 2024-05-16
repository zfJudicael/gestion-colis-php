<?php ob_start(); ?> 
<form action="validation.voiture.php" method="POST">
    <fieldset>
        <label>N* d'Immatriculation :</label><input type="text" name="idvoit" placeholder="Identifiant.." required><br>
        <label>Designation :</label><input type="text" name="design" placeholder="Couleur ou autre chose.." required>
        <div class="center">
            <input type="submit" value="Enregistrer" class="vert">
        </div>
    </fieldset>
</form>

<?php
    $titre = "<h2>Nouvelle voiture</h2>";
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>