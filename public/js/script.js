//script de modification et de suppression des sites :

var elementLigneSite = document.getElementsByClassName('ligneSite');


for (var i=0; i<elementLigneSite.length; i++) {

        //var elementModificationSite = elementLigneSite[i].getElementsByClassName('modificationSite')[0];
       // var elementInputNomSite = elementLigneSite[i].getElementsByClassName("inputNomSite")[0];

    var elementInputNomSite = elementLigneSite[i].querySelector('.inputNomSite');
    var elementModificationSite = elementLigneSite[i].querySelector('.modificationSite');

        elementModificationSite.onclick = function modificationSite() {


            elementInputNomSite.disabled = false;

            elementInputNomSite.onclick = function () {

                elementModificationSite.innerHTML = "<input type='submit' value='Enregistrer'>";

            }

        }
}
// script de modification et suppression des villes :

var elementLigneVille = document.getElementsByClassName('ligneVille');

for (var j=0; j<elementLigneVille.length; j++) {

    var elementModificationVille =elementLigneVille[j].querySelector('.modificationVille');
    var elementInputNomVille = elementLigneVille[j].querySelector('.inputNomVille');
    var elementInputCodePostalVille = elementLigneVille[j].querySelector('.inputCodePostalVille');


    elementModificationVille.onclick = function modificationVille() {

        elementInputNomVille.disabled = false;
        elementInputCodePostalVille.disabled = false;


        function afficherBouttonEnregistrer() {

            elementModificationVille.innerHTML = "<input type='submit' value='Enregistrer'>";

        }

        elementInputNomVille.onclick = afficherBouttonEnregistrer();

        elementInputCodePostalVille.onclick = afficherBouttonEnregistrer();

    }
}