<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ajax Connexion</title>
    </head>
    <body>
        <form method="post" action="" id="connect">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo">

            <label for="mdp">Mot de passe</label>
            <input type="text" id="mdp" name="mdp">

            <input type="submit" value="Connexion">
        </form>
        <hr>
        <div id="resultat">

        </div>
        <script>
            document.getElementById('connect').addEventListener('submit', function(event){
                event.preventDefault();

                ajax();
            });

            function ajax(){
                var file = 'ajax.php';

                if(window.XMLHttpRequest)
                    var xhttp = new XMLHttpRequest();
                else
                    var xhttp = ActiveXObject('Microsoft.XMLHTTP');
                
                // on récupère la valeur du champ pseudo
                var p = document.getElementById('pseudo');
                var pseudo = p.value;
                console.log('Pseudo: '+pseudo);

                // Même chose avec le mot de passe
                var m = document.getElementById('mdp');
                var mdp = m.value;
                console.log('Mot de passe: '+mdp);

                // paramètres
                var param = "pseudo="+pseudo+"&mdp="+mdp;
                console.log(param);

                xhttp.open('POST', file, true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhttp.onreadystatechange = function(){
                    if(xhttp.readyState == 4 && xhttp.status == 200)
                    {
                        console.log(xhttp.responseText);
                        var result = JSON.parse(xhttp.responseText)
                        // .resultat correspond à l'indice défini en php sur ajax.php                    
                        document.getElementById('resultat').innerHTML = result.resultat;
                    }
                }
                xhttp.send(param);
            }
        </script>
    </body>
</html>