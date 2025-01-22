<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">
                  @can('Permission create')
                    <a href="{{route('admin.brands.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New Brand</a>
                  @endcan
                </div>

              <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                  <thead>
                    <tr>
                    <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">&nbsp;</th>  
                    <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Brand Name</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Unit</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Status</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @can('Brand access')
                      @foreach($brands as $brand)
                      <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light"><img src="{{ $brand->logo }}" width="100"> </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                          {{ $brand->name }}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $brand->category->name }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            @if($brand->publish)
                            <span class="text-white inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-500 rounded-full">Publish</span>
                            @else
                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">Draft</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light text-right">
                          @can('Brand edit')
                          <a href="{{route('admin.brands.edit',$brand->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                          @endcan

                          @can('Brand delete')
                          <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline">
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
              </div>
            </div>
        </main>
    </div>
</div>
</x-app-layout>
