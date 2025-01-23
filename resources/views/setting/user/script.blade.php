
<script>


$(document).ready(function(){   
// Active / Unative User function
    $("#UserTable").on("change", ".toggle-class", function(){
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('admin.userStatus') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'status': status,
                'user_id': user_id
            },
            success: function(data) {
                console.log(data.success);
            },
            error: function(xhr) {
                console.error(xhr.responseText); // Log the server error
            }
        });

    });   
});




</script>