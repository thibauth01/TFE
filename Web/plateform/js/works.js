
function removeWorkFreeRequester(elem){
    var row= $(elem).parent().parent();
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
                    'id':id
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travail supprimé !',
                    'success'
                ).then((result) => {
                    $(row).remove();
                    $('#detailFree'+id).remove();
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

function removeWorkTakeRequester(elem){
    var row= $(elem).parent().parent();
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
                    'id':id
                }
            }).done(function(data) {
                Swal.fire(
                    'Voila !',
                    'Travail supprimé !',
                    'success'
                ).then((result) => {
                    $(row).remove();
                    $('#detailTake'+id).remove();
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
