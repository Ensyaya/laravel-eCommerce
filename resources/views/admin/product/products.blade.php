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
                <a href="{{route('products.index')}}" type="button"
                    class="text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">
                    <i class="fa-solid fa-arrows-rotate"></i> Reset</a>
                @endif
            </div>
        </form>
        <div class="pt-2 mx-auto col-end-12">
            <a href="{{route('products.create')}}" type="button"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2"><i
                    class="fa-sharp fa-solid fa-plus"></i> Add Product</a>
        </div>

    </div>


    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-lg text-left text-gray-500 font-bold">
            <thead class="text-base text-gray-900 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Product name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Image
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Category
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Price
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Status
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Questions / Ratings
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Trans
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="py-4 px-6 text-gray-900 whitespace-nowrap">{{$product->title}}</th>
                    <td class="py-4 px-6">
                        <img class="w-20 h-20" src="{{$product->image}}" alt="{{$product->title}}">
                    </td>
                    <td class="py-4 px-6">
                        @if ($product->category)
                        {{$product->category->title}}
                        @else
                        -
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        ${{$product->price}}
                    </td>
                    <td class="py-4 px-6">
                        @if ($product->status == 'active')
                        <span
                            class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-gray-900 rounded-full">{{$product->status}}</span>
                        @else
                        <span
                            class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-500 text-gray-900 rounded-full">{{$product->status}}</span>
                        @endif

                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('product-question.index',$product->id)}}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            <i class="fa-solid fa-comment"></i></a>
                        <a href="{{ route('product-rating.index',$product->id)}}"
                            class="text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            <i class="fa-solid fa-star"></i></a>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex justify-items-center">
                            <a href="{{ route('products.edit',$product->id)}}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                <i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('products.destroy',$product->id)}}" method="POST">
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
        {{$products->links()}}
    </div>
</x-app-layout>