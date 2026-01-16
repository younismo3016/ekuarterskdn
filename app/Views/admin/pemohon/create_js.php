<script>
    //dapatkan id negeri
    $( "#negeri" ).on( "change", function() {
        // dapatkan current input value
        var id_negeri = $(this).val();

        //alert(id_negeri);

        //nk pass id negeri pada town
        ajaxGetStateTown(id_negeri);

    } );

    //check if current negeri id exist on load
    var current_negeri_id = $("#edit_negeri").val();

    if(current_negeri_id) {

        var current_daerah_id = $("#current_daerah_id").val();

        ajaxGetStateTown(current_negeri_id, current_daerah_id);

    }


    function ajaxGetStateTown(id_negeri, id_daerah = null) {
        $.ajax({
            url: '<?php echo url_to('pemohon.state_town'); ?>',
            type: 'GET', //type GET is function nk dapatkan data dr db
            dataType: 'html',
            data: {
                // Your data to be sent in the request
                id_negeri: id_negeri,
                id_daerah: id_daerah
            },
            beforeSend: function(xhr) {
                // Set the CSRF token header for CodeIgniter CSRF protection
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?= csrf_hash() ?>');
            },
            success: function(response) {
                
                var daerah = $("#daerah");

                daerah.empty().append(response);
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
