/* Upload File */
$('#images').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        data : form,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/upload/services',
        success: function(results) {
            if(results.error === false) {
                $('#image_show').html('<a href="'+ results.url +'"><img src="' + results.url + '" width="100px" style="margin-top: 20px"></a>');
                $('#thumb').val(results.url);
            } else {
                alert('Upload file failed');
            }
        },
    })
});