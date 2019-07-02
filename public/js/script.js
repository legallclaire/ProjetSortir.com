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


        $('.d-flex justify-content-around').hide();

        $('h1').append("<h4> Ajouter un lieu :</h4>");
        $('h4').append("<label for='ajouterNomLieu' id='labelAjouterNomLieu'>Nom du Lieu</label>");
        $('#labelAjouterNomLieu').append("<input type='text' id='ajouterNomLieu' name='ajouterNomLieu'>");

        var nomLieu = $('#ajouterNomLieu').value();


        $.ajax({
            type: "POST",
            url: "/sortir/public/ajouterLieu",
            dataType: "json",
            data: {nom_lieu: nomLieu},
            cache: false,
            success: function (data) {

                    $nomLieu = data;

                    $('h4').append("<p>Votre lieu a été ajouté</p>");


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

//requête de recherche de sites :
// $(document).ready(function(){
//     $('#boutonRecherche').on('click', rechercherSites());
// }
//
//     function rechercherSites() {
//         $.ajax({
//             type: "GET",
//             url: "/admin/gererSites/recherche",
//             dataType: "json",
//             data: {search: $("#searchSites").val()},
//             cache: false,
//             success: function (response) {
//                 // $('.sites').html(response.classifiedList);
//                 // $('.inputNomSite').hide();
//                 console.log(response);
//             },
//             error: function (response) {
//                 console.log(response);
//             }
//         });
//
//     }
