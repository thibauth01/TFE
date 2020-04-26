const monthNames = ["Janv", "Fevr", "Mars", "Avr", "Mai", "Juin",
  "Juil", "Aout", "Sept", "Oct", "Nov", "Dec"
];

var currentConv;

function getMessages(idWork){
    $.ajax({
        type:'post',
        url:'php/getMessages.php',
        data:{'id':idWork},
        success:function(data){
            data=JSON.parse(data);
            var idSender = data.idTypeAccount;
            var html="";
            currentConv = idWork;
            if(data.messages.length <= 0){
                html = "Aucun Message"
            }
            else{
                $.each(data.messages,function(index,value){
                    var date = new Date(value.sendtime);
                    var showDate = date.getHours() +":"+date.getMinutes() + " | " + monthNames[date.getMonth()] + " " + date.getDate();
                    
                    if(value.id_sender == idSender){
                        html += `<div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white">`+ value.content +`</p>
                                        </div>
                                        <p class="small text-muted">`+showDate +`</p>
                                    </div>
                                </div>`;
                    }
                    else{
                        html += `<div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                    <div class="media-body ml-3">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-muted">`+ value.content +`</p>
                                        </div>
                                        <p class="small text-muted">`+ showDate +`</p>
                                    </div>
                                </div>`;
                    }
                });
            }
            
            $("#chatBox").html(html);

            var scroll = document.getElementById('chatBox');
            scroll.scrollTop = scroll.scrollHeight;
        }
    })
}

function sendMessage(){
    var text = $("#textareaSend").val();
    
    $.ajax({
        url:'php/sendMessage.php',
        type:'post',
        data:{
            idWork:currentConv,
            text : text
        },
        success:function(data){
        }
    })
}