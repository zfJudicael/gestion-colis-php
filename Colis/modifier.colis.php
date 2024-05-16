<?php ob_start(); ?>
<?php
    require "../connect.php";
    $idcolis = $_GET["idcolis"];
    $newDesign = $_GET["newDesign"];
    $newPoids = $_GET["newPoids"];

    $sql1 = $conn->prepare("UPDATE colis SET designcolis = :designcolis, poids = :poids WHERE idcolis = :idcolis");
    $sql1->bindParam(':idcolis', $idcolis);
    $sql1->bindParam(':designcolis', $newDesign);
    $sql1->bindParam(':poids', $newPoids);

    $sql2 = $conn->prepare("SELECT idvoit FROM envoyer WHERE idcolis = :idcolis");
    $sql2->bindParam(':idcolis', $idcolis);
    $sql2->execute();
    while($row2 = $sql2->fetch()){
        $idvoit = $row2['idvoit'];
    }

    $sql3 = $conn->prepare("SELECT frais FROM desservir WHERE idvoit = :idvoit");
    $sql3->bindParam(':idvoit', $idvoit);
    $sql3->execute();
    while($row3 = $sql3->fetch()){
        $frais = $row3['frais'];
    }

    $fraisMAJ = $frais*$newPoids;

    $sql4 = $conn->prepare("UPDATE envoyer SET frais = :frais WHERE idcolis = :idcolis");
    $sql4->bindParam(':frais', $fraisMAJ);
    $sql4->bindParam(':idcolis', $idcolis);

    if(!empty($idcolis) && !empty($frais) && !empty($newPoids) && !empty($newDesign)){
        try{
            $sql1->execute();
            $sql4->execute();
            $titre = "Modification bien effectuée";
            echo "Base de donnée bien mise à jour";
        }catch(PDOException $e){
                $titre = "Modification non effectuée";
                echo "Erreur : ".$e->getMessage();
        }
    }
?>
<?php
    $content = ob_get_clean();
    require_once "template.colis.php";
?>