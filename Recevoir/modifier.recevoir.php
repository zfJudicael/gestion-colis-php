<?php ob_start(); ?>

<?php
require "../connect.php";
    $idRecept = $_GET["idrecept"];
    $newIdcolis = $_GET["newIdcolis"];

    $sql0 = $conn->prepare("SELECT idcolis FROM recevoir WHERE idrecept = :idrecept");
    $sql0->bindParam(':idrecept', $idRecept);
    $sql0->execute();
    while($row0 = $sql0->fetch()){
        $oldIdcolis = $row0['idcolis'];
    } 

    if(empty($newIdcolis)){
        $titre = "Modification echouée";
        echo "Veuillez bien remplir le champ Numéro du colis";
    }else {
        $sql1 = $conn->prepare("SELECT * FROM colis WHERE idcolis = :idcolis and recu = 0");
        $sql1->bindParam('idcolis', $newIdcolis);
        $sql1->execute();
        $result1 = $sql1->setFetchMode(PDO::FETCH_ASSOC);
        $row1 = $sql1->rowCount();
        if($row1 == 0){
            $titre = "Modification echouée";
            echo "Ce colis n'existe pas ou a été deja réçu.";
        }else{
            $titre = "Modification achevée";
            echo "La base de donnée a été mise à jour";
            $sql2 = $conn->prepare("UPDATE recevoir SET idcolis = :idcolis WHERE idrecept = :idrecept");
            $sql2->bindParam(':idcolis', $newIdcolis);
            $sql2->bindParam(':idrecept', $idRecept);
            $sql2->execute();

            $sql3 = $conn->prepare("UPDATE colis SET recu = 0 WHERE idcolis = :idcolis");
            $sql3->bindParam(':idcolis', $oldIdcolis);
            $sql3->execute();

            $sql4 = $conn->prepare("UPDATE colis SET recu = 1 WHERE idcolis = :idcolis");
            $sql4->bindParam(':idcolis', $newIdcolis);
            $sql4->execute();
        }
    }
?>

<?php
    $content = ob_get_clean();
    require_once "template.recevoir.php";
?>