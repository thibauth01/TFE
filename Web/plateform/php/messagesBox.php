<div class="container mt-6 px-4">
    <div class="row rounded-lg overflow-hidden shadow">
        <!-- Users box-->
        <div class="col-5 px-0 bg-white list-group-item">
            <div class="bg-white">

                <div class="bg-gray px-4 py-2 bg-light">
                    <p class="h5 mb-0 py-1">Mes conversations</p>
                </div>

                <div class="messages-box">
                    <div class="list-group rounded-0" id="listConv">

                    
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Chat Box-->
        <div class="col-7 px-0">
            <div class="px-4 py-5 chat-box bg-white" id="chatBox">
               
            </div>


             <!-- Typing area -->
             <form id="formSendMessage" onsubmit="event.preventDefault(); sendMessage();" class="bg-light">
                <div class="row" >
                    <div class="col-md-10" >
                        <textarea id="textareaSend" type="text" placeholder="Ecrivez un message" class="form-control "></textarea>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group-append">
                            <button  type="submit" class="btn btn-link"> <i class="text-primary fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            

        </div>
    </div>
</div>