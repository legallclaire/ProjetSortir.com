var elementModificationSite = document.getElementById('modificationSite');
var elementInputNomSite = document.getElementById('nomSite');

elementModificationSite.onclick = function modificationSite (){

    elementInputNomSite.disabled = false;

    elementInputNomSite.onclick = function () {

        elementModificationSite.innerHTML="Enregistrer";

    }


    }
