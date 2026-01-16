<script>
    // alert(1);

    $('.pilih_rayuan').on("change", function(){
        var id_rayuan = $(this).val();
        var action =null;
        // alert(id_rayuan);
if ($(this).is(':checked')){

    action='simpan';

}else{

    action ='buang'; 
}

ajaxSimpanIdRayuan(id_rayuan, action);

    });


    function ajaxSimpanIdRayuan(id_rayuan, action) {
        $.ajax({
            url: '<?php echo url_to('rayuan_baru.simpan_id_rayuan'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                // Your data to be sent in the request
                id_rayuan: id_rayuan,
                action: action,
            },
            beforeSend: function(xhr) {
                // Set the CSRF token header for CodeIgniter CSRF protection
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?= csrf_hash() ?>');
            },
            success: function(response) {
                // Handle the successful response
                console.log(response);
            },
            
            error: function(xhr, textStatus, errorThrown) {
                // Handle the error
                console.log(xhr.responseText);
            }
 });
}
</script>