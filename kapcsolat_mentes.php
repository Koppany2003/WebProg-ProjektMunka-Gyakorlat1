<?php
if(empty($_POST['nev']) || empty($_POST['szoveg'])) {
    $uzenet = "Hiba: A név és az üzenet kitöltése kötelező!";
} else {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=pizza_db', 'root', '',
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        
        $kuldo = "Vendég";
        $bejelentkezett = 0;
        
        if(isset($_SESSION['login'])) {
            $kuldo = $_SESSION['csn'] . " " . $_SESSION['un'];
            $bejelentkezett = 1;
        } elseif(isset($_POST['nev']) && trim($_POST['nev']) != "") {
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
        $uzenet = "Hiba: ".$e->getMessage(); 
    }
}
?>