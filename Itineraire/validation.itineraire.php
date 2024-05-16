<?php ob_start(); ?> 
<?php
    require "../connect.php";
    $stmt = $conn->prepare("INSERT INTO itineraire VALUES (:codeit, :villedep, :villearr)");
    $stmt->bindParam(':codeit', $codeit);
    $stmt->bindParam(':villedep', $villedep);
    $stmt->bindParam(':villearr', $villearr);

    $codeit = $_POST["codeit"];
    $villedep = $_POST["villedep"];
    $villearr = $_POST["villearr"];

    if(empty($codeit) || empty($villedep) || empty($villearr)){
        $titre = "<h2 style='color: red;'>Enregistrement non effectué</h2>";
        echo "Veuillez bien remplir les formulaires SVP";
    }else {
        try {
            $stmt->execute();
            $titre = "<h2 style='color: green;'>Enregistrement bien effectué</h2>";
            echo "L'Itineraire ayant le code ".$codeit." a bien été ajouter à la base de donnée.";
        }catch(PDOException $e) {
            $titre = "<h2 style='color: red;'>Enregistrement non effectué</h2>";
            echo "Error: " . $e->getMessage();
        }
    }
?>

<?php
    $content = ob_get_clean();
    require_once "template.itineraire.php";
?>