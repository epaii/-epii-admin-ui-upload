 <input type="text" id="files" name="files" style="display: none;">
 <div id="imgs" data-upload-preview="1" data-enable-phone=0 data-mimetype="image/jpg,<?php echo $file_types; ?>" data-maxsize="20480000" data-input-id="files">
 </div>
 <div class="baozhu" style="position: fixed;left:5%;bottom:30px;width:90%"><button id="tongbubtn" class="btn btn-success" style="width:100%;margin:auto auto">同步</button></div>


 <script>
     function setCookie(name, value) {
         var Days = 30;
         var exp = new Date();
         exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
         document.cookie = name + "=" + escape(value) + ";path=/;;expires=" + exp.toGMTString();
     }

     window.onEpiiInit(function() {
        setCookie("PHPSESSID", Args.get("sv"));
         require(["epii-websocket-p2p"], function(WebSocketP2P) {


             $("#imgs").height(window.screen.height * 0.7)
             var phone_config = JSON.parse(Args.pluginsData.epii_upload_phone);
             var client = new WebSocketP2P(phone_config.ws, "epii_upload_client_" + Math.floor(Math
                 .random() * (
                     500000 - 1 + 1) + 1), {
                 name: "手机端"
             });
             client.ready(function() {
                 client.callServer(phone_config.server_name + Args.get("server_id"),
                     "onconnect", {
                         a: 1
                     },
                     function(ret) {
                         $(document.body).show()
                     });
             });
             $("#tongbubtn").click(function() {
                 if (document.getElementById("files").value == '') {
                     layer.alert('您还未选择文件');
                     return
                 }
                 client.callServer(phone_config.server_name + Args.get("server_id"), "onfile", {
                     files: document.getElementById("files").value
                 }, function(ret) {
                     alert('传递成功，若一体机提交后请重新扫描上传');
                     window.location.href = window.location.href;
                 });
             });

         });
     });
 </script>