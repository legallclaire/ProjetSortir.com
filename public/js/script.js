//script de modification et de suppression des sites :

    // function modificationSite(elementModificationSite) {
    //
    //     var elementInputNomSite = elementModificationSite.parentNode.parentNode.querySelector('.inputNomSite');
    //
    //     elementInputNomSite.disabled = false;
    //
    //         elementInputNomSite.addEventListener('focus', function() {
    //
    //             elementModificationSite.innerHTML = "<button type='submit' id='enregistrerSite' value='Enregistrer' onclick='enregistrerModifSite' class='btn btn-success'>Enregistrer</button>"
    //
    //     });
    //
    //     elementInputNomSite.addEventListener('blur', function() {
    //
    //         elementInputNomSite.disabled = true;
    //         elementModificationSite.innerHTML = "<button type='submit' id='enregistrerSite' value='Modifier' onclick='enregistrerModifSite' class='btn btn-warning'>Modifier</button>"
    //
    //     });
    //
    // }

// function enregistrerModifSite (){
//
//     //à compléter
// }

// function ajouterSite () {
//
//     var inputAjout = document.getElementById('nomSite');
//
//     var siteAAjouter = inputAjout.value;
//
//     var derniereLigneSite = document.querySelector('.ligneSite').cloneNode(true);
//
//     var tableau = document.getElementsByTagName('table');
//
//    if (siteAAjouter!=="") {
//
//        derniereLigneSite.value = siteAAjouter;
//
//        tableau.insertBefore(derniereLigneSite, document.getElementById('derniereLigne'));
//
//    }
//
// }


// script de modification et suppression des villes :

