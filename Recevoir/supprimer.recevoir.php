<?php ob_start(); ?>

<?php
    require "../connect.php";
    $idrecept = $_GET["idRecept"];
    $idcolis = $_GET["idcolis"];

    $sql1 = $conn->prepare("DELETE FROM recevoir WHERE idrecept = :idrecept");
    $sql1->bindParam(':idrecept', $idrecept);

    $sql2 = $conn->prepare("UPDATE colis SET recu = 0 WHERE idcolis = :idcolis");
    $sql2->bindParam(':idcolis', $idcolis);

    if(!empty($idrecept) && !empty($idcolis)){
        try{
            $sql1->execute();
            $sql2->execute();
            $titre = "Suppression bien effectuée";
            echo "La base de donnée a été bien mise à jour";
        }catch(PDOException $e){
            $titre = "Suppression recontre une erreur";
            echo "Erreur : ".$e->getMessage();
        }
    }else {
        $titre = "Suppression non achevée";
        echo "Peut-être que l'un des Id de Récepetion ou l'id colis n'existe pas ou vide";
    }
?>

<?php
    $content = ob_get_clean();
    require_once "template.recevoir.php";
?>