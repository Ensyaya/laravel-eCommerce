<x-app-layout>

    @foreach ($orders as $order)
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-3  space-y-2 p-3 flex-col rounded text-base text-gray-900 bg-gray-50 ">
            <div>
                <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Order
                    #{{$order->id}}
                </h1>
                <div class="text-lg font-semibold leading-6 mt-2 text-gray-600">STATUS:
                    @if ($order->status == 'Cancelled' )
                    <span
                        class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-400 text-gray-900 rounded-full">
                        <i class="fas fa-clipboard-list"></i>
                        {{$order->status}}</span>
                    @elseif($order->status == 'Delivered')
                    <span
                        class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-400 text-gray-900 rounded-full">
                        <i class="fas fa-clipboard-list"></i>
                        {{$order->status}}</span>
                    @else
                    <span
                        class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-100 text-gray-900 rounded-full">
                        <i class="fas fa-clipboard-list"></i>
                        {{$order->status}}</span>
                    @endif
                </div>
                <p class="text-base font-medium leading-6 mt-2 text-gray-600 ">{{$order->created_at}}</p>
            </div>
            <div class="col-end-12 text-lg font-semibold">
                <div class="float-right ml-10">
                    TOTAL:
                    <span
                        class="text-lg inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-900 rounded-full">
                        $ {{$order->total}}</span>
                </div>
            </div>
        </div>
        <div @if ($order->status==='Cancelled' ) class="opacity-50" @endif >
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-lg text-left text-gray-500 font-bold">
                    <thead class="text-base text-gray-900 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Image
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Product name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Price
                            </th>
                            <th scope="col" class="py-3 px-6">
                                quantity
                            </th>
                            <th scope="col" class="py-3 px-6">
                                total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)

                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <a href="{{ route('product.detail', $item->products->slug) }}">
                                    <img class="w-20 h-20" src="{{$item->products->image}}" alt=""></a>
                            </td>
                            <td class="py-4 px-6">{{$item->products->title}}
                            </td>
                            <td class="py-4 px-6">
                                $
                                @if ($item->product_discounted_price)
                                {{$item->product_discounted_price}}
                                @else
                                {{$item->product_price}}
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                {{$item->quantity}}
                            </td>

                            <td class="py-4 px-6">
                                @if ($item->product_discounted_price)
                                {{$item->product_discounted_price * $item->quantity}}
                                @else
                                {{$item->product_price * $item->quantity}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endforeach
    <div class="flex justify-end mb-10 mt-5">
        {{$orders->links()}}
    </div>


</x-app-layout>