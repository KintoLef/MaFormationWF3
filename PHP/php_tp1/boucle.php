<h1>EX 3 - Boucles</h1>

<?php

    echo '<h3>Ex 3.1</h3><br />';
    for($i=1; $i<=100; $i++)
    {
        echo $i . " ";
    }

    echo '<h3>Ex 3.2</h3><br />';
    for($i=1; $i<=100; $i++)
    {
        if($i == 50)
        {
            echo '<span style="color: red;">' . $i . ' ' . '</span>';
        } else {
            echo $i . " ";
        }
    }

    echo '<h3>Ex 3.3</h3><br />';
    for($i=2000; $i>=1930; $i--)
    {
        echo $i . " ";
    }

?>