<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.brands.store')}}">
                  @csrf
                  @method('post')

                <div class="flex flex-col space-y-2">
                  <label for="category" class="text-gray-700 select-none font-medium">Select Category</label>
                  <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="category_id">
                      <option value="">Select Category</option>
                      @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Brand Name</label>
                  <input id="role_name" type="text" name="name" value="{{ old('name') }}"
                    placeholder="Enter Brand Name"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Brand URL</label>
                  <input id="role_name" type="url" name="brand_url" value="{{ old('name') }}"
                    placeholder="Enter Brand Name"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Brand Logo URL</label>
                  <input id="role_name" type="url" name="brand_logo_url" value="{{ old('name') }}"
                    placeholder="Enter Brand Name"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Brand Fav URL</label>
                  <input id="role_name" type="url" name="brand_fav_url" value="{{ old('name') }}"
                    placeholder="Enter Brand Name"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Publish</label>
                  <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="publish">
                      <option value="0">Draft</option>
                      <option value="1">Publish</option>
                  </select>
                </div>
                <div class="text-center mt-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                </div>
              </div>
            </div>
        </main>
    </div>
</div>
</x-app-layout>
