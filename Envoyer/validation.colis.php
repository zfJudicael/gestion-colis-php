<?php ob_start(); ?>
    <?php
    require "../connect.php";
    $idvoit = $_POST["idvoit"]; 
    $idcolis = $_POST["idcolis"];
    $designColis = $_POST["designColis"];
    $poids = $_POST["poids"];
    $nomEnvoyeur = $_POST["nomEnvoyeur"];
    $emailEnvoyeur = $_POST["emailEnvoyeur"];
    $nomRecepteur = $_POST["nomRecepteur"];
    $contactRecepteur = $_POST["contactRecepteur"];
    $frais = $_POST["frais"];
 
    $sql1 = $conn->prepare("INSERT INTO envoyer(idvoit, idcolis, nomEnvoyeur, emailEnvoyeur, nomRecepteur, contactRecepteur, frais) VALUES(:idvoit, :idcolis, :nomEnvoyeur, :emailEnvoyeur, :nomRecepteur, :contactRecepteur, :frais)");
    $sql1->bindParam(':idvoit', $idvoit);
    $sql1->bindParam(':idcolis', $idcolis);
    $sql1->bindParam(':nomEnvoyeur', $nomEnvoyeur);
    $sql1->bindParam(':emailEnvoyeur', $emailEnvoyeur);
    $sql1->bindParam(':nomRecepteur', $nomRecepteur);
    $sql1->bindParam(':contactRecepteur', $contactRecepteur);
    $sql1->bindParam(':frais', $frais);
    
    try{
        $sql1->execute();
        $titre = "Colis envoyer avec succès..";
        $idenvoi = $conn->lastInsertId();
        echo '<div id="recu" style="text-align: left; padding-left: 80px;">';
                echo 'Numéro de l\'envoi : '.$idenvoi.'<br>';
                echo 'Numéro du  colis : '.$idcolis.'<br>';
                echo 'Désignation du colis : '.$designColis.'<br>';
                echo 'Poids : '.$poids.'<br>';
                echo 'Frais : '.$frais.'<br>';
                echo 'Nom de l\'envoyeur : '.$nomEnvoyeur.'<br>';
                echo 'Email de l\'envoyeur : '.$emailEnvoyeur.'<br>';
                echo 'Nom du récepteur : '.$nomRecepteur.'<br>';
                echo 'Contact du récepteur : '.$contactRecepteur.'<br>';
        echo '</div>';
        $sql2 = "DELETE FROM colis WHERE idcolis NOT IN (SELECT idcolis FROM envoyer);";
        $conn->exec($sql2);
        echo "<button onclick=\"document.location ='../printPdf/printPdf.php?idenvoi=".$idenvoi."'\">Télécharger réçu</button>";

    }catch (PDOException $e){
        $titre = "Colis non envoyé.";
        echo "Peut-être que ce colis est déja enregistré et envoyé.<br>";
        echo "Erreur : ".$e->getMessage();
    }

    ?>
   
<?php
    $content = ob_get_clean();
    require_once "template.envoyer.php";
?>