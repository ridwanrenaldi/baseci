<script>

  $(document).ready(function(){
    // ===== Notification alert =====
    var notif = {
      status:"<?php if(isset($notif["status"]) && !empty($notif["status"])) { echo $notif["status"]; } ?>", 
      message:"<?php if(isset($notif["message"]) && !empty($notif["message"])) { echo $notif["message"]; } ?>"
    };
    
    if (notif.status == "error" && notif.message != "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: notif.message
      })
    } else if(notif.status == "success" && notif.message != ""){
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        html: notif.message
      })
    }

  });
  
</script>