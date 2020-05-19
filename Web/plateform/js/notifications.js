$(document).ready(function() {

    $.ajax({
        url: 'php/getNewNotifs.php',
        method: 'post',
        success: function(data) {
            data = JSON.parse(data);
            var html = "";

            if (data.length < 1) {
                $('#newNotif').html("Aucune nouvelle notification");

            } else {
                $.each(data, function(index, value) {
                    var dt = new Date(value.sendtime);
                    var month = Number(dt.getMonth()) + 1;
                    dt = dt.getDate() + "-" + month + "-" + dt.getFullYear();

                    html += `<div class="alert alert-` + value.type + `">
                                <button type="button" aria-hidden="true" class="close" onclick="readNotif(` + value.id + `,this)">
                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                </button>
                                <span>
                                     ` + value.content + ` | <b>` + dt + `</b></span>
                            </div>`;

                });

                $('#newNotif').html(html);

            }


        },
        error: function(data) {}

    });


    $.ajax({
        url: 'php/getOldNotifs.php',
        method: 'post',
        success: function(data) {
            data = JSON.parse(data);
            var html = "";

            $.each(data, function(index, value) {

                var dt = new Date(value.sendtime);
                var month = Number(dt.getMonth()) + 1;
                dt = dt.getDate() + "-" + month + "-" + dt.getFullYear();

                html += `<div class="alert alert-` + value.type + `">
                            <span>
                                    ` + value.content + ` | <b>` + dt + `</b></span>
                        </div>`;

            });

            $('#oldNotif').html(html);



        },
        error: function(data) {}

    });

});

function readNotif(idNotif, elem) {

    $.ajax({
        url: 'php/readNotif.php',
        method: 'post',
        data: { 'id': idNotif },
        success: function(data) {
            var parent = $(elem).parent();
            $(elem).remove();
            var currentOld = $("#oldNotif").html();
            var newOld = $(parent)[0].outerHTML + currentOld;
            $(parent).remove();
            $('#oldNotif').html(newOld);
        }
    })



}