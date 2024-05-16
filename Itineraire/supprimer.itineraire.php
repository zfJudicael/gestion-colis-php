<?php ob_start(); ?> 
<?php
require "../connect.php";
         $codeit = $_GET['ID'];
         $sql = $conn->prepare("DELETE FROM itineraire WHERE codeit = :codeit ");
         $sql->bindParam(':codeit', $codeit);

         try {
                $sql->execute();
                $titre = "<h2>Suppression bien effectuée</h2>";
                echo "Les données concernant ".$codeit." sont effacées de la base de donnée.";
            }catch(PDOException $e) {
                $titre = "<h2>Suppression non effectuée</h2>";
                echo "Error: " . $e->getMessage();
            }
?>
<?php
    $content = ob_get_clean();
    require_once "template.itineraire.php";
?>