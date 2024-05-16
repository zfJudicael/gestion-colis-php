<?php ob_start(); ?> 
  <?php
    $ID = $_GET["oldCodeit"];
    $newCodeit = $_GET["newCodeit"];
    $newFrais = $_GET["newFrais"];

    require "../connect.php";

    $stmt1 = $conn->prepare("SELECT * FROM itineraire WHERE codeit = :codeit ");
    $stmt1->bindParam(':codeit', $newCodeit);
    $stmt1->execute();
    $result2 = $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $row1 = $stmt1->rowCount();

    $stmt2 = $conn->prepare("UPDATE desservir SET codeit = :newCodeit, frais = :newFrais WHERE id= :ID;");
    $stmt2->bindParam(':newCodeit', $newCodeit);
    $stmt2->bindParam(':newFrais', $newFrais);
    $stmt2->bindParam(':ID', $ID);

    if(($row1 > 0) && !empty($newFrais)){
        try {
            $stmt2->execute();
            $titre = "<h2 style='color: green;'>Modification bien effectuée</h2>";
            echo "La base de donnée est mise à jour.";
        }catch(PDOException $e) {
            $titre = "<h2 style='color: red;'>Modification non effectuée</h2>";
            echo "Error: " . $e->getMessage();
        }
    }else {
        $titre = "<h2 style='color: red;'>Modification non effectuée</h2>";
        echo "Peut être que l'itineraire entré n'existe pas ou certain champ est vide. Veuillez bien remplir la formulaire.";
    }
  ?>

<?php
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>