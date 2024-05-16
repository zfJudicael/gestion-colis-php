<?php ob_start(); ?> 
  <?php
    $oldCodeit = $_GET["oldCodeit"];
    $newCodeit = $_GET["newCodeit"];
    $newVilledep = $_GET["newVilledep"];
    $newVillearr = $_GET["newVillearr"];

    require "../connect.php";
         $sql = $conn->prepare("UPDATE itineraire SET codeit = :newCodeit, villedep = :newVilledep, villearr = :newVillearr WHERE codeit= :oldCodeit;");
         $sql->bindParam(':newCodeit', $newCodeit);
         $sql->bindParam(':newVilledep', $newVilledep);
         $sql->bindParam(':newVillearr', $newVillearr);
         $sql->bindParam(':oldCodeit', $oldCodeit);

    if(empty($newCodeit) || empty($newVilledep) || empty($newVillearr)){
        $titre = "<h2>Modification non effectuée</h2>";
        echo "Veuillez bien remplir les cases";
    }else {
        try {
            $sql->execute();
            $titre = "<h2>Modification bien effectuée</h2>";
            echo "Les données de la base de donnée ont bien été mises à jour";
        }catch(PDOException $e) {
            $titre = "<h2>Modification non effectuée</h2>";
            echo "Error: " . $e->getMessage();
        }
    }
  ?>

<?php
    $content = ob_get_clean();
    require_once "template.itineraire.php";
?>