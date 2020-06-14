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



async function recoverPassword(){
    const { value: user } = await Swal.fire({
        title: "Entrez votre nom d'utilisateur",
        input: 'text',
        inputPlaceholder: "Entrez votre nom d'utilisateur",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok',
        cancelButtonText: 'Annuler'
      })
      
      if (user) {
          $.ajax({
              url:"php/recoverPassword.php",
              type:"post",
              data:{"username":user},
              success:function(data){
                  if(data){
                    Swal.fire(
                        "Un nouveau mot de passe vous à été envoyé par email",
                        "",
                        'success'
                    );
                  }
                  else{
                    Swal.fire(
                        "Nom d'utilisateur introuvable",
                        "",
                        'error'
                    );
                  }
                  
                },
              error:function(data){
                  console.log(data);
              }
              
          })
      } 
}

$(document).ready(function(){
    $('#requesterForm').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);
       
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
