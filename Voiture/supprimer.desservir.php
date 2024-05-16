<?php ob_start(); ?> 
<?php
require "../connect.php";
         $id = $_GET['ID'];
         $sql = $conn->prepare("DELETE FROM desservir WHERE id = :id ");
         $sql->bindParam(':id', $id);

         try {
                $sql->execute();
                $titre = "<h2>Suppression bien effectuée</h2>";
                echo "Les données concernant ce dernier sont effacées de la base de donnée.";
            }catch(PDOException $e) {
                $titre = "<h2>Suppression non effectuée</h2>";
                echo "Error: " . $e->getMessage();
            }
?>
<?php
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>