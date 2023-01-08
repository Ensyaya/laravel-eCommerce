<x-app-layout>

    <div class="grid grid-cols-2">
        <form action="" method="GET" class="">
            <div class="pt-2 relative mx-auto text-gray-600">
                <input value="{{request()->get('title')}}" name="title"
                    class="border-2 border-gray-300 bg-white h-10 rounded-lg focus:outline-none" type="search"
                    name="search" placeholder="Search">
                <button type="submit"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
                @if (request()->get('title'))
                <a href="{{route('categories.index')}}" type="button"
                    class="text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">
                    <i class="fa-solid fa-arrows-rotate"></i> Reset</a>
                @endif
            </div>
        </form>
        <div class="pt-2 mx-auto col-end-12">
            <a href="{{route('categories.create')}}" type="button"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2"><i
                    class="fa-sharp fa-solid fa-plus"></i> Add Category</a>
        </div>

    </div>


    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-lg text-left text-gray-500 font-bold">
            <thead class="text-base text-gray-900 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Category name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Status
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Created At
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Trans
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="py-4 px-6 text-gray-900 whitespace-nowrap">{{$category->title}}</th>
                    <td class="py-4 px-6">
                        @if ($category->status == 'active')
                        <span
                            class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-gray-900 rounded-full">{{$category->status}}</span>
                        @else
                        <span
                            class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-500 text-gray-900 rounded-full">{{$category->status}}</span>
                        @endif

                    </td>
                    <td class="py-4 px-6">
                        {{$category->created_at}}
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex justify-items-center">
                          
                            <a href="{{ route('categories.edit',$category->id)}}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                <i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('categories.destroy',$category->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mb-10 mt-5">
        {{$categories->links()}}
    </div>
</x-app-layout>