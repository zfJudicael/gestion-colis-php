<?php ob_start(); ?>

    <fieldset>
    <form class="form1" action="rechercher.colis.php" method="POST">
        <select name="" id="">
            <option value="idenvoi">Code d'envoi</option>
            <option value="design">Designation</option>
            <option value="dateEnvoi">Date d'envoi</option>
        </select>
        <input type="number" min="1" name="idenvoi" placeholder="Code envoi.." class="idenvoi">
        <input type="text" name="designColis" placeholder="Design colis.." class="design">
                
        <span class="dateEnvoi"> Entre </span>
        <input type="datetime-local" name="date1" class="dateEnvoi">
                <span class="dateEnvoi"> et </span>
        <input type="datetime-local" name="date2" class="dateEnvoi">
        <input type="submit" value="Rechercher" class="recherche">
    </form>
    </fieldset>

    <table>
        <tr><th>Id Colis</th><th>Designation du colis</th><th>Poids</th><th>Réçu</th><th></th><th></th></tr>
        
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
                
                $stmt = $conn->prepare("SELECT * FROM colis");
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
    $titre = "Liste de tous les colis";
    $content = ob_get_clean();
    require_once "template.colis.php";
?>