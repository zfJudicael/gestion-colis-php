<?php ob_start(); ?> 
<?php
require "../connect.php";
         $idvoit = $_GET['ID'];
         $sql = $conn->prepare("DELETE FROM voiture WHERE idvoit = :idvoit ");
         $sql->bindParam(':idvoit', $idvoit);

         try {
                $sql->execute();
                $titre = "<h2>Suppression bien effectuée</h2>";
                echo "Les données concernant ".$idvoit." sont effacées de la base de donnée.";
            }catch(PDOException $e) {
                $titre = "<h2>Suppression non effectuée</h2>";
                echo "Error: " . $e->getMessage();
            }
?>
<?php
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>