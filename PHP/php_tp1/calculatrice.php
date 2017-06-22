<h1>EX 4 - Calculatrice</h1>

<?php

echo '<pre>'; print_r($_POST); echo '</pre>';

if(!empty($_POST['nb1']) && !empty($_POST['nb2']) && isset($_POST['operateur']))
{
    $nb1 = $_POST['nb1'];
    $nb2 = $_POST['nb2'];
    $op = $_POST['operateur'];

    if($op == '+')
    {
        $resultat = $nb1 + $nb2;
        echo '<p>Résultat: ' . $resultat . '<br />';
    } elseif($op == '-')
    {
        $resultat = $nb1 - $nb2;
        echo '<p>Résultat: ' . $resultat . '<br />';
    } elseif($op == '*')
    {
        $resultat = $nb1 * $nb2;
        echo '<p>Résultat: ' . $resultat . '<br />';
    } elseif($op == '/')
    {
        $resultat = $nb1 / $nb2;
        echo '<p>Résultat: ' . $resultat . '<br />';
    }
}

?>


<form action="" method="post">
    <div>
        <input type="text" name="nb1" id="nb1"/>
    </div>
    <div>
        <select name="operateur" id="operateur">
            <option value="+" selected>+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
    </div>
    <div>
        <input type="text" name="nb2" id="nb2"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Calculer"/>
    </div>
</form>


