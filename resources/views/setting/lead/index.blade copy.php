<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">
                  @can('Permission create')
                    <a href="{{route('admin.leads.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New Lead</a>
                  @endcan
                </div>

              <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                  <thead>
                    <tr>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">ID #</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light" width="100">Brand</th>  
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Contact</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Date</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Platform</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light" width="100">Assing Lead</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Value</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Status</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @can('Lead access')
                      @foreach($leads as $lead)
                      <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">{{ $lead->id }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">
                          <img src="{{$lead->brand->logo}}" width="100"><br>  
                          {{$lead->brand->name}}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                          {{ $lead->name }}<br>
                          {{ $lead->email }}<br>
                          {{ $lead->phone }}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            {{$lead->created_at->format('j F, Y')}}
                            <br>{{$lead->created_at->format('h:i:s A')}}
                            <br>{{$lead->created_at->diffForHumans()}}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $lead->platform }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">
                          @can('Lead assign')
                            <select class='assingUser' name="assingUser" data-cxm-lead-id="{{$lead->id}}">
                              @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ ($user->id == $lead->assing_user_id)  ? 'selected' : '' }} >{{ $user->name }}</option>
                              @endforeach    
                            </select>
                          @endcan
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">${{ $lead->value }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $lead->status->status ?? 'None' }}</td>
                       
                        <td class="py-4 px-6 border-b border-grey-light text-right">
                          @can('Lead edit')
                          <a href="{{route('admin.brands.edit',$lead->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                          @endcan

                          @can('Lead delete')
                          <form action="{{ route('admin.brands.destroy', $lead->id) }}" method="POST" class="inline">
                              @csrf
                              @method('delete')
                              <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                          </form>
                          @endcan
                        </td>
                      </tr>
                      @endforeach
                    @endcan  
                  </tbody>
                </table>
                @can('Lead access')
                  <div class="text-right p-4 py-10">
                    {{ $leads->links() }}
                  </div>
                @endcan
              </div>
            </div>
        </main>
    </div>
</div>
</x-app-layout>
<script>

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

</script>