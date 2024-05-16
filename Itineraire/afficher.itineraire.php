<?php ob_start(); ?>

    <table>
    <tr><th>Code itinéraire</th><th>Ville de Départ</th><th>Ville d'Arrivé</th><th></th><th></th></tr>
    
    <?php
    require "../connect.php";
    $delete = "DELETE FROM colis WHERE idcolis NOT IN (SELECT idcolis FROM envoyer);";
    $conn->exec($delete);
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
                echo "<td class=\"modifier\"><button class=\"btnModif\">Modifier</button></td>
                      <td class=\"supprimer\"><button class=\"btnSup\">Supprimer</button></td>
                      </tr>" ;
            }
        }
            
            $stmt = $conn->prepare("SELECT * FROM itineraire");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
            }
            $conn = null;
    ?>

    </table>
    <div class="center">
        <button onclick = "document.location='ajouter.itineraire.php'" class="vert">Ajouter un nouveau</button>
    </div>
    

<?php
    $titre = "<h2>Affichage de tous les itinéraires</h2>";
    $content = ob_get_clean();
    require_once "template.itineraire.php";
?>