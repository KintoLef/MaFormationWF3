// récupération de la liste des connectés
setInterval('ajax(liste_membre_connecte)', 3333);

// récupération et affichage de tous les messages via un setInterval()
setInterval('ajax(message_tchat)', 2964)

// suppression de l'utilisateur sur le fichier pseudo.txt lors de la fermeture de la fenêtre
window.onbeforeunload = function(){
    ajax('liste_membre_connecte', 'retirer');
}

// enregistrement des messages lors de la validation (submit) du formulaire
document.getElementById('form').addEventListener('submit', function(event){
    event.preventDefault();
    ajax('postMessage', message.value);
    ajax('message_tchat');
    document.getElementById('message').value = '';
});

// enregistrement des messages lors de la validation du formulaire via la touche 'entrée'
document.addEventListener('keypress', function(event){
    if(event.keyCode == 13) // la touche entrée à un keyCode = 13
    {
        event.preventDefault();
        ajax('postMessage', message.value);
        ajax('message_tchat');
        document.getElementById('message').value = '';
    }
});

// déclaration de la fonction Ajax
function ajax(mode, arg = ''){
    if(typeof(mode) == 'object'){
        mode = mode.id;
        // si notre argument mode est de type objet, c'est que js ne récupère pas le texte normal de l'argument, mais la balise html qui possède cet id puisqu'il est possible de sélectionner un élément directement par son id. Du coup on pioche dedans pour ne récupérer que l'id (mode.id)
    }
    console.log('Mode: '+mode);

    var file = "ajax.php"; // le fichier cible
    var param = "mode="+mode+"&arg="+arg; // les paramètres à fournir sur ajax.php

    if(window.XMLHttpRequest)
        var xhttp = new XMLHttpRequest();
    else
        var xhttp = ActiveXObject('Microsoft.XMLHTTP');

    xhttp.open('POST', file, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200)
        {
            console.log(xhttp.responseText);
            var obj = JSON.parse(xhttp.responseText);
            console.log(obj);

            document.getElementById(mode).innerHTML = obj.resultat; // on place la réponse dans l'élément html dont l'id a été fourni dans l'argument "mode"
            document.getElementById(mode).scrollTop = message_tchat.scrollHeight; // permet de descendre le scroll pour voir les derniers messages / ou les derniers membres

        }
    }
    xhttp.send(param); // on envoi en fournissant les paramètres
}