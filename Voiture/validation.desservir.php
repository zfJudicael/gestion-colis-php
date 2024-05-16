<?php ob_start(); ?> 
<?php
    require "../connect.php";
    $stmt1 = $conn->prepare("SELECT * FROM voiture WHERE idvoit = :idvoit ");
    $stmt1->bindParam(':idvoit', $idvoit);
    $idvoit = $_POST["idvoit"];
    $stmt1->execute();
    $result1 = $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $row1 = $stmt1->rowCount();

    $stmt2 = $conn->prepare("SELECT * FROM itineraire WHERE codeit = :codeit ");
    $stmt2->bindParam(':codeit', $codeit);
    $codeit = $_POST["codeit"];
    $stmt2->execute();
    $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    $row2 = $stmt2->rowCount();

    $stmt3 = $conn->prepare("INSERT INTO desservir(idvoit, codeit, frais) VALUES(:idvoit, :codeit, :frais)");
    $stmt3->bindParam(':idvoit', $idvoit);
    $stmt3->bindParam(':codeit', $codeit);
    $stmt3->bindParam(':frais', $frais);

    $frais = $_POST["frais"];


    if(($row1 > 0) && ($row2 > 0) && !empty($frais)){
        try {
            $stmt3->execute();
            $titre = "<h2 style='color: green;'>Enregistrement bien effectué</h2>";
            echo "Désormais la voiture : ".$idvoit." est enregistrée à travailler le long de la route ".$codeit." avec un frais de transport de : ".$frais."Ar.";
        }catch(PDOException $e) {
            $titre = "<h2 style='color: red;'>Enregistrement non effectué</h2>";
            echo "Error: " . $e->getMessage();
        }
    }else {
        $titre = "<h2 style='color: red;'>Enregistrement non effectué</h2>";
        echo "Peut être que la voiture choisie ou l'itineraire entré n'existe pas. Veuillez bien remplir la formulaire.";
    }
?>

<?php
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>