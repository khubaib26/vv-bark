<script>

$(document).ready(function(){ 
    $('.assingUser').on('change', function(e) {
    e.preventDefault(); 

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

    var userId = this.value;
    var leadId = $(this).attr('data-cxm-lead-id');
    console.log(userId);
    console.log(leadId);

    $.ajax({
        type: "GET",
        dataType: "json",
        //url: 'admin/assignUser',
        url: "{{ route('admin.leadAssingUser') }}",
        data: {'user_id': userId, 'lead_id': leadId},
        success: function(data){ 
            console.log(data);
            //setInterval('location.reload()', 2000);        // Using .reload() method.
        }
    });

    });
});    

</script>