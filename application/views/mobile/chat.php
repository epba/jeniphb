<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/chat.css">
<div class="container">
    <div class="row">

        <div class="panel panel-info">
              <!--  <div class="panel-heading  blue darken-4" style="color:white;font-weight:bold"><i class="fa fa-comments" id="nami"></i><a href="#" style="float: right" onclick="balikan()">X </a></div>
              <br> -->
              <div class="panel-body" style="height:400px;overflow-y:auto; padding-top:10px " id="box">
                <div id="chat-box">
                 <div class='panel-body'>
                    <h3 style='text-align:center;color:grey'>Click User on Chat List to Start Chat</h3>
                </div>
            </div> 
        </div>
      
        <div id="loading" style="display:none"><center><i class="fa fa-spinner fa-spin"></i> Loading...</center></div>
       
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control " id="message" style="margin-right:10px;"></textarea>
                    <button id="send" type="button" class="btn btn-primary pull-right" style="margin-top:10px;"  onClick="sendMessage()" ><i class="fa fa-send"></i> Send </button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script>
    $(document).ready(function(){
    //getChat(0);
    $("#user").click(function(){
        $("#id_max").val('0');
    });



    getChatAll('<?php echo $user->id_al; ?>','0');
    /*  $( "#nami" ).text( '\xa0 \xa0' + '<?php echo $user->nama_al; ?>');*/
    setInterval(function(){ 
        if($("#id_al").val() > 0){
            getLastId($("#id_al").val(),$("#id_max").val()); 
            getChat($("#id_al").val(),$("#id_max").val()); 
            autoScroll();
        }else{

        }
    },10000);


});

    function getChatAll(id_al,id_max){

        $.ajax({
            url     : "<?php echo base_url('mob_tampil/getChatAll') ?>",
            type    : 'POST',
            dataType: 'html',
            data    : {id_al:id_al,id_max:id_max},
            beforeSend  : function(){
                $("#loading").show();
            },
            success : function(result){
                $("#loading").hide();
                $("#chat-box").html(result);
                $(".panel-footer").show();

                autoScroll();
                document.getElementById('message').focus();
            }
        });
    }

    function getChat(id_al,id_max){

        $.ajax({
            url     : "<?php echo base_url('mob_tampil/getChat') ?>",
            type    : 'POST',
            dataType: 'html',
            data    : {id_al:id_al,id_max:id_max},
            beforeSend  : function(){
                $("#loading").show();
            },
            success : function(result){
                $("#loading").hide();
                if(id_al != $("#id_al").val() ){
                    $("#chat-box").html(result);
                }else{
                    $("#chat-box").append(result);
                }
                $(".panel-footer").show();
                document.getElementById('message').focus();
            }
        });
    }

    function getLastId(id_al,id_max){
        $.ajax({
            url     : "<?php echo base_url('mob_tampil/getLastId') ?>",
            type    : 'POST',
            dataType: 'json',
            data    : {id_al:id_al,id_max:id_max},
            beforeSend  : function(){

            },
            success : function(result){
                $("#id_max").val(result.id);
            }
        });
    }

    function sendMessage(){
        var message     = $("#message").val();
        var id_al = $("#id_al").val();

        if(message == ''){
            document.getElementById('message').focus();
        }else{
            $.ajax({
                url     : "<?php echo base_url('mob_tampil/sendMessage') ?>",
                type    : 'POST',
                dataType: 'json',
                data    : {id_al:id_al,message:message},
                beforeSend  : function(){
                },
                success : function(result){
                    getChat($("#id_al").val(),$("#id_max").val());
                    getLastId($("#id_al").val(),$("#id_max").val()); 
                    $("#message").val('');
                    autoScroll();
                }
            });
        }
    }

    function autoScroll(){
        var elem = document.getElementById('box');
        elem.scrollTop = elem.scrollHeight;
    }


</script>
