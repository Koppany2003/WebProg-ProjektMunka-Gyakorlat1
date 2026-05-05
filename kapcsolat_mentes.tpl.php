<?php
// PHP SZERVER OLDALI ELLENŐRZÉS: Ha üres a név vagy a szöveg, megállítjuk!
if(empty($_POST['nev']) || empty($_POST['szoveg'])) {
    $uzenet = "Hiba: A név és az üzenet kitöltése kötelező!";
} else {
<div style="text-align: center; padding: 50px;">
    <?php if(isset($uzenet)): ?>
        <h2><?= $uzenet ?></h2>
    <?php else: ?>
        <h2>Ismeretlen hiba történt!</h2>
    <?php endif; ?>
    
    <p><a href="?kapcsolat" style="color: #e63946; font-weight: bold;">Vissza a kapcsolat oldalra</a></p>
    <p><a href="?uzenetek" style="color: #2a9d8f; font-weight: bold;">Beérkezett üzenetek megtekintése</a></p>
</div>
<div style="text-align: center; padding: 50px;">
    <?php if(isset($uzenet)): ?>
        <h2><?= $uzenet ?></h2>
    <?php else: ?>
        <h2>Hiba történt a visszajelzés során!</h2>
    <?php endif; ?>
    
    <div style="margin-top: 20px;">
        <p><a href="?kapcsolat" style="color: #e63946; font-weight: bold; text-decoration: none;">Vissza a kapcsolat oldalra</a></p>
        <p><a href="?uzenetek" style="color: #2a9d8f; font-weight: bold; text-decoration: none;">Beérkezett üzenetek megtekintése</a></p>
    </div>
</div>