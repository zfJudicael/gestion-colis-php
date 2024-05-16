<?php ob_start(); ?>
<?php
    require "../connect.php";
    $idenvoi = $_GET["idenvoi"];
    $idcolis = $_GET["idcolis"];
    
    $sup1 = $conn->prepare("DELETE FROM envoyer WHERE idenvoi = :idenvoi");
    $sup1->bindParam(':idenvoi', $idenvoi);

    $sup2 = $conn->prepare("DELETE FROM colis WHERE idcolis = :idcolis");
    $sup2->bindParam(':idcolis', $idcolis);

    try{
        $sup1->execute();
        $sup2->execute();

        $titre = "Suppression bien achevée";
        echo "La base de donnée est bien mise à jour";
    }catch(PDOException $e) {
        $titre = "Suppression non achevée";
        echo "Erreur : ".$e->getMessage();
    }
?>
<?php
    $content = ob_get_clean();
    require_once "template.envoyer.php";
?>