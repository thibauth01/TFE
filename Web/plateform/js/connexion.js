function myAlertBottom(){
		
    $(".myAlert-bottom").show();
    setTimeout(function(){
        $(".myAlert-bottom").hide(); 
    }, 10000);
}

function ShowRequesterSignUp(){
    $('.workerSignUp').hide();
    $('.requesterSignUp').show();
}

function ShowWorkerSignUp(){
    $('.requesterSignUp').hide();
    $('.workerSignUp').show();
}

$(document).ready(function(){
    $('#requesterForm').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
       
        $.ajax({
            url:'php/insertRequester.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
                data = JSON.parse(data);
                if(data == null){
                    window.location.href ='dashboard.php';
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


    $('#workerForm').on('submit',function(event){
        event.preventDefault();
        
        var formData = new FormData(this);
       
        $.ajax({
            url:'php/insertWorker.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
                data = JSON.parse(data);
                if(data == null){
                    window.location.href ='dashboard.php';
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

    $('#formConnect').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url:'php/verifyLogin.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
                data = JSON.parse(data);
                if(data == null){
                    window.location.href ='dashboard.php';
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
});
