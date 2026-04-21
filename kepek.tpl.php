<h2>Képgaléria</h2>
<?php if(isset($_SESSION['login'])): ?>
    <fieldset>
        <legend>Kép feltöltése</legend>
        <form action="kepfeltoltes" method="post" enctype="multipart/form-data">
            <input type="file" name="kep" required>
            <input type="submit" value="Feltöltés">
        </form>
    </fieldset>
<?php endif; ?>

<div class="galeria" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px;">
    <?php
    $kepek = glob("images/upload/*.{jpg,png,gif}", GLOB_BRACE);
    foreach($kepek as $kep) {
        echo '<img src="'.$kep.'" style="width:200px; border-radius:5px;">';
    }
    ?>
</div>