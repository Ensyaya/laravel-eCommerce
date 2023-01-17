<x-app-layout>
    <div class="m-2 grid grid-cols-4 gap-2">
        <form action="" method="GET">
            <div class="pt-2 relative mx-auto text-gray-600">
                <input value="{{request()->get('title')}}" name="title"
                    class="border-2 border-gray-300 bg-white h-10 rounded-lg focus:outline-none" type="search"
                    name="search" placeholder="Search">
                <button type="submit"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
                @if (request()->get('title'))
                <a href="{{route('products')}}" type="button"
                    class="text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">
                    <i class="fa-solid fa-arrows-rotate"></i> Reset</a>
                @endif
            </div>
        </form>
    </div>
    <div class="grid grid-cols-3 gap-2">
        @foreach ($products as $product)

        <div class="m-2 min-w-0">
            <div class="rounded-lg shadow-lg bg-white max-w-sm">
                <a href="{{ route('product.detail', $product->slug) }}">
                    <img class="rounded-t-lg object-fit h-80 w-96" src="{{asset($product->image)}}"
                        alt="{{$product->title}}" />
                </a>
                <div class="p-6">
                    <h5 class="text-gray-900 text-xl font-medium mb-2">{{$product->title}}</h5>
                    <p class="text-gray-700 text-base mb-4">
                        {{Str::limit($product->description,60)}}
                    </p>
                    <a type="button" href="{{ route('product.detail', $product->slug) }}"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">Details</a>

                    @if ($product->discounted_price !== null)
                    <span
                        class="animate-pulse text-lg float-right inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-900 rounded-full">{{$product->discounted_price}}
                        $</span>
                    <span class=" text-lg float-right mr-2"><del>{{$product->price}}
                            $</del></span>

                    @else
                    <span
                        class="text-lg float-right inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-300 text-gray-900 rounded-full">{{$product->price}}
                        $</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-end mb-10">
        {{$products->links()}}
    </div>
</x-app-layout>