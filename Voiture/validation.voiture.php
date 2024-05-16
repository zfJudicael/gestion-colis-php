<?php ob_start(); ?> 
<?php
    require "../connect.php";
    $stmt = $conn->prepare("INSERT INTO voiture VALUES (:idvoit, :design)");
    $stmt->bindParam(':idvoit', $idvoit);
    $stmt->bindParam(':design', $design);

    $idvoit = $_POST["idvoit"];
    $design = $_POST["design"];

    if(empty($idvoit) || empty($design)){
        $titre = "<h2 style='color: red;'>Enregistrement non effectué</h2>";
        echo "Veuillez bien remplir les formulaires SVP";
    }else {
        try {
            $stmt->execute();
            $titre = "<h2 style='color: green;'>Enregistrement bien effectué</h2>";
            echo "La voiture ayant le numéro d'immatriculation ".$idvoit." a bien été ajouter à la base de donnée.";
        }catch(PDOException $e) {
            $titre = "<h2 style='color: red;'>Enregistrement non effectué</h2>";
            echo "Error: " . $e->getMessage();
        }
    }
?>

<?php
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>