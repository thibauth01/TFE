function myAlertBottom() {
    $(".myAlert-bottom").show();
    setTimeout(function() {
        $(".myAlert-bottom").hide();
    }, 10000);
}

function acceptWork(elem) {
    var row = $(elem).parent().parent();
    var id = row.attr('id').substring(7);

    Swal.fire({
        title: 'Voulez vous effectuer ce travail ?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui'

    }).then((result) => {
        if (result.value) {
            console.log(id);
            $.ajax({
                url: 'php/acceptWork.php',
                type: 'POST',
                data: {
                    'id': id
                }
            }).done(function(data) {
                if (!data) {
                    Swal.fire(
                        'Ce travail à déjà été attribué',
                        'Veuillez choisir un autre travail',
                        'error'
                    );
                } else {
                    Swal.fire(
                        'Voila !',
                        'Le travail vous à été accordé !',
                        'success'
                    ).then((result) => {
                        $(row).remove();
                        $('#detailsProp' + id).remove();
                        $('#nombreTravaux').html(Number($('#nombreTravaux').html() - 1));
                    });
                }



            }).fail(function(data) {
                Swal.fire(
                    'Impossible de vous accorder le travail !',
                    'Veuillez reessayer ou contacter le webmaster',
                    'error'
                );
            });
        }

    });
}


$(document).ready(function() {

    $('#addJobForm').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var id = $("#selectType option:selected").attr('id');
        formData.append('idType', id);

        $.ajax({
            url: 'php/addJob.php',
            type: 'post',
            async: false,
            data: formData,
            success: function(data) {
                console.log(data);
                data = JSON.parse(data);
                if (data == null) {
                    var html = `<div class="myAlert-bottom alert alert-info">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Job Ajouté !</strong> 
                            </div>`;
                    $("#errormsgSign").html(html);
                    myAlertBottom();
                    document.getElementById("addJobForm").reset();
                } else {
                    var html = "";
                    $.each(data, function(index, value) {
                        html += `<div class="myAlert-bottom alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>` + value + `</strong> 
                                </div>`;
                    });
                    $("#errormsgSign").html(html);
                    myAlertBottom();
                }

            },
            processData: false,
            contentType: false,
            cache: false
        });

    });
});