//script de modification et de suppression des sites :

    function modificationSite(elementModificationSite) {

        var elementInputNomSite = elementModificationSite.parentNode.parentNode.querySelector('.inputNomSite');

        elementInputNomSite.disabled = false;

            elementInputNomSite.addEventListener('focus', function() {

                elementModificationSite.innerHTML = "<input type='submit' class='enregistrerSite' value='Enregistrer' onclick='enregistrerModifSite'>"

        });

        elementInputNomSite.addEventListener('blur', function() {

            elementInputNomSite.disabled = true;
            elementModificationSite.innerHTML = "Modifier"

        });

    }

function enregistrerModifSite (){

    //à compléter
}

function ajouterSite () {

    var inputAjout = document.getElementById('nomSite');

    var siteAAjouter = inputAjout.value;

    var enfant = inputAjout.parentNode.parentNode.parentNode.querySelector('ligneVille');

    var derniereLigneSite = inputAjout.parentNode.parentNode.parentNode.querySelector('ligneVille').cloneNode(true);


function insertAfter(derniereLigneSite, enfant) {

    //a compléter

}



}




// script de modification et suppression des villes :

function modificationVille(elementModificationVille) {

    var elementInputNomVille = elementModificationVille.parentNode.parentNode.querySelector('.inputNomVille');
    var elementInputCodePostalVille = elementModificationVille.parentNode.parentNode.querySelector('.inputCodePostalVille');


    elementInputNomVille.disabled = false;
    elementInputCodePostalVille.disabled = false;


    elementInputNomVille.addEventListener('focus', function () {

        elementModificationVille.innerHTML = "<input type='submit' class= 'enregistrerVille' value='Enregistrer' onclick='enregistrerModifVille'>"

    });

    elementInputNomVille.addEventListener('blur', function () {

        elementInputNomVille.disabled = true;
        elementInputCodePostalVille.disabled = true;
        elementModificationVille.innerHTML = "Modifier"

    });

    elementInputCodePostalVille.addEventListener('focus', function () {

        elementModificationVille.innerHTML = "<input type='submit' class='enregistrerVille' value='Enregistrer' onclick='enregistrerModifVille'>"

    });

    elementInputCodePostalVille.addEventListener('blur', function () {

        elementInputNomVille.disabled = true;
        elementInputCodePostalVille.disabled = true;
        elementModificationVille.innerHTML = "Modifier"

    });

}

function enregistrerModifVille (){

    //à compléter
}


