<?php ob_start(); ?> 
<form action="validation.itineraire.php" method="POST">
    <fieldset>
        <label>Code Itineraire :</label><input type="text" name="codeit" placeholder="Code.." required><br>
        <label>Ville de départ :</label><input type="text" name="villedep" placeholder="Départ.." required><br>
        <label>Ville d'Arrivé :</label><input type="text" name="villearr" placeholder="Destination.." required><br>
        <input type="submit" class="vert" value="Enregistrer">
    </fieldset>
</form>

<?php
    $titre = "<h2>Ajout d'un nouveau itineraire</h2>";
    $content = ob_get_clean();
    require_once "template.itineraire.php";
?>