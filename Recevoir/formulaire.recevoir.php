<?php ob_start(); ?>

<fieldset>
<form class="form1" action="confirmation.recevoir.php" method="POST">
    <label>Numéro du colis :</label>
    <input required type="number" name="idcolis" placeholder="Numéro du colis..">
    <input type="submit" value="Envoyer" class="vert" id="recevoir">
</form>
</fieldset>

<table>
    <tr><th>Id réception</th><th>Numéro colis</th><th>Date de la réception</th><th></th><th></th></tr>
    
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
                      </tr>" . "\n";
            }
        }
            
            $stmt = $conn->prepare("SELECT * FROM recevoir");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
            }
            $conn = null;
    ?>

    </table>

<?php
    $titre = "Recevoir colis";
    $content = ob_get_clean();
    require_once "template.recevoir.php";
?>