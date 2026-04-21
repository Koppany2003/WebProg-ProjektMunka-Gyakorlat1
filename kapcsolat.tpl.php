<h2>Kapcsolat</h2>
<p>Ügyvezető: <strong>Valaki Az</strong></p>
<p>E-mail: <strong>valaki.az@minihonlap.hu</strong></p>

<hr>

<h3>Írj nekünk üzenetet!</h3>

<script>
function ellenoriz() {
    var nev = document.getElementById("nev").value;
    var szoveg = document.getElementById("szoveg").value;
    
    if (nev.trim() == "" || szoveg.trim() == "") {
        alert("A név és az üzenet kitöltése kötelező!");
        return false;
    }
    return true;
}
</script>

<form action="kapcsolat_mentes" method="post" onsubmit="return ellenoriz();">
    <label>Név (kötelező):</label><br>
    <input type="text" id="nev" name="nev"><br><br>
    
    <label>E-mail (opcionális):</label><br>
    <input type="text" name="email"><br><br>
    
    <label>Üzenet (kötelező):</label><br>
    <textarea id="szoveg" name="szoveg" rows="5" style="width:100%"></textarea><br><br>
    
    <input type="submit" value="Üzenet elküldése">
</form>