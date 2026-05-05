<h2>Beérkezett üzenetek</h2>
<table>
    <tr>
        <th>Küldő neve</th>
        <th>Üzenet</th>
        <th>Időpont</th>
    </tr>
    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=dmebalzs', 'dmebalzs', '67Balazs82.', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        
        $res = $dbh->query("SELECT * FROM uzenetek ORDER BY bekuldes_ideje DESC");
        
        while($sor = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($sor['kuldo_neve'])."</td>";
            echo "<td>".htmlspecialchars($sor['uzenet_szovege'])."</td>";
            echo "<td>".$sor['bekuldes_ideje']."</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='3'>Hiba: " . $e->getMessage() . "</td></tr>";
    }
    ?>
</table>