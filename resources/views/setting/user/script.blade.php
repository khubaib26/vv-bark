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
            data: {'status': status, 'user_id': user_id},
            success: function(data){
                //swal("Good job!", "Status change successfully!", "success");
                console.log(data.success)
            },
            error: function(){
                //swal("Error!", "Request Fail!", "error");
            }
        });
    });   
});




</script>