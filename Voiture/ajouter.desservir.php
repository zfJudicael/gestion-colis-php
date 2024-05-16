<?php ob_start(); ?> 
<form action="validation.desservir.php" method="POST">
    <fieldset>
        <label>N* d'Immatriculation :</label><input type="text" name="idvoit" placeholder="Identifiant du voiture.." required><br>
        <label>Itinéraire :</label><input type="text" name="codeit" placeholder="Ligne de la voiture.." required><br>
        <label>Frais :</label><input type="number" min="1000" name="frais" placeholder="Frais.." required>
        <div class="center">
            <input type="submit" value="Enregistrer" class="vert">
        </div>
    </fieldset>
</form>

<?php
    $titre = "<h2>Mettre en oeuvre une voiture </h2>";
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>