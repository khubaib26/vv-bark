
<script>
$(document).ready(function() {   
    $("#UserTable").on("change", ".toggle-class", function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        var toggleSwitch = $(this); 
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to change the user's status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
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
                        Swal.fire(
                            'Updated!',
                            'The user status has been updated.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an issue updating the status.',
                            'error'
                        );
                        toggleSwitch.prop('checked', !status);
                    }
                });
            } else {
                toggleSwitch.prop('checked', !status);
            }
        });
    });
});
</script>
