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

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="grid grid-cols-1 gap-2 mb-6"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <div class="mb-6">
                <label for="title" class="block mb-2 text-lg font-medium text-gray-900 ">Category Name</label>
                <input type="text" id="title" name="title" value="{{$category->title}}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-6">
                <label for="status" class="block mb-2 font-medium text-gray-900">Select an
                    Status</label>
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option @if ($category->status==='active' ) selected @endif value="active">Active</option>
                    <option @if ($category->status==='passive' ) selected @endif value="pasive">Passive</option>
                </select>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Update
                Category</button>
    </form>

    <script>
        $("document").ready(function(){
            setTimeout(function(){
                $("#alert").remove();
            }, 30000 );

        });
    </script>



</x-app-layout>