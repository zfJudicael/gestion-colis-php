<?php ob_start(); ?>
<?php
    require "../connect.php";
    $idcolis = $_GET["idcolis"];

    $sql = $conn->prepare("DELETE FROM colis WHERE idcolis = :idcolis");
    $sql->bindParam(':idcolis', $idcolis);

    if(!empty($idcolis)){
        try{
            $sql->execute();
            $titre = "Suppression bien effectuée";
            echo "Base de donnée bien mise à jour";
        }catch(PDOException $e){
            $titre = "Suppression non effectuée";
            echo "Erreur : ".$e->getMessage();
        }
    }
?>
<?php
    $content = ob_get_clean();
    require_once "template.colis.php";
?>