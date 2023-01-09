<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>

                    <h2 class="font-semibold text-2xl"><span class="totalItem">{{$cart->total['totalItem']}}</span>
                        Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Quantity
                    </h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Total</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Trans</h3>
                </div>

                @if (count($cart->cartItems) > 0)


                @foreach ($cart->cartItems as $item)

                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5 cart-item isNotEmpty">
                    <div class="flex w-2/5">
                        <!-- product -->
                        <div class="w-20">
                            <a href="{{ route('product.detail', $item->products->slug) }}">
                                <img class="h-24" src="{{$item->products->image}}" alt="">
                            </a>
                        </div>
                        <div class="flex flex-col justify-center ml-4 flex-grow">
                            <span class="font-bold">{{$item->products->title}}</span>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5">
                        <input type="hidden" class="quantity{{$item->products->id}}"
                            data-quantity="{{$item->products->quantity}}">
                        <button data-id="{{$item->products->id}}" class="font-semibold stepDown"
                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                class="fa-solid fa-minus"></i></button>
                        <input type="number" id="quantityVal" disabled min="1"
                            class="quantity2{{$item->products->id}} text-center focus:outline-none bg-gray-100 border h-6 w-20 rounded px-2 mx-2"
                            value="{{$item->quantity}}">
                        <button data-id="{{$item->products->id}}"
                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                            class="font-semibold stepUp"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    @if ($item->products->discounted_price)
                    <span class="text-center w-1/5 font-semibold text-sm">$ <span
                            id="discountPrice{{$item->products->id}}">{{$item->products->discounted_price}}</span>
                    </span>
                    <span class="text-center w-1/5 font-semibold text-sm">$ <span
                            id="cartItemIncludeDiscountTotal{{$item->products->id}}">{{$item->products->discounted_price
                            * $item->quantity}}</span>
                    </span>
                    @else
                    <span class="text-center w-1/5 font-semibold text-sm">$ <span
                            id="price{{$item->products->id}}">{{$item->products->price}}</span></span>
                    <span class="text-center w-1/5 font-semibold text-sm">$ <span
                            id="cartItemTotal{{$item->products->id}}">{{$item->products->price *
                            $item->quantity}}</span></span>
                    @endif
                    <span class="text-center w-1/5 font-semibold text-sm">
                        <button data-id="{{$item->id}}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-xs px-5 py-2.5 text-center mr-2 mb-2 basketDltBtn"><i
                                class="fa-solid fa-trash"></i></button></span>
                </div>

                @endforeach
                @else
                <h1 class="text-4xl">Your cart is still empty</h1>
                @endif
                <h1 id="isEmpty" class="text-4xl"></h1>


                <a href="{{ route('products')}}" class="flex font-semibold text-indigo-600 text-sm mt-10">

                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Continue Shopping
                </a>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Items <span
                            class="totalItem">{{$cart->total['totalItem']}}</span></span>
                </div>
                @if (count($cart->cartItems) > 0)

                <div id="cartParent2" class="border-t mt-8">
                    <div id="cartParent1" class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total cost</span>
                        <span>$ <span id="total">{{$cart->total['total']}}</span></span>
                    </div>
                    <form action="{{ route('order.create', $cart->id) }}" method="POST">
                        @csrf
                        <label for="user_phone_number" class="block mb-2 text-lg font-medium text-gray-900">Phone
                            number</label>
                        <input type="text" name="user_phone_number"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            class="shadow-sm my-2 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <label for="user_address" class="block mb-2 text-lg font-medium text-gray-900">Address
                        </label>
                        <input type="text" name="user_address"
                            class="shadow-sm my-2 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <button type="submit"
                            class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Give
                            an Order</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    </slot>

    <script type="text/javascript">
        $(".basketDltBtn").click(function() {
        const id = $(this).data("id");
        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        axios.delete(`/cart/${id}`)
            .then((res) => {
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: res.data.message,
                showConfirmButton: false,
                customClass: 'swal-wide',
                timer: 1500
            });
            const { totalItem, baseTotal, totalDiscount, total } = res.data;
            if (totalItem === 0) {
                $("#cartParent1").closest("#cartParent2").remove();
                $('#isEmpty').html('Your cart is still empty');
            }
            $('#total').html(total);
            $('#baseTotal').html(baseTotal);
            $('#totalDiscount').html(totalDiscount);
            $('.totalItem').html(totalItem);
            $(this).closest('.cart-item').remove();
            })
            .catch((err) => {
            console.log("err", err);
            swal.fire("", "error", "error");
            });
        });

       function number_format(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);

            var nstr = number.toString();
            nstr += '';
            x = nstr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

            return x1 + x2;
        }

        $('.stepDown').click(function() {
        const id = $(this).data('id');
        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
   

        axios.post(`cart/decrement/${id}`)
            .then((res) => {
            const { totalItem, cartItemQuantity, total, removedProductId } = res.data;
            if (totalItem < 1) {
                $('#cartParent1').closest("#cartParent2").remove();
                $('#isEmpty').html('Your cart is still empty');
                $(this).closest(".cart-item").remove();
                $('#total').html(total);
                $('.totalItem').html(totalItem);
            } else {
                if (removedProductId) {
                $(this).closest(".cart-item").remove();
                }
                const isDiscountPrice = $(`#discountPrice${id}`).html();
                let cartItemTotal;
                if (isDiscountPrice === undefined) {
                cartItemTotal = number_format((parseFloat($(`#price${id}`).html()) * cartItemQuantity),2,'.',' ');
                $(`#cartItemTotal${id}`).html(cartItemTotal);
                } else {
                cartItemTotal = number_format((parseFloat($(`#discountPrice${id}`).html()) * cartItemQuantity),2,'.',' ');
                $(`#cartItemIncludeDiscountTotal${id}`).html(cartItemTotal);
                }
                $('#total').html(total);
                $('.totalItem').html(totalItem);
            }
            })
            .catch((err) => console.log(err));
        });
        
        $('.stepUp').click(function() {
        const id = $(this).data('id');
        const productQuantity = parseInt($(`.quantity${id}`).data("quantity"), 10);
        const productInputValue = parseInt($(`.quantity2${id}`).val(), 10);
        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;


        if (productQuantity < productInputValue) {
            $(`.quantity2${id}`).val(productQuantity);
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'You cannot add more than the current stock to your cart.',
                showConfirmButton: false,
                customClass: 'swal-wide',
                timer: 1500
            });
            return false;
        }
         
        axios.post(`cart/${id}`)
            .then((res) => {
            const { totalItem, cartItemQuantity, total } = res.data;
            const isDiscountPrice = $(`#discountPrice${id}`).html();
            const cartItemTotal = isDiscountPrice === undefined
                ? number_format((parseFloat($(`#price${id}`).html()) * cartItemQuantity),2,'.',' ')
                : number_format((parseFloat($(`#discountPrice${id}`).html()) * cartItemQuantity),2,'.',' ');
            $(isDiscountPrice === undefined
                ? `#cartItemTotal${id}`
                : `#cartItemIncludeDiscountTotal${id}`).html(cartItemTotal);
            $('#total').html(total);
            $('.totalItem').html(totalItem);
            })
            .catch((err) => console.log(err));
        });

    </script>



</x-app-layout>