function modificationVille(elementModificationVille) {

    var elementInputNomVille = elementModificationVille.parentNode.parentNode.querySelector('.inputNomVille');
    var elementInputCodePostalVille = elementModificationVille.parentNode.parentNode.querySelector('.inputCodePostalVille');


    elementInputNomVille.disabled = false;
    elementInputCodePostalVille.disabled = false;


    elementInputNomVille.addEventListener('focus', function () {

        elementModificationVille.innerHTML = "<input type='submit' class= 'enregistrerVille btn btn-info' value='Enregistrer' onclick='enregistrerModifVille'>"

    });

    elementInputNomVille.addEventListener('blur', function () {

        elementInputNomVille.disabled = true;
        elementInputCodePostalVille.disabled = true;
        elementModificationVille.innerHTML = "Modifier"

    });

    elementInputCodePostalVille.addEventListener('focus', function () {

        elementModificationVille.innerHTML = "<input type='submit' class='enregistrerVille btn btn-info' value='Enregistrer' onclick='enregistrerModifVille'>"

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
        $('h4').after("<label for='ajouterNomLieu' id='labelAjouterNomLieu' class='col-form-label'>Nom du Lieu :</label>");
        $('#labelAjouterNomLieu').append("<input type='text' id='ajouterNomLieu' name='ajouterNomLieu' class='form-control' required>");

        $('#ajouterNomLieu').after("<label for='ajouterRue' id='labelAjouterRue' class='col-form-label'>Rue :</label>");
        $('#labelAjouterRue').append("<input type='text' id='ajouterRue' name='ajouterRue' class='form-control' required>");

        $('#ajouterRue').after("<label for='ajouterLatitude' id='labelAjouterLatitude' class='col-form-label'>latitude :</label>");
        $('#labelAjouterLatitude').append("<input type='text' id='ajouterLatitude' name='ajouterLatitude' class='form-control'>");

        $('#ajouterLatitude').after("<label for='ajouterLongitude' id='labelAjouterLongitude' class='col-form-label'>longitude :</label>");
        $('#labelAjouterLongitude').append("<input type='text' id='ajouterLongitude' name='ajouterLongitude' class='form-control'>");


        var idVille =  $('#select-villes option:selected').attr('id');
        var nomLieu = $('#ajouterNomLieu').val();
        var rueLieu = $('#ajouterRue').val();
        var latitudeLieu = $('#ajouterLatitude').val();
        var longitudeLieu = $('#ajouterLongitude').val();

        // $('#iconeAjoutLieu').on('click',(function() {
        //
        //     $('#iconeAjoutLieu').hide();
        //     $('h4').hide();
        //     $('#labelAjouterNomLieu').hide();
        //     $('#ajouterNomLieu').hide();
        //     $('#labelAjouterRue').hide();
        //     $('#ajouterRue').hide();
        //     $('#labeljouterLatitude').hide();
        //     $('#ajouterLatitude').hide();
        //     $('#labeljouterLongitude').hide();
        //     $('#ajouterLongitude').hide();
        //
        // }))

        $.ajax({
            type: "POST",
            url: "/sortir/public/ajouterLieu",
            dataType: "json",
            data: {idVille: idVille, nomLieu: nomLieu, rueLieu: rueLieu, latitudeLieu: latitudeLieu, longitudeLieu: longitudeLieu},
            cache: false,
            success: function (data) {


                $.notify("Le lieu" +data['nom']+ "a bien été ajouté");


            },
            error: function (data) {
                $.notify("Echec de l'ajout");
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

        $('#nomSite').prop('required',true);



        var site = $('#nomSite').val().trim();

        if (site==="") {

            $.notify("Ce champ est obligatoire");

        }

        $.ajax({
            type: "POST",
            url: "/sortir/public/admin/gererSites/ajoutSite",
            dataType: "json",
            data: {site: site},
            cache: false,
            success: function (data) {


                $.notify("Ajout effectué")
            },
            error: function (data) {
                console.log(data);
            }
        });

    }))

})

//modifier site sur la page de gestion des sites :

$(document).ready(function() {
    $('.btn.btn-warning').on('click',(function() {

        var inputSite = $(this).parent().parent().find('input[type=text]');
        inputSite.prop('disabled', false);
        $(this).replaceWith("<button type='submit' id='boutonEnregistrer' value='Enregistrer' class='btn btn-success'>Enregistrer</button>");


        $('#boutonEnregistrer').on('click', function() {

            var inputSite = $(this).parent().parent().find('input[type=text]');
            var valeurSite = inputSite.val();
            var idSite =inputSite.attr('name');

            $.ajax({
                type: "POST",
                url: "/sortir/public/admin/gererSites/modifierSite",
                dataType: "json",
                data: {valeurSite: valeurSite, idSite: idSite},
                cache: false,
                success: function (data) {


                    $.notify("Modification effectué")
                },
                error: function (data) {
                    console.log(data);
                }
            });
        })

    }))

})


//suppression site sur la page de gestion des sites :
$(document).ready(function() {
$('.btn.btn-danger').on('click',(function() {

    var inputSite = $(this).parent().parent().find('input[type=text]');
    var valeurSite = inputSite.val();
    var idSite =inputSite.attr('name');

    $.ajax({
        type: "POST",
        url: "/sortir/public/admin/gererSites/supprimerSite",
        dataType: "json",
        data: {valeurSite: valeurSite, idSite: idSite},
        cache: false,
        success: function (data) {


            $.notify("Modification effectué")
        },
        error: function (data) {
            console.log(data);
        }
    });


}))
})

/*
Gestion de gererVilles :
 */

//ajouter ville :

$(document).ready(function() {
    $('#boutonAjouterVille').on('click',(function() {

        $('#nomVille').prop('required',true);
        $('#codePostalVille').prop('required',true);


        var nomVille = $('#nomVille').val().trim();
        var codePostal = $('#codePostalVille').val().trim();

        if (nomVille==="") {

            $.notify("Ce champ est obligatoire");

        }

        if (codePostal==="") {

            $.notify("Ce champ est obligatoire");

        }

        $.ajax({
            type: "POST",
            url: "/sortir/public/admin/gererVilles/ajoutVille",
            dataType: "json",
            data: {nomVille: nomVille, codePostal: codePostal },
            cache: false,
            success: function (data) {


                $.notify("Ajout effectué")
            },
            error: function (data) {
                console.log(data);
            }
        });

    }))

})



// Filtrer affichage sortie avec checkbox

function checkboxFiltre() {
    var checkBoxUser = document.getElementById("SortiesOrganisateur");
    var table = document.getElementById("sortieTable");
    var tr = table.getElementsByTagName("tr");
    var nomUtilisateur = document.getElementById("nom_user");
    var i;
    var td;


    if (checkBoxUser.checked === true){
        for (i=0; i<tr.length; i++){
            td = tr[i].getElementsByTagName("td")[6];
            if (td){
                if (td.innerText === nomUtilisateur.innerText){
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }

        }
    }

    if (checkBoxUser.checked === false) {
        for (i=0; i<tr.length; i++){
            td = tr[i].getElementsByTagName("td")[6];
            if (td){
                tr[i].style.display = "";

            }

        }
    }

}


// s'inscrire à une sortie (AJAX) :


$(document).ready(function() {
    $('input[name=boutonInscription]').click(function() {

        var idSortie = $(this).attr('id');


        $.ajax({
            type: "POST",
            url: "/sortir/public/inscription",
            dataType: "json",
            data: {id: idSortie},
            cache: false,
            success: function (data) {


                $.notify("modification effectuée")
            },
            error: function (data) {
                console.log(data);
            }
        });


    })

})

// se désister (AJAX):

$(document).ready(function() {
    $('input[name=boutonDesistement]').click(function() {

        var idSortie = $(this).attr('id');

        if (confirm('Etes-vous sûr de vouloir vous désinscrire de cette sortie ?')) {

            $.ajax({
                type: "POST",
                url: "/sortir/public/desinscription",
                dataType: "json",
                data: {id: idSortie},
                cache: false,
                success: function (data) {


                    $.notify("modification effectué")
                },
                error: function (data) {
                    console.log(data);
                }
            });

        }
    })

})

// annuler une sortie (AJAX) :

$(document).ready(function() {
    $('input[name=boutonAnnuler]').click(function() {


        if (confirm('Etes-vous sûr de vouloir supprimer cette sortie ?')) {


            var idSortie = $(this).attr('id');


            $.ajax({
                type: "POST",
                url: "/sortir/public/annulation",
                dataType: "json",
                data: {id: idSortie},
                cache: false,
                success: function (data) {


                    $.notify("modification effectué")
                },
                error: function (data) {
                    console.log(data);
                }


            });

        }
    })

})

// publier une sortie (AJAX) :

$(document).ready(function() {
    $('input[name=boutonPublier]').click(function() {


        var idSortie = $(this).attr('id');


        $.ajax({
            type: "POST",
            url: "/sortir/public/publier",
            dataType: "json",
            data: {id: idSortie},
            cache: false,
            success: function (data) {


                $.notify("modification effectué")
            },
            error: function (data) {
                console.log(data);
            }


        });


    })

})