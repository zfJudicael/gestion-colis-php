<?php ob_start(); ?> 
  <?php
    $oldIdvoit = $_GET["oldIdvoit"];
    $newIdvoit = $_GET["newIdvoit"];
    $newDesign = $_GET["newDesign"];

    require "../connect.php";
         $sql = $conn->prepare("UPDATE voiture SET Idvoit = :newIdvoit, design = :newDesign WHERE Idvoit= :oldIdvoit;");
         $sql->bindParam(':newIdvoit', $newIdvoit);
         $sql->bindParam(':newDesign', $newDesign);
         $sql->bindParam(':oldIdvoit', $oldIdvoit);

    if(empty($newIdvoit) || empty($newDesign) || empty($oldIdvoit)){
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
    require_once "template.voiture.php";
?>