// fonction qui permet de changer de page et d'envoyer des données avec $_POST
function post(path, params) {

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

// cette fonction qui retourne un clone de id 
		// id est une chaine de caractère contenant l'id ou un objet js représentant l'élément
		// cela clone aussi toute la gestion évenementielle de l'élément
function clone_ligne(id)
{
		return $(id).clone(true);
}
