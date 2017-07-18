document.getElementById('form').addEventListener('submit', function(event){
    event.preventDefault();

    ajax();
});

function ajax(){
    var file = 'ajax_connexion.php';

    if(window.XMLHttpRequest)
        var xhttp = new XMLHttpRequest();
    else
        var xhttp = ActiveXObject('Microsoft.XMLHTTP');
    
    // on récupère la valeur des différents champs
    var p = document.getElementById('pseudo');
    var pseudo = p.value;
    console.log('Pseudo: '+pseudo);

    var s = document.getElementById('sexe');
    var sexe = s.value;
    console.log('Sexe: '+sexe);

    var v = document.getElementById('ville');
    var ville = v.value;
    console.log('Ville: '+ville);

    var dn = document.getElementById('date_naissance');
    var date_naissance = dn.value;
    console.log('Date de naissance: '+date_naissance);

    // paramètres
    var param = "mode=connexion&pseudo="+pseudo+"&sexe="+sexe+"&ville="+ville+"&date_naissance="+date_naissance;
    console.log(param);

    xhttp.open('POST', file, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200)
        {
            console.log(xhttp.responseText);
            var connexion = JSON.parse(xhttp.responseText);
            // .resultat correspond à l'indice défini en php sur ajax.php                    
            document.getElementById('message').innerHTML = connexion.resultat;

            if(connexion.pseudo == 'disponible')
            {
                // si on entre dans cette condition alors on sait qu'il n'y a pas eu d'erreur et on redirige sur dialogue.php
                window.location.href = 'dialogue.php';
            }
        }
    }
    xhttp.send(param);
}