<?php ob_start(); ?>
<table>
    <tr>
        <th>Idenvoi</th>
        <th>Idvoit</th>
        <th>Idcolis</th>
        <th>Nom de l'envoyeur</th>
        <th>Email de l'envoyeur</th>
        <th>Nom du récepteur</th>
        <th>contact du récepteur</th>
        <th>Frais</th>
        <th>Date de l'envoi</th>
        <th></th><th></th>
    </tr>
    
    <?php
    require "../connect.php";
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
                      </tr>" . "\n";
            }
        }
            
            $stmt = $conn->prepare("SELECT * FROM envoyer");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
            }
            $conn = null;
    ?>

    </table>

    <button style="margin-top:20px; padding:10px" class="vert" onclick = "document.location='formulaire.envoyer.php'">Ajouter un nouveau</button>

<?php
    $titre = "Liste des envois";
    $content = ob_get_clean();
    require_once "template.envoyer.php";
?>