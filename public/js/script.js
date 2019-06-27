//script de modification et de suppression des sites :

var elementModificationSite = document.getElementById('modificationSite');
var elementInputNomSite = document.getElementById('nomSite');

elementModificationSite.onclick = function modificationSite (){

    elementInputNomSite.disabled = false;

    elementInputNomSite.onclick = function () {

        elementModificationSite.innerHTML="<input type='submit' value='Enregistrer'>";

    }

    }

// script de modification et suppression des sites :

var elementModificationVille = document.getElementById('modificationVille');
var elementInputNomVille = document.getElementById('nomVille');
var elementInputCodePostalVille = document.getElementById("codePostal")

elementModificationVille.onclick = function modificationVille () {

    elementInputNomVille.disabled = false;
    elementInputCodePostalVille.disabled = false;

}
    function afficherBouttonEnregistrer () {

        elementModificationVille.innerHTML="<input type='submit' value='Enregistrer'>";

    }

    elementInputNomVille.onclick = afficherBouttonEnregistrer();

    elementInputCodePostalVille.onclick = afficherBouttonEnregistrer();

