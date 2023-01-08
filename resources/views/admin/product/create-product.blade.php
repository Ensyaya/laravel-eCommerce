<x-app-layout>


    @if ($errors -> any())
    <div role="alert" id="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Warning
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
            <li class="text-lg">
                {{$error}}
            </li>
            @endforeach
        </div>
    </div>
    @endif

    <form action="{{ route('products.store')}}" method="POST" class="grid grid-cols-1 gap-2"
        enctype="multipart/form-data">
        @csrf
        <div class="">
            <div class="mb-6">
                <label for="title" class="block mb-2 text-lg font-medium text-gray-900 ">Product Name</label>
                <input type="text" id="title" name="title" value="{{old('title')}}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-lg font-medium text-gray-900 ">Description</label>
                <textarea type="text" id="description" name="description"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    rows="4">{{old('description')}}</textarea>
            </div>
            <div class="mb-6">
                <label for="price" class="block mb-2 text-lg font-medium text-gray-900">Price</label>
                <input type="text" id="price" name="price" value="{{old('price')}}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            </div>
            <div class="mb-6">
                <label for="categories" class="block mb-2 font-medium text-gray-900">Select an
                    Category</label>
                <select id="categories" name="category_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected disabled>Choose a Category</option>
                    @foreach ($categories as $category)
                    @if ($category->status == 'active')
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-3 gap-14">
                <div class="mb-6 ">
                    <label class="block mb-2 text-lg font-medium text-gray-900" for="image">Upload First
                        Image</label>
                    <input type="file" id="image" name="image" value="{{old('image')}}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6 ">
                    <label class="block mb-2 text-lg font-medium text-gray-900" for="image2">Upload Second Image (not
                        required)</label>
                    <input type="file" id="image2" name="image2" value="{{old('image2')}}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6 ">
                    <label class="block mb-2 text-lg font-medium text-gray-900" for="image3">Upload Third Image (not
                        required)</label>
                    <input type="file" id="image3" name="image3" value="{{old('image3')}}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Create
            Product</button>
    </form>

    <script>
        $("document").ready(function(){
            setTimeout(function(){
                $("#alert").remove();
            }, 30000 );

        });
    </script>

</x-app-layout>