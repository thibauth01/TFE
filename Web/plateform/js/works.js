function removeWorkFreeRequester(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Voulez-vous supprimer ce travail?',
        text: "Ce travail n'était pas encore attribué",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui'

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
        confirmButtonText: 'Oui'

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
        confirmButtonText: 'Oui'

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
        confirmButtonText: 'Oui'

    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'php/finishJob.php',
                type: 'POST',
                data: {
                    'id': id
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travail terminé!',
                    'success'
                ).then((result) => {
                    $(row).remove();
                    $('#detailTake' + id).remove();
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
        confirmButtonText: 'Oui'

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