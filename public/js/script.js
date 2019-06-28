//script de modification et de suppression des sites :

var elementLigneSite = document.getElementsByClassName('ligneSite');


for (var i=0; i<elementLigneSite.length; i++) {

        //var elementModificationSite = elementLigneSite[i].getElementsByClassName('modificationSite')[0];
       // var elementInputNomSite = elementLigneSite[i].getElementsByClassName("inputNomSite")[0];

    var elementModificationSite = elementLigneSite[i].querySelector('td input');

        elementModificationSite.onclick = function modificationSite() {


            elementInputNomSite.disabled = false;

            elementInputNomSite.onclick = function () {

                elementModificationSite.innerHTML = "<input type='submit' value='Enregistrer'>";

            }

        }
}
// script de modification et suppression des villes :

var elementModificationVille = document.getElementById('modificationVille');
var elementInputNomVille = document.getElementById('caseNomVille').firstElementChild;
var elementInputCodePostalVille = document.getElementById('caseCodePostalVille').firstElementChild;

elementModificationVille.onclick = function modificationVille () {

    elementInputNomVille.disabled = false;
    elementInputCodePostalVille.disabled = false;


    function afficherBouttonEnregistrer () {

        elementModificationVille.innerHTML="<input type='submit' value='Enregistrer'>";

    }

    elementInputNomVille.onclick = afficherBouttonEnregistrer();

    elementInputCodePostalVille.onclick = afficherBouttonEnregistrer();

}