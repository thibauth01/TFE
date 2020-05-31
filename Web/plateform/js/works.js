var rate = null;

function removeWorkFreeRequester(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Voulez-vous supprimer ce travail?',
        text: "Ce travail n'était pas encore attribué",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'


    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'php/removeJob.php',
                type: 'POST',
                data: {
                    'id': id,
                    'take': false
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travail supprimé !',
                    'success'
                ).then((result) => {
                    $(row).remove();
                    $('#detailFree' + id).remove();
                })


            }).fail(function(data) {
                Swal.fire(
                    'Impossible de supprimer le travail !',
                    'Veuillez reessayer ou contacter le webmaster',
                    'error'
                );
            });
        }

    });
}

function removeWorkTakeRequester(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Voulez-vous supprimer ce travail?',
        text: "Ce travail est déja attribué, le travailleur en sera prévenu !",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'


    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'php/removeJob.php',
                type: 'POST',
                data: {
                    'id': id,
                    'take': true
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travail supprimé!',
                    'success'
                ).then((result) => {
                    $(row).remove();
                    $('#detailTake' + id).remove();
                })


            }).fail(function(data) {
                Swal.fire(
                    'Impossible de supprimer le travail !',
                    'Veuillez reessayer ou contacter le webmaster',
                    'error'
                );
            });
        }

    });
}

function removeWorkWorker(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Vous ne souhaitez plus réaliser ce travail ?',
        text: " La personne en sera prevenue !",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'


    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'php/removeWorker.php',
                type: 'POST',
                data: {
                    'id': id
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travail enlevé !',
                    'success'
                ).then((result) => {
                    $(row).remove();
                    $('#detailTodo' + id).remove();
                })


            }).fail(function(data) {
                Swal.fire(
                    'Impossible d\'enlever le travail !',
                    'Veuillez reessayer ou contacter le webmaster',
                    'error'
                );
            });
        }

    });
}

function finishJob(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Marquer comme achevé?',
        text: "Ce travail est il terminé et payé ?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'


    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'php/finishJob.php',
                type: 'POST',
                data: {
                    'id': id
                }
            }).done(function(data) {
                let wrap = document.createElement('div');

                wrap.innerHTML = `<div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
                                        <label onclick="rate = 1;" aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input  class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
                                        <label onclick="rate = 2;" aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
                                        <label onclick="rate = 3;" aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
                                        <label onclick="rate = 4;" aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
                                        <label onclick="rate = 5;" aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
                                    </div>
                                </div>`;


                Swal.fire({
                    title: "Veuillez noter ce travailleur",
                    html: wrap,
                    preConfirm: () => {
                        return [
                            rate
                        ]
                    }

                }).then((result) => {
                    $.ajax({
                        url: 'php/rateWorker.php',
                        method: "post",
                        data: {
                            'id': id,
                            'rating': rate
                        }
                    }).done(function(data) {
                        Swal.fire(
                            'Voila !',
                            'Travail terminé!',
                            'success'
                        ).then((result) => {
                            $(row).remove();
                            $('#detailTake' + id).remove();
                            rate = null;
                        })
                    }).fail(function(data) {
                        Swal.fire(
                            'Impossible de noter le travailleur !',
                            'Veuillez reessayer ou contacter le webmaster',
                            'error'
                        );
                    });

                })



            }).fail(function(data) {
                Swal.fire(
                    'Impossible de finir le travail !',
                    'Veuillez reessayer ou contacter le webmaster',
                    'error'
                );
            });
        }

    });
}

function refuseWorker(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Supprimer ce travailleur ?',
        text: "vous souhaitez un autre travailleur?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'

    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'php/refuseWorker.php',
                type: 'POST',
                data: {
                    'id': id
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travailleur enlevé!',
                    'success'
                ).then((result) => {
                    console.log(data)
                    $(row).remove();
                    $('#detailTake' + id).remove();
                })


            }).fail(function(data) {
                Swal.fire(
                    'Impossible de supprimer le travailleur !',
                    'Veuillez reessayer ou contacter le webmaster',
                    'error'
                );
            });
        }

    });

}

$(document).ready(function() {



})