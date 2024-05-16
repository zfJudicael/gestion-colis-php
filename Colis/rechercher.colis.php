<?php ob_start(); ?>
    <?php
    require "../connect.php";
        $idenvoi = $_POST["idenvoi"];
        $designColis = $_POST["designColis"];
        $date1 = $_POST["date1"];
        $date2 = $_POST["date2"];

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

        
        if(empty($designColis) && empty($idenvoi) && (empty($date1) || empty($date2)) ){
            echo "Paramètre de recherche manquant ou vide";
        }

        if(!empty($idenvoi)){
            $sql1 = $conn->prepare("SELECT colis.idcolis, envoyer.idenvoi, colis.designColis, colis.recu, envoyer.date_envoi  
                                    FROM colis, envoyer 
                                    WHERE colis.idcolis = envoyer.idcolis 
                                    AND envoyer.idenvoi = :idenvoi");
            $sql1->bindParam(':idenvoi', $idenvoi);
            $sql1->execute();
            $result1 = $sql1->setFetchMode(PDO::FETCH_ASSOC);
            $row1 = $sql1->rowCount();
            if($row1 > 0){
                echo "<table>";
                echo "<tr><th>Id Colis</th><th>Id envoi</th><th>Designation colis</th><th>Réçu</th><th>Date d'envoi</th></tr>";
                    foreach(new TableRows(new RecursiveArrayIterator($sql1->fetchAll())) as $k=>$v) {
                        echo $v;
                    }
                echo "</table>";
            }else {
                echo "Aucun colis trouvé";
            }
        }

        if(!empty($designColis)){
            $sql2 = $conn->prepare("SELECT colis.idcolis, envoyer.idenvoi, colis.designColis, colis.recu, envoyer.date_envoi 
                                    FROM colis, envoyer 
                                    WHERE colis.idcolis = envoyer.idcolis
                                    AND colis.designColis LIKE CONCAT('%', :designColis ,'%') ");
            $sql2->bindParam(':designColis', $designColis);
            $sql2->execute();
            $result2 = $sql2->setFetchMode(PDO::FETCH_ASSOC);
            $row2 = $sql2->rowCount();
            if($row2 > 0){
                echo "<table>";
                echo "<tr><th>Id Colis</th><th>Id envoi</th><th>Designation colis</th><th>Réçu</th><th>Date d'envoi</th></tr>";
                foreach(new TableRows(new RecursiveArrayIterator($sql2->fetchAll())) as $k=>$v) {
                    echo $v;
                }
                echo "</table>";
            }else {
                echo "Aucun colis trouvé";
            }
        }

        if(!empty($date1) && !empty($date2)){
            $sql3 = $conn->prepare("SELECT colis.idcolis, envoyer.idenvoi, colis.designColis, colis.recu, envoyer.date_envoi 
                                    FROM colis, envoyer
                                    WHERE colis.idcolis = envoyer.idcolis
                                    AND envoyer.date_envoi BETWEEN :date1 AND :date2");
            $sql3->bindParam(':date1', $date1);
            $sql3->bindParam(':date2', $date2);
            $sql3->execute();
            $result3 = $sql3->setFetchMode(PDO::FETCH_ASSOC);
            $row3 = $sql3->rowCount();
            if($row3 > 0){
                echo "<table>";
                echo "<tr><th>Id Colis</th><th>Id envoi</th><th>Designation colis</th><th>Réçu</th><th>Date d'envoi</th></tr>";
                foreach(new TableRows(new RecursiveArrayIterator($sql3->fetchAll())) as $k=>$v) {
                    echo $v;
                }
                echo "</table>";
            }else {
                echo "Aucun colis trouvé";
            }
        };
    ?>
<?php
    $titre = "Résultat de la recherche";
    $content = ob_get_clean();
    require_once "template.colis.php";
?>