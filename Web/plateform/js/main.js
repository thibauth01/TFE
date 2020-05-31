var page;
$(document).ready(function() {

    var path = window.location.pathname;
    page = path.split("/").pop();

    getMessagesSide();

    setInterval(function() {
        getMessagesSide();
    }, 3000);




    $('.rating1').starRating({
        readOnly: true,
        starSize: 20,
        starShape: 'rounded',
        initialRating: 1
    });

    $('.rating2').starRating({
        readOnly: true,
        starSize: 20,
        starShape: 'rounded',
        initialRating: 2
    });

    $('.rating3').starRating({
        readOnly: true,
        starSize: 20,
        starShape: 'rounded',
        initialRating: 3
    });

    $('.rating4').starRating({
        readOnly: true,
        starSize: 20,
        starShape: 'rounded',
        initialRating: 4
    });

    $('.rating5').starRating({
        readOnly: true,
        starSize: 20,
        starShape: 'rounded',
        initialRating: 5
    });

});

function getMessagesSide() {
    $.ajax({
        url: 'php/actualiseSideBar.php',
        method: 'post',
        success: function(data) {
            data = JSON.parse(data);
            if (Number(data.messages) > 0) {
                $("#sideMessage").html(Number(data.messages));
            } else {
                $("#sideMessage").html("");
            }

            if (Number(data.notifications) > 0) {
                $("#sideNotifications").html(Number(data.notifications));
            } else {
                $("#sideNotifications").html("");
            }
        }
    });
}