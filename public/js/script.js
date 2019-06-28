//script de modification et de suppression des sites :

    function modificationSite(elementModificationSite) {

        var elementInputNomSite = elementModificationSite.parentNode.parentNode.querySelector('.inputNomSite');

        elementInputNomSite.disabled = false;

            elementInputNomSite.addEventListener('focus', function() {

                elementModificationSite.innerHTML = "<input type='submit' value='Enregistrer'>"

        });

        elementInputNomSite.addEventListener('blur', function() {

            elementInputNomSite.disabled = true;
            elementModificationSite.innerHTML = "Modifier"

        });

    }

// script de modification et suppression des villes :

function modificationVille(elementModificationVille) {

    var elementInputNomVille = elementModificationVille.parentNode.parentNode.querySelector('.inputNomVille');
    var elementInputCodePostalVille = elementModificationVille.parentNode.parentNode.querySelector('.inputCodePostalVille');


    elementInputNomVille.disabled = false;
    elementInputCodePostalVille.disabled = false;


    elementInputNomVille.addEventListener('focus', function () {

        elementModificationVille.innerHTML = "<input type='submit' value='Enregistrer'>"

    });

    elementInputNomVille.addEventListener('blur', function () {

        elementInputNomVille.disabled = true;
        elementInputCodePostalVille.disabled = true;
        elementModificationVille.innerHTML = "Modifier"

    });

    elementInputCodePostalVille.addEventListener('focus', function () {

        elementModificationVille.innerHTML = "<input type='submit' value='Enregistrer'>"

    });

    elementInputCodePostalVille.addEventListener('blur', function () {

        elementInputNomVille.disabled = true;
        elementInputCodePostalVille.disabled = true;
        elementModificationVille.innerHTML = "Modifier"

    });

}


