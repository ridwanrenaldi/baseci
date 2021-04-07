<script>

  $(document).ready(function(){
    // ===== Notification alert =====
    var notif = {
      status:"<?php if(isset($notif["status"])) { echo $notif["status"]; } ?>", 
      message:"<?php if(isset($notif["message"])) { echo $notif["message"]; } ?>",
      url:"<?php if(isset($swal['url'])) { echo $swal['url']; } ?>",
      confirmbutton: "<?php if(isset($swal['button'])) { echo $swal['button']; } ?>",
    };

    if (notif.status == "error" && notif.message != "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: notif.message
      });
    } else if(notif.status == "success" && notif.message != ""){
      Swal.fire({
        icon: 'success',
        title: 'Success...',
        html: notif.message,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: notif.confirmbutton,
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.value) {
          window.location.replace(notif.url);
        }
      });
    }

  });
</script>