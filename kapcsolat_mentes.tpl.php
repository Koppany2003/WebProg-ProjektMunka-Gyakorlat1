<?php
$uzenet = "";
$hiba = "";

if(isset($_POST['szoveg']) && isset($_POST['nev'])) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=dmebalzs', 'dmebalzs', '67Balazs82.', 
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $kuldo = "Vendég";
        $bejelentkezett = 0;

        if(isset($_SESSION['login'])) {
            $kuldo = $_SESSION['csn'] . " " . $_SESSION['un'];
            $bejelentkezett = 1;
        } elseif(trim($_POST['nev']) != "") {
            $kuldo = trim($_POST['nev']);
        }

        $sqlInsert = "INSERT INTO uzenetek(kuldo_neve, email_cim, uzenet_szovege, bejelentkezett_kuldte) 
                      VALUES(:nev, :email, :szoveg, :bej)";
        $stmt = $dbh->prepare($sqlInsert); 
        $stmt->execute(array(
            ':nev' => $kuldo, 
            ':email' => $_POST['email'], 
            ':szoveg' => $_POST['szoveg'],
            ':bej' => $bejelentkezett
        )); 

        $uzenet = "Köszönjük az üzenetet!";
    } catch (PDOException $e) { 
        $hiba = "Hiba történt a mentéskor: " . $e->getMessage(); 
    }
} else {
    $hiba = "Hiányzó adatok az űrlapról!";
}
?>

<div style="text-align: center; padding: 50px;">
    <?php if($hiba != ""): ?>
        <h2 style="color: red;"><?= $hiba ?></h2>
    <?php else: ?>
        <h2 style="color: green;"><?= $uzenet ?></h2>
        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; display: inline-block; text-align: left; margin-top: 10px;">
            <p><strong>Név:</strong> <?= htmlspecialchars($kuldo) ?></p>
            <p><strong>E-mail:</strong> <?= htmlspecialchars($_POST['email'] ?? '-') ?></p>
            <p><strong>Üzenet:</strong><br><?= nl2br(htmlspecialchars($_POST['szoveg'])) ?></p>
        </div>
    <?php endif; ?>
    
    <div style="margin-top: 20px;">
        <p><a href="?kapcsolat" style="color: #e63946; font-weight: bold; text-decoration: none;">Vissza a kapcsolat oldalra</a></p>
        <p><a href="?uzenetek" style="color: #2a9d8f; font-weight: bold; text-decoration: none;">Beérkezett üzenetek megtekintése</a></p>
    </div>
</div>