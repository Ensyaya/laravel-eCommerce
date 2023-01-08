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

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="grid grid-cols-1 gap-2 mb-6"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <div class="mb-6">
                <label for="title" class="block mb-2 text-lg font-medium text-gray-900 ">Product Name</label>
                <input type="text" id="title" name="title" value="{{$product->title}}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-lg font-medium text-gray-900 ">Description</label>
                <textarea type="text" id="description" name="description"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    rows="4">{{$product->description}}</textarea>
            </div>
            <div class="grid grid-cols-5">
                <div class="mb-6" id="price_input" @if($product->discounted_price) style="display:none;" @endif>
                    <label for="price" class="block mb-2 text-lg font-medium text-gray-900">Price</label>
                    <input type="number" id="price" name="price" value="{{$product->price}}" min="0" step="0.01"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6" id="price_input2" @if(!$product->discounted_price) style="display:none;" @endif>
                    <label for="price2" class="block mb-2 text-lg font-medium text-gray-900">Price</label>
                    <input disabled type="text" id="price2" name="price2" min="0" value="{{$product->price}}"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>

                <div class="ml-6 flex items-center">
                    <input type="checkbox" id="isDiscount" @if($product->discounted_price) checked @endif
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500
                    focus:border-blue-500 block ">
                    <label for="isDiscount" class="ml-2 text-lg font-medium text-gray-900">Any Discount</label>
                </div>
                <div class="mb-6 mr-6 ml-6" @if(!$product->discounted_price) style="display:none;" @endif
                    id="discounted_price_input">
                    <label for="discounted_price" class="block mb-2 text-lg font-medium text-gray-900">Discounted
                        Price</label>
                    <input type="number" id="discounted_price" name="discounted_price"
                        value="{{$product->discounted_price}}" min="0" step="0.01"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6" @if(!$product->discount_rate) style="display:none;" @endif id="discount_rate_input">
                    <label for="discount_rate" class="block mb-2 text-lg font-medium text-gray-900">Discount
                        Rate (%)</label>
                    <input type="number" id="discount_rate" name="discount_rate" value="{{$product->discount_rate}}"
                        maxlength="2"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6 ml-6" @if(!$product->discount_rate) style="display:none;" @endif
                    id="discount_finished_at_input">
                    <label for="discount_rate" class="block mb-2 text-lg font-medium text-gray-900">
                        Discount end Date (not required)</label>
                    <input type="datetime-local" id="discount_finished_at" name="discount_finished_at"
                        value="{{$product->discount_finished_at}}" min="{{ date('Y-m-d\TH:i') }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
            </div>
            <div class="mb-6">
                <label for="categories" class="block mb-2 font-medium text-gray-900">Select an
                    Category</label>
                <select id="categories" name="category_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    @foreach ($categories as $category)
                    @if ($category->status == 'active')

                    <option value="{{$category->id}}" @if($product->category->title == $category->title)
                        selected @endif>{{$category->title}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="status" class="block mb-2 font-medium text-gray-900">Select an
                    Status</label>
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option @if ($product->status==='active' ) selected @endif value="active">Active</option>
                    <option @if ($product->status==='passive' ) selected @endif value="pasive">Passive</option>
                </select>
            </div>
            <div class="grid grid-cols-3 gap-14">
                <div class="mb-6">
                    <label class="block mb-2 text-lg font-medium text-gray-900" for="user_avatar">Upload First
                        Image</label>
                    @if ($product->image)
                    <img src="{{ $product->image }}" class="mb-2 h-36 w-36">
                    @endif
                    <input type="file" id="image" name="image" value="{{$product->image}}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-lg font-medium text-gray-900" for="user_avatar">Upload Second Image
                        (not
                        required)</label>
                    @if ($product->image2)
                    <img src="{{ $product->image2 }}" class="mb-2 h-36 w-36">
                    @endif
                    <input type="file" id="image2" name="image2" value="{{$product->image2}}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-lg font-medium text-gray-900" for="user_avatar">Upload Third Image
                        (not
                        required)</label>
                    @if ($product->image3)
                    <img src="{{ $product->image3 }}" class="mb-2 h-36 w-36">
                    @endif
                    <input type="file" id="image3" name="image3" value="{{$product->image3}}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Update
            Product</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $("#isDiscount").change(function(){
                if($("#isDiscount").is(":checked")){
                    var price = $("#price").val()
                    $('#price_input').hide();
                    $('#price_input2').show();
                    $('#price2').val(price);
                    $("#discount_rate_input").show();
                    $("#discounted_price_input").show();
                    $("#discount_finished_at_input").show();
                }else{
                    $('#price_input').show();
                    $('#price_input2').hide();
                    $("#discount_rate_input").hide();
                    $("#discounted_price_input").hide();
                    $("#discount_finished_at_input").hide();
                    $("#discount_rate").val(null);
                    $("#discounted_price").val(null);
                    $("#discount_finished_at").val(null);
                }
            })
            $("#discount_rate").on("input", function() {
            if ($(this).val() > 99) {
                $(this).val(99)
            }
            $("#discounted_price").val(
                Math.round($("#price").val() - (($("#price").val() / 100) * $(this).val()))
            )
            if ($(this).val() < 1) {
                $(this).val("")
                $("#discounted_price").val("")
            }
            if($("#discounted_price").val()==0 ){
                $("#discount_rate").val("")
                $("#discounted_price").val("")
            }
        });

        $("#discounted_price").on("input", function() {
            $("#discount_rate").val(
                Math.ceil(100 - (($(this).val() * 100) / $("#price").val()))
            )
            if ($("#discount_rate").val() < 1) {
                $("#discount_rate").val(1)
                $(this).val(Math.round($("#price").val() - ($("#price").val() / 100)))
            }
            if ($("#discount_rate").val() >100) {
                $("#discount_rate").val("")
            }
            if ($(this).val() < 1) {
                $(this).val("")
            }
        });

        $("document").ready(function(){
            setTimeout(function(){
                $("#alert").remove();
            }, 30000 );

        });

    </script>



</x-app-layout>