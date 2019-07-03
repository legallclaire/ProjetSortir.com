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

    var derniereLigneSite = document.querySelector('.ligneSite').cloneNode(true);

    var tableau = document.getElementsByTagName('table');

   if (siteAAjouter!=="") {

       derniereLigneSite.value = siteAAjouter;

       tableau.insertBefore(derniereLigneSite, document.getElementById('derniereLigne'));

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

/*
Gestion de gererSorties :
 */
//affichage du second select (lieux) si on choisit une valeur dans le premier select (villes) :

$(document).ready(function() {
    $('#select-lieux').hide();
    $('#labelLieux').hide();
    $('#rue').hide();
    $('#labelRue').hide();
    $('#codePostal').hide();
    $('#labelCodePostal').hide();
    $('#latitude').hide();
    $('#labelLatitude').hide();
    $('#longitude').hide();
    $('#labelLongitude').hide();
    $('#iconeAjoutLieu').hide();

    $('#select-villes').on('change',(function() {
        $('#labelLieux').show();
        $('#select-lieux').show();
        $('#codePostal').show();
        $('#labelCodePostal').show();
        $('.optionLieux').remove();
        $('#iconeAjoutLieu').show();

        var idVilleSelectionnee = $('#select-villes option:selected').attr('id');

        $.ajax({
            type: "POST",
            url: "/sortir/public/gererSorties/villes",
            dataType: "json",
            data: {id_ville: idVilleSelectionnee},
            cache: false,
            success: function (data) {

                for(var i = 0 ; i < data.length ; i++) {
                    $lieu = data[i];
                    $('#select-lieux').append($('<option>', {
                        class: 'optionLieux',
                        id: $lieu['id'],
                        value: $lieu['nom'],
                        text: $lieu['nom']
                    }));
                }

                $('#codePostal').val($lieu['codePostal']);

            },
            error: function (response) {
                console.log(response);
            }
        });
    }))

})

//affichage des détails du lieu si on choisit un lieu :

$(document).ready(function() {
    $('#select-lieux').on('change',(function() {

        $('#rue').show();
        $('#labelRue').show();
        $('#latitude').show();
        $('#labelLatitude').show();
        $('#longitude').show();
        $('#labelLongitude').show();

    var idLieuSelectionne = $('#select-lieux option:selected').attr('id');


    $.ajax({
        type: "POST",
        url: "/sortir/public/gererSorties/lieux",
        dataType: "json",
        data: {id_lieu: idLieuSelectionne},
        cache: false,
        success: function (data) {

            for(var i = 0 ; i < data.length ; i++) {
                $lieu = data[i];

                $('#rue').val($lieu['rue']);
                $('#latitude').val($lieu['latitude']);
                $('#longitude').val($lieu['longitude']);

            }
        },
        error: function (response) {
            console.log(response);
        }
    });
    }))

})

//affichage du formulaire de l'ajout d'un lieu :

$(document).ready(function() {
    $('#iconeAjoutLieu').on('click',(function() {


        $('#select-lieux').hide();
        $('#labelLieux').hide();

        $('#iconeAjoutLieu').append("<h4> Ajouter un lieu :</h4>");
        $('h4').after("<label for='ajouterNomLieu' id='labelAjouterNomLieu'>Nom du Lieu :</label>");
        $('#labelAjouterNomLieu').append("<input type='text' id='ajouterNomLieu' name='ajouterNomLieu' required>");

        $('#ajouterNomLieu').after("<label for='ajouterRue' id='labelAjouterRue'>Rue :</label>");
        $('#labelAjouterRue').append("<input type='text' id='ajouterRue' name='ajouterRue' required>");

        $('#ajouterRue').after("<label for='ajouterLatitude' id='labelAjouterLatitude'>latitude :</label>");
        $('#labelAjouterLatitude').append("<input type='text' id='ajouterLatitude' name='ajouterLatitude'>");

        $('#ajouterLatitude').after("<label for='ajouterLongitude' id='labelAjouterLongitude'>longitude :</label>");
        $('#labelAjouterLongitude').append("<input type='text' id='ajouterLongitude' name='ajouterLongitude'>");


        var idVille =  $('#select-villes option:selected').attr('id');
        var nomLieu = $('#ajouterNomLieu').value();
        var rueLieu = $('#ajouterRue').value();
        var latitudeLieu = $('#ajouterLatitude').value();
        var longitudeLieu = $('#ajouterLongitude').value();


        $.ajax({
            type: "POST",
            url: "/sortir/public/ajouterLieu",
            dataType: "json",
            data: {idVille: idVille, nomLieu: nomLieu, rueLieu: rueLieu, latitudeLieu: latitudeLieu, longitudeLieu: longitudeLieu},
            cache: false,
            success: function (data) {


                $.notify("Le lieu" +data['nom']+ "a bien été ajouté");


            },
            error: function (response) {
            console.log(response);
        }
    });
}))

})


/*
Gestion de gererSites :
 */


//ajouter site :

$(document).ready(function() {
    $('#boutonAjouter').on('click',(function() {


        var site = $('#nomSite').val().trim();

        if (site="") {

            $("#nomSite").notify("Ce champ est obligatoire");

        }

        $.ajax({
            type: "POST",
            url: "sortir/public/admin/gererSites/ajoutSite",
            dataType: "json",
            data: {site: site},
            cache: false,
            success: function (data) {

                $.notify("Le site" +data+ "a bien été ajouté");
                //TODO : ajouter le site au tableau
            },
            error: function (data) {
                console.log(response);
            }
        });


    }))

})