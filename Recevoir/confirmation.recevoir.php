<?php ob_start(); ?>
<?php
    require "../connect.php";
    $idcolis = $_POST["idcolis"];

    $sql1 = $conn->prepare("SELECT * FROM colis WHERE idcolis = :idcolis");
    $sql1->bindParam('idcolis', $idcolis);
    $sql1->execute();
    $result1 = $sql1->setFetchMode(PDO::FETCH_ASSOC);
    $row1 = $sql1->rowCount();


    $sql2 = $conn->prepare("SELECT idenvoi, idvoit, designColis, nomEnvoyeur, nomRecepteur, contactRecepteur, date_envoi
                            FROM colis, envoyer
                            WHERE colis.idcolis = envoyer.idcolis
                            AND colis.idcolis = :idcolis;");
    $sql2->bindParam('idcolis', $idcolis);
    
    if($row1 > 0){
        echo "A propos du colis numéro : <span>".$idcolis."</span>";
        echo "<table>";
        echo "<tr>
                <th>IdEnvoi</th>
                <th>IdVoit</th>
                <th>Design Colis</th>
                <th>Nom Envoyeur</th>
                <th>Nom Récepteur</th>
                <th>Contact Récepteur</th>
                <th>Date envoi</th>
             </tr>";
        class TableRows extends RecursiveIteratorIterator {
            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);
            }
            
            function current() {
                return "<td>" . parent::current(). "</td>";
            }
            
            function beginChildren() {
                echo "<tr>";
            }
            
            function endChildren() {
                echo "</tr>" . "\n";
            }
        }
            
        $sql2->execute();
            
        // set the resulting array to associative
        $result2 = $sql2->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($sql2->fetchAll())) as $k=>$v) {
            echo $v;
        }
        echo "</table>";
        echo '<div class="center"><button id="confRecept" class="vert" onClick = confRecept()>Confirmer</button><button id="annulerRecept" class="close" onClick = annulerRecept()>Annuler</button></div>';
        
    }else {
        echo "Colis le numéro : ".$idcolis." n'existe pas";
    }
?>
<?php
    $titre = "Confirmation colis";
    $content = ob_get_clean();
    require_once "template.recevoir.php";
?>