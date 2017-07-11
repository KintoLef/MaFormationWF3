<form action="" method="post">
    <div>
        <label for="nb">Valeur à Convertir</label>
        <input type="text" name="nb" id="nb"/>
    </div>
    <div>
        <label for="devise">Devise de retour</label>
        <select name="devise" id="devise">
            <option value="USD" selected>USD</option>
            <option value="EUR">EUR</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Convertir"/>
    </div>
</form>

<?php

if(!empty($_POST['nb']) && isset($_POST['devise']))
{
    $nb = $_POST['nb'];
    $devise = $_POST['devise'];

    if($devise == 'USD')
    {
        $resultat = $nb * 1.085965;
        echo '<p style="color: red;">Résultat: ' . $nb . ' euro = ' . $resultat . ' dollars américains<br />';
    }
    elseif($devise == 'EUR')
    {
        $resultat = $nb / 1.085965;
        echo '<p style="color: red;">Résultat: ' . $nb . ' dollars américains = ' . $resultat . ' euro<br />';
    }
}

?>