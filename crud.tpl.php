<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=pizza_db', 'root', '', 
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8');

    if (isset($_POST['delete_id'])) {
        $stmt = $dbh->prepare("DELETE FROM pizzak WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
    }

    if (isset($_POST['uj_pizza'])) {
        $stmt = $dbh->prepare("INSERT INTO pizzak (nev, leiras, ar) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['nev'], $_POST['leiras'], $_POST['ar']]);
    }

    $stmt = $dbh->query("SELECT * FROM pizzak ORDER BY id DESC");
    $pizzak = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) { 
    echo "Hiba: " . $e->getMessage(); 
}
?>

<h2>Pizzák kezelése (CRUD)</h2>

<table border="1" style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr style="background: #eee;">
        <th>Név</th>
        <th>Leírás</th>
        <th>Ár</th>
        <th>Művelet</th>
    </tr>
    <?php foreach($pizzak as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['nev']) ?></td>
        <td><?= htmlspecialchars($p['leiras']) ?></td>
        <td><?= $p['ar'] ?> Ft</td>
        <td>
            <form method="POST" style="margin: 0;">
                <input type="hidden" name="delete_id" value="<?= $p['id'] ?>">
                <button type="submit" onclick="return confirm('Biztos törlöd?')">Törlés</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<hr>

<h3>Új pizza felvétele</h3>
<form method="POST" style="background: #f9f9f9; padding: 15px; border: 1px solid #ccc;">
    <label>Név:</label><br>
    <input type="text" name="nev" required style="width: 100%;"><br><br>
    
    <label>Leírás:</label><br>
    <textarea name="leiras" required style="width: 100%;"></textarea><br><br>
    
    <label>Ár (Ft):</label><br>
    <input type="number" name="ar" required><br><br>
    
    <button type="submit" name="uj_pizza">Mentés az adatbázisba</button>
</form>