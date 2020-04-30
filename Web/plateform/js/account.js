function myAlertBottom(){
    $(".myAlert-bottom").show();
    setTimeout(function(){
        $(".myAlert-bottom").hide(); 
    }, 10000);
}
function PreviewImage(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function(){
    $('#updateAccountWorker').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);
       
        $.ajax({
            url:'php/updateAccountWorker.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
                
                data = JSON.parse(data);
                if(data == null){
                    var html = `<div class="myAlert-bottom alert alert-info">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Modifications réussies !</strong> 
                            </div>`;
                    $("#errormsgSign").html(html);
                    myAlertBottom();
                }
                else{
                    var html="";
                    $.each(data,function(index,value){
                        html+= `<div class="myAlert-bottom alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>`+ value +`</strong> 
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

    $('#updateAccountRequester').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);
       
        $.ajax({
            url:'php/updateAccountRequester.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
                
                data = JSON.parse(data);
                if(data == null){
                    var html = `<div class="myAlert-bottom alert alert-info">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Modifications réussies !</strong> 
                            </div>`;
                    $("#errormsgSign").html(html);
                    myAlertBottom();
                }
                else{
                    var html="";
                    $.each(data,function(index,value){
                        html+= `<div class="myAlert-bottom alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>`+ value +`</strong> 
                                </div>`;
                    });
                    $("#errormsgSign").html(html);
                    myAlertBottom();
                }
                
            },
            processData: false,
            contentType: false,
            cache: false
        })
        
    });


    $('#inputAvatar').change(function(){
        PreviewImage(this,'imgAvatar');
    });
});