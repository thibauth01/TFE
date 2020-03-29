function myAlertBottom(){
    $(".myAlert-bottom").show();
    setTimeout(function(){
        $(".myAlert-bottom").hide(); 
    }, 10000);
}

$(document).ready(function(){

    $('#addJobForm').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);
        var id = $("#selectType option:selected").attr('id');
        formData.append('idType',id);
       
        $.ajax({
            url:'php/addJob.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
                console.log(data);
                data = JSON.parse(data);
                if(data == null){
                    var html = `<div class="myAlert-bottom alert alert-info">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Job Ajouté !</strong> 
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
});
