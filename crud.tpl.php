<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=pizza_db', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    if (isset($_GET['del'])) {
        $sth = $dbh->prepare("DELETE FROM pizzak WHERE id = :id");
        $sth->execute(array(':id' => $_GET['del']));
        header("Location: ?pizzak"); 
        exit;
    }

    if (isset($_POST['mentes'])) {
        if ($_POST['id'] > 0) {
            $sql = "UPDATE pizzak SET nev = :nev, leiras = :leiras, ar = :ar WHERE id = :id";
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':nev' => $_POST['nev'],
                ':leiras' => $_POST['leiras'],
                ':ar' => $_POST['ar'],
                ':id' => $_POST['id']
            ));
        } else {
            $sql = "INSERT INTO pizzak (nev, leiras, ar) VALUES (:nev, :leiras, :ar)";
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':nev' => $_POST['nev'],
                ':leiras' => $_POST['leiras'],
                ':ar' => $_POST['ar']
            ));
        }
        header("Location: ?pizzak"); 
        exit;
    }

    $edit_pizza = array('id' => 0, 'nev' => '', 'leiras' => '', 'ar' => '');
    if (isset($_GET['edit'])) {
        $sth = $dbh->prepare("SELECT * FROM pizzak WHERE id = :id");
        $sth->execute(array(':id' => $_GET['edit']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if ($row) $edit_pizza = $row;
    }

    $pizzak = $dbh->query("SELECT * FROM pizzak ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Hiba: " . $e->getMessage());
}
?>

<h2>Pizzák kezelése (CRUD)</h2>

<div style="background: #f8edeb; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
    <h3><?= $edit_pizza['id'] > 0 ? "Pizza módosítása (#".$edit_pizza['id'].")" : "Új pizza hozzáadása" ?></h3>
    <form action="?pizzak" method="post">
        <input type="hidden" name="id" value="<?= $edit_pizza['id'] ?>">
        
        <label>Pizza neve:</label><br>
        <input type="text" name="nev" value="<?= htmlspecialchars($edit_pizza['nev']) ?>"><br>
        
        <label>Leírás (Feltétek):</label><br>
        <input type="text" name="leiras" value="<?= htmlspecialchars($edit_pizza['leiras']) ?>"><br>
        
        <label>Ár (Ft):</label><br>
        <input type="number" name="ar" value="<?= $edit_pizza['ar'] ?>"><br><br>
        
        <input type="submit" name="mentes" value="Adatok mentése">
        <?php if($edit_pizza['id'] > 0): ?>
            <a href="?pizzak" style="margin-left:10px; color: #555;">Mégse</a>
        <?php endif; ?>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Név</th>
            <th>Leírás</th>
            <th>Ár</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pizzak as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><strong><?= htmlspecialchars($p['nev']) ?></strong></td>
            <td><?= htmlspecialchars($p['leiras']) ?></td>
            <td><?= number_format($p['ar'], 0, ',', ' ') ?> Ft</td>
            <td>
                <a href="?pizzak&edit=<?= $p['id'] ?>" style="background-color:#0d6efd; color:white; padding:5px 10px; text-decoration:none; border-radius:4px; font-weight:bold; margin-right:5px;">Edit</a>
                <a href="?pizzak&del=<?= $p['id'] ?>" style="background-color:#dc3545; color:white; padding:5px 10px; text-decoration:none; border-radius:4px; font-weight:bold;" onclick="return confirm('Biztosan törlöd?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>