  <script>
    function delete_data(url){
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "<?php if(isset($swal['button']) && !empty($swal['button'])) { echo $swal['button']; } ?>"
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: 'POST',
            url: url,
            data: { 
              [csrfName]: csrfHash 
            },
            dataType: 'JSON',
            success: function (data) {
              if (data.status == 'success') {
                table.ajax.reload();
                Swal.fire({
                  icon: 'success',
                  title: 'Success...',
                  text: data.message
                });
              } else {
                table.ajax.reload();
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: data.message
                })
              }
            }
          });
        }
      });
    }
  </script>