<?php ob_start(); ?>
<?php
    require "../connect.php";
    $idenvoi = $_GET["idenvoi"];
    $idvoit = $_GET["idvoit"];
    $nomEnvoyeur = $_GET["nomEnvoyeur"];
    $emailEnvoyeur = $_GET["emailEnvoyeur"];
    $nomRecepteur = $_GET["nomRecepteur"];
    $contactRecepteur = $_GET["contactRecepteur"];

    $sql1 = $conn->prepare("UPDATE envoyer 
    SET idvoit = :idvoit, nomEnvoyeur = :nomEnvoyeur, emailEnvoyeur = :emailEnvoyeur, nomRecepteur = :nomRecepteur, contactRecepteur = :contactRecepteur 
    WHERE idenvoi = :idenvoi");
    $sql1->bindParam('idenvoi', $idenvoi);
    $sql1->bindParam('idvoit', $idvoit);
    $sql1->bindParam('nomEnvoyeur', $nomEnvoyeur);
    $sql1->bindParam('emailEnvoyeur', $emailEnvoyeur);
    $sql1->bindParam('nomRecepteur', $nomRecepteur);
    $sql1->bindParam('contactRecepteur', $contactRecepteur);

    $sql2 = $conn->prepare("SELECT * FROM desservir WHERE idvoit = :idvoit ");
    $sql2->bindParam(':idvoit', $idvoit);
    $sql2->execute();
    $result2 = $sql2->setFetchMode(PDO::FETCH_ASSOC);
    $row2 = $sql2->rowCount();

    if($row2 > 0){
        try{
            $sql1->execute();
            $titre = "Modification bien effectuée";
            echo "La base de donnée a été mise à jour";
        }catch(PDOException $e){
            echo "Erreur : ".$e->getMessage();
        }
    }else {
        $titre = "Modification echouée";
        echo "La voiture ".$idvoit." n'est pas en activitée";
    }
?>

<?php
    $content = ob_get_clean();
    require_once "template.envoyer.php";
?>