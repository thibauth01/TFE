const monthNames = ["Janv", "Fevr", "Mars", "Avr", "Mai", "Juin",
    "Juil", "Aout", "Sept", "Oct", "Nov", "Dec"
];

var currentConv;
var timerConv;
var numberMessages;

function stopInterval() {
    clearInterval(timerConv);
}

function getMessages(idWork) {
    numberMessages = 0;
    stopInterval();
    numberMessages = countMessages(idWork);
    getMessage(idWork);

    timerConv = setInterval(function() {
        var count = countMessages(idWork);
        if (count != numberMessages) {
            getMessage(idWork);
            numberMessages = count;
        }
    }, 5000);
}

function countMessages(idWork) {
    var toreturn;
    $.ajax({
        url: 'php/numberMessages.php',
        type: 'post',
        data: { idWork: idWork },
        success: function(data) {
            data = JSON.parse(data);
            toreturn = data.count;
        },
        async: false

    })
    return toreturn;

}

function getMessage(idWork) {
    $.ajax({
        type: 'post',
        url: 'php/getMessages.php',
        data: { 'id': idWork },
        success: function(data) {
            data = JSON.parse(data);
            var idSender = data.idTypeAccount;
            var html = "";

            currentConv = idWork;
            if (data.messages.length <= 0) {
                html = "Aucun Message"
            } else {

                $.each(data.messages, function(index, value) {
                    var date = new Date(value.sendtime);
                    var showDate = date.getHours() + ":" + date.getMinutes() + " | " + monthNames[date.getMonth()] + " " + date.getDate();

                    if (value.id_sender == idSender) {
                        html += `<div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white">` + value.content + `</p>
                                        </div>
                                        <p class="small text-muted">` + showDate + `</p>
                                    </div>
                                </div>`;
                    } else {
                        html += `<div class="media w-50 mb-3">
                                    <div class="media-body ">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-muted">` + value.content + `</p>
                                        </div>
                                        <p class="small text-muted">` + showDate + `</p>
                                    </div>
                                </div>`;
                    }
                });
            }

            $("#chatBox").html(html);

            var scroll = document.getElementById('chatBox');
            scroll.scrollTop = scroll.scrollHeight;
        }
    });




}

function sendMessage() {
    var text = $("#textareaSend").val();

    $.ajax({
        url: 'php/sendMessage.php',
        type: 'post',
        data: {
            idWork: currentConv,
            text: text
        },
        success: function(data) {
            $("#formSendMessage")[0].reset()
            var current = $("#chatBox").html();
            if (current == "Aucun Message") {
                current = "";
            }
            var date = new Date();
            var showDate = date.getHours() + ":" + date.getMinutes() + " | " + monthNames[date.getMonth()] + " " + date.getDate();
            current += `<div class="media w-50 ml-auto mb-3">
                            <div class="media-body">
                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                    <p class="text-small mb-0 text-white">` + text + `</p>
                                </div>
                                <p class="small text-muted">` + showDate + `</p>
                            </div>
                        </div>`;
            $("#chatBox").html(current);
            var scroll = document.getElementById('chatBox');
            scroll.scrollTop = scroll.scrollHeight;
        }
    })
}

function getConv() {
    var html = "";
    $.ajax({
        url: 'php/actualiseConv.php',
        method: 'post',
        success: function(data) {
            html += data;
        },
        async: false
    })
    return html
}

$(document).ready(function() {
    var htmlcurrent = getConv();
    $("#listConv").html(htmlcurrent);

    setInterval(function() {
        var html = getConv();
        if (html != htmlcurrent) {
            $("#listConv").html(html);
            htmlcurrent = html;
        }
    }, 3000);

});