<?php ob_start(); ?>
    <?php
    require "../connect.php";
    $idvoit = $_POST["idvoit"];
    $designColis = $_POST["designColis"];
    $poids = $_POST["poids"];
    $nomEnvoyeur = $_POST["nomEnvoyeur"]; 
    $emailEnvoyeur = $_POST["emailEnvoyeur"];
    $nomRecepteur = $_POST["nomRecepteur"];
    $contactRecepteur = $_POST["contactRecepteur"];

    $sql1 = $conn->prepare("INSERT INTO colis(designColis, poids) VALUES(:designColis, :poids)");
    $sql1->bindParam(':designColis', $designColis);
    $sql1->bindParam(':poids', $poids);
                    
    // $sql1 = $conn->prepare("SELECT idcolis FROM colis ORDER BY idcolis desc limit 1");

    $sql2 = $conn->prepare("SELECT frais FROM desservir WHERE idvoit = :idvoit");
    $sql2->bindParam(':idvoit', $idvoit);

    $sql3 = $conn->prepare("DELETE FROM colis WHERE idcolis = :idcolis");
    $sql3->bindParam(':idcolis', $idcolis);

    $sql4 = $conn->prepare("SELECT * FROM envoyer WHERE idcolis = :idcolis");
    $sql4->bindParam(':idcolis', $idcolis);

    if(!empty($idvoit) && !empty($designColis) && !empty($poids) && !empty($nomEnvoyeur) && !empty($emailEnvoyeur) && !empty($nomRecepteur) && !empty($contactRecepteur)){
        try{
            $sql1->execute();
            $idcolis = $conn->lastInsertId();
 
            if(!empty($idcolis)){
                $sql4->execute();
                $result4 = $sql4->setFetchMode(PDO::FETCH_ASSOC);
                $row4 = $sql4->rowCount();

                if($row4 == 0){
                    $sql2->execute();
                    while($row2 = $sql2->fetch()){
                        $frais = $row2['frais'];
                    }

                    if ( !empty($frais) ){
                        $titre = "Confirmation de l'Envoi";
                        echo '<div class="div1">';
                        echo '<form action="validation.colis.php" method="POST">';
                        echo '<label>N* d\'Immatricuation :</label>';
                        echo '<input readonly type="text" name="idvoit" value='.$idvoit.'><br><br>';
                        echo '<label>Designation colis :</label>';
                        echo '<input readonly type="text" name="designColis" value='.$designColis.'><br><br>';
                        echo '<label>Id Colis :</label>';
                        echo '<input readonly type="text" name="idcolis" value='.$idcolis.'><br><br>';
                        echo '<label>Poids :</label>';
                        echo '<input readonly type="number" name="poids" value='.$poids.'><br><br>';
                        echo '<label>Frais :</label>';
                        echo '<input readonly type="number" name="frais" value='.$frais*$poids.'><br><br>';
                        echo '<label>Nom de l\'Envoyeur :</label>';
                        echo '<input readonly type="text" name="nomEnvoyeur" value='.$nomEnvoyeur.'><br><br>';
                        echo '<label>Email de l\'Envoyeur :</label>';
                        echo '<input readonly type="email" name="emailEnvoyeur" value='.$emailEnvoyeur.'><br><br>';
                        echo '<label>Nom récepteur :</label>';
                        echo '<input readonly type="text" name="nomRecepteur" value='.$nomRecepteur.'><br><br>';
                        echo '<label>Contact du récepteur :</label>';
                        echo '<input readonly type="text" name="contactRecepteur" value='.$contactRecepteur.'><br><br>';
                        echo '<input type="submit" class="vert" value="Envoyer">';
                        echo '</form>';   
                        echo '</div>';                
                    }else {
                        $titre = "Veuillez bien remplir la formulaire";
                        echo "La voiture entrée n'est pas enregistré dans la base de donnée";
                        $sql3->execute();
                    }

                }else {
                    $titre = "Erreur de l'envoi";
                    echo "Le colis portant ce numéro ".$idcolis." est déja enregistré à un envoi.";
                }
            }
        }catch(PDOException $e) {
            $titre = "L'Envoi recontre de problème";
            echo "Error: " . $e->getMessage();
        }
    }else{
        $titre = "Champs ne sont pas bien remplis";
    }
 
    ?>
<?php
    $content = ob_get_clean();
    require_once "template.envoyer.php";
?>