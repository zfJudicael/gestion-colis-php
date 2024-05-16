<?php ob_start(); ?>

    <table>
    <tr><th style="color:white">Numéro d'Immatriculation</th><th style="color:white">Designation</th><th></th><th></th></tr>
    
    <?php
    require "../connect.php";
        class voitureTableRows extends RecursiveIteratorIterator {
            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);
            }
            
            function current() {
                return "<td>" . parent::current(). "</td>";
            }
            
            function beginChildren() {
                echo "<tr class=\"trTab1\">";
            }
            
            function endChildren() {
                echo "<td class=\"modifierVoit\"><button class=\"btnModifVoit mod\">Modifier</button></td>
                      <td class=\"supprimerVoit\"><button class=\"btnSupVoit sup\">Supprimer</button></td>
                      </tr>" . "\n";
            }
        }
            
            $stmt = $conn->prepare("SELECT * FROM voiture");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new voitureTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
            }
            $conn = null;
    ?>

    </table>
    <div class="center">
        <button onclick = "document.location='ajouter.voiture.php'" class="vert">Ajouter un nouveau</button>
    </div>

    <div class="titre">
        <h2>L'Itineraire desservi et le frais de transport pour chaque voitures</h2>
    </div>
    
    <table>
    <tr><th style="color:white">Id</th><th style="color:white">Numéro d'Immatriculation</th><th style="color:white">Code Itinéraire</th><th style="color:white">Frais</th><th></th><th></th></tr>
    
    <?php
    require "../connect.php";
    $delete = "DELETE FROM colis WHERE idcolis NOT IN (SELECT idcolis FROM envoyer);";
    $conn->exec($delete);
        class desservirTableRows extends RecursiveIteratorIterator {
            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);
            }
            
            function current() {
                return "<td>" . parent::current(). "</td>";
            }
            
            function beginChildren() {
                echo "<tr class=\"trTab2\">";
            }
            
            function endChildren() {
                echo "<td class=\"modifierDes\"><button class=\"btnModifDes mod\">Modifier</button></td>
                      <td class=\"supprimerDes\"><button class=\"btnSupDes sup\">Supprimer</button></td>
                      </tr>" . "\n";
            }
        }
            
            $stmt = $conn->prepare("SELECT * FROM desservir");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new desservirTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
            }
            $conn = null;
    ?>
    </table>
    <div class="center">
        <button onclick = "document.location='ajouter.desservir.php'" class="vert">Ajouter un nouveau</button>
    </div>

<?php
    $titre = "<h2>Liste de tous les voitures</h2>";
    $content = ob_get_clean();
    require_once "template.voiture.php";
?>