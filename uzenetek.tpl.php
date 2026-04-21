<h2>Beérkezett üzenetek</h2>
<table>
    <tr><th>Név</th><th>Üzenet</th><th>Időpont</th></tr>
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=pizza_db', 'root', '');
    $res = $dbh->query("SELECT * FROM uzenetek ORDER BY idopont DESC");
    while($sor = $res->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".htmlspecialchars($sor['nev'])."</td><td>".htmlspecialchars($sor['szoveg'])."</td><td>".$sor['idopont']."</td></tr>";
    }
    ?>
</table>