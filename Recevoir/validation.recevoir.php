<?php ob_start(); ?>

<?php
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "../mail/src/Exception.php";
    require_once "../mail/src/PHPMailer.php";
    require_once "../mail/src/SMTP.php";

    require "../connect.php";
    $idcolis = $_GET["idcolis"];

    if(!empty($idcolis)){
        $sql1 = $conn->prepare("INSERT INTO recevoir(idcolis) VALUES(:idcolis)");
        $sql1->bindParam(':idcolis', $idcolis);

        $sql2 = $conn->prepare("UPDATE colis SET recu = 'oui' WHERE idcolis = :idcolis");
        $sql2->bindParam(':idcolis', $idcolis);

        $sql3 = $conn->prepare("SELECT emailEnvoyeur FROM envoyer WHERE idcolis = :idcolis");
        $sql3->bindParam(':idcolis', $idcolis);
        $sql3->execute();
        while($row3 = $sql3->fetch()){
            $destinataire = $row3['emailEnvoyeur'];
        }
    
        try{
            try {
                //mail configuration
                $mail = new PHPMailer(true);        
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "angelonambs@gmail.com";
                $mail->Password = "nidcegfdgnlhkprw";
                $mail->SMTPSecure = "ssl";
                $mail->Port = "465";
                $mail->CharSet = "utf-8";

                //destinataire & expediteur
                $mail->setFrom("angelonambs@gmail.com");
                $mail->addAddress($destinataire);

                //contenu
                $mail->Subject = "Colis express";
                $mail->isHTML(true);
                $mail->Body = "COLIS N* ".$idcolis." BIEN REÇU";

                //envoyer
                $mail->send();

                $sql1->execute();
                $sql2->execute();
                
                echo "Colis bien réçu";

            } catch (Exception) {
                echo "Erreur de connexion internet";
            }
            
        }catch(PDOException $e){
            echo "Erreur : ".$e->getMessage();
        }
    }else {
        echo "L'identifiant du colis non determiné";
    }
?>

<?php
    $titre = "Validation réception";
    $content = ob_get_clean();
    require_once "template.recevoir.php";
?>