<h1>Kilépett:</h1>
<p>
    <strong>
        <?php 
        if(isset($data['csn']) && isset($data['un']) && isset($data['login'])) {
            echo $data['csn']." ".$data['un']." (".$data['login'].")";
        } else {
            echo "Sikeresen kijelentkeztél.";
        }
        ?>
    </strong>
</p>