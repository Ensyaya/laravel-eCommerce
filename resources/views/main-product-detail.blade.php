<x-app-layout>

    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="lg:w-1/2 w-full object-cover object-center">
                    <img alt="ecommerce" class="rounded border w-96 h-96 border-gray-200" src="{{$product->image}}">
                    @if ($product->image2 || $product->image3)
                    <div class="flex items-center mt-2 ">
                        @if ($product->image2 )
                        <img class="w-20 h-20 rounded border" src="{{$product->image2}}" alt="{{$product->title}}">
                        @endif
                        @if ($product->image3)
                        <img class="w-20 h-20 ml-2 rounded border" src="{{$product->image3}}" alt="{{$product->title}}">
                        @endif
                    </div>
                    @endif
                </div>
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$product->title}}</h1>
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">
                        @if ($product->category)
                        {{$product->category->title}}
                        @endif
                    </h2>
                    <div class="flex mb-4">
                        <div class="flex items-center">
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" class="w-5 h-5 text-yellow-500"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <p class="ml-2 text-sm font-bold text-gray-900 ratePerRaters">{{$ratePerRaters}}</p>
                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full"></span>
                            <p class="text-sm font-medium text-gray-900"><span class="ratingCount">{{$ratingAll}}</span>
                                reviews</p>
                        </div>
                        @if ($product->discount_rate !== null)

                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                            <div
                                class="rounded-full m-1 bg-red-600 text-red-100  w-16 h-16 flex items-center justify-center font-bold">
                                {{$product->discount_rate}}% Off</div>
                        </span>
                        @endif
                    </div>
                    <p class="leading-relaxed">{{$product->description}}</p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">


                    </div>
                    <div class="flex">
                        @if ($product->discounted_price !== null)
                        <span
                            class="title-font font-medium text-2xl text-gray-900">${{$product->discounted_price}}</span>
                        <span class="title-font ml-2 font-medium text-gray-900"><del>${{$product->price}}</del></span>

                        @else
                        <span class="title-font font-medium text-2xl text-gray-900">${{$product->price}}</span>
                        @endif

                        <span class="flex ml-auto">
                            <button data-id="{{$product->id}}"
                                class=" text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center mr-2 basketAddBtn">
                                <i class="fa-solid fa-cart-shopping"></i> Add
                                to Cart</button></span>

                    </div>
                </div>

            </div>
        </div>

    </section>
    <section class="bg-white mt-10">
        <div class="mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 ">Questions (<span
                        class="questionCount">{{count($questionsAll)}}</span>)</h2>
            </div>

            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                <label for="content" class="sr-only">Your question</label>
                <textarea id="question-content" rows="3"
                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none   "
                    placeholder="Write a question..." required></textarea>
            </div>
            <button data-id="{{$product->id}}"
                class=" text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center mr-2 createQuestion">
                <i class="fa-solid fa-comment"></i> Post question</button>
            <div id="parentDiv">
                @foreach ($questions as $question)
                <div class="question-item{{$question->id}}">
                    <article class=" p-6 text-base bg-white rounded-lg ">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 "><img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                        alt="Michael Gough"><strong>{{$question->user_name}}</strong></p>
                                <p class="text-sm text-gray-600 "><time pubdate>{{$question->created_at}}</time></p>
                            </div>
                            @if (auth()->user()->type == 'admin')
                            <input type="hidden" value="{{$product->id}}" id="product-id">
                            <button data-id="{{$question->id}}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 deleteQuestion"
                                type="button"><i class="fa-solid fa-trash"></i>
                            </button>
                            @endif

                        </footer>
                        <p class="text-gray-500 ml-3">{{$question->content}}</p>
                        @if (auth()->user()->type == 'admin')
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button" class="flex items-center text-sm text-gray-500 hover:underline"
                                data-modal-toggle="modal{{$question->id}}">
                                <i class="fa-solid fa-comments mr-2"></i>
                                Reply
                            </button>
                        </div>
                        @endif
                    </article>
                    <div id="modal{{$question->id}}" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-md md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow ">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-5 border-b rounded-t ">
                                    <h3 class="text-xl font-medium text-gray-900 ">
                                        Reply
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                        data-modal-toggle="modal{{$question->id}}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                @csrf
                                <div class="p-6 space-y-6">
                                    <textarea id="replyContent{{$question->id}}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="content" rows="3"></textarea>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                    <button data-id="{{$question->id}}" data-modal-toggle="modal{{$question->id}}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center createReply">Post
                                        reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="reply-parent-div{{$question->id}}">
                    @foreach ($question->replies as $reply)
                        <article
                            class="reply-item{{$reply->id}} pb-3 mb-6 ml-6 lg:ml-12 text-base bg-white rounded-lg ">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 "><img
                                            class="mr-2 w-6 h-6 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                            alt="Jese Leos">{{$reply->user_name}}</p>
                                    <p class="text-sm text-gray-600 "><time>{{$reply->created_at}}</time></p>
                                </div>
                                <button data-id="{{$reply->id}}"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 deleteReply"
                                    type="button"><i class="fa-solid fa-trash"></i>
                                </button>
                            </footer>
                            <p class="text-gray-500 ml-3 ">{{$reply->content}}</p>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex justify-end mb-10 mt-5">
                {{$questions->links()}}
            </div>

        </div>
    </section>
    <section class="bg-white mt-10">
        <div class="mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 ">Rating (<span
                        class="ratingCount">{{$ratingAll}}</span>)</h2>
            </div>
            @if ($isProductRating < 1 && $isOrdered || auth()->user()->type == 'admin')
                <div id="post-rate-div">
                    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                        <label for="content" class="sr-only">Your Rating</label>
                        <textarea id="rate-content" rows="3"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                            placeholder="Write a question..." required></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="rate" class="mb-2 font-medium text-gray-900">Your Rate</label>
                        <select id="rate-num"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 ">
                            <option name="rate" value="1">1</option>
                            <option name="rate" value="2">2</option>
                            <option name="rate" value="3">3</option>
                            <option name="rate" value="4">4</option>
                            <option name="rate" value="5">5</option>
                        </select> /5
                    </div>
                    <button type="submit" data-id="{{$product->id}}"
                        class=" text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center mr-2 createRating">
                        <i class="fa-solid fa-comment"></i> Post rating</button>
                </div>
                @endif
                <div id="rate-parent-div">
                    @foreach ($ratings as $rating)
                    <article class="rating-item{{$rating->id}} p-6 text-base bg-white rounded-lg ">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 "><img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                        alt="Michael Gough"><strong>{{$rating->user_name}}</strong></p>
                                <p class="text-sm text-gray-600 "><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">{{$rating->created_at}}</time></p>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="ml-2 w-4 h-4 text-yellow-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <p class="ml-2 mt-0.5 text-sm font-bold text-gray-900">{{$rating->rate}}</p>
                            </div>
                            <input type="hidden" value="{{$product->id}}" id="productId">
                            <button data-id="{{$rating->id}}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 deleteRating"
                                type="button"><i class="fa-solid fa-trash"></i>
                            </button>
                        </footer>
                        <p class="text-gray-500 mb-8 ml-3">{{$rating->content}}</p>
                    </article>
                    @endforeach
                </div>

                <div class="flex justify-end mb-10 mt-5">
                    {{$ratings->links()}}
                </div>
        </div>
    </section>

    <slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    </slot>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

    <script>
        const baseUrl = '/';

        function addToCart(id) {
        sendRequest(`${baseUrl}cart/${id}`, 'POST');
        }
        function createQuestion(id, content) {
        sendRequest(`${baseUrl}product-question/${id}`, 'POST', { content });
        }

        function createReply(id, content) {
        sendRequest(`${baseUrl}admin/product-reply/${id}`, 'POST', { content });
        }

        function createRating(id, content, rate) {
        sendRequest(`${baseUrl}product-rating/${id}`, 'POST', { content, rate });
        }

        function deleteQuestion(id, productId) {
        sendRequest(`${baseUrl}admin/product-question/${id}`, 'DELETE', { productId });
        }

        function deleteReply(id, content) {
        sendRequest(`${baseUrl}admin/product-reply/${id}`, 'DELETE');
        }

        function deleteRating(id, productId) {
        sendRequest(`${baseUrl}admin/product-rating/${id}`, 'DELETE', { productId });
        }

        async function sendRequest(url, method, data) {
        try {
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            const headers = { 'X-CSRF-TOKEN': csrfToken };
            const response = await axios({ method, url, headers, data });

            $('.questionCount').html(response.data.questionAll)
            $('.ratingCount').html(response.data.ratingCount)
            $('.ratePerRaters').html(response.data.ratePerRaters)
            $('.question-user-name').html(response.data.user_name)
            $('.question-content').html(response.data.content)
            $('.question-created-at').html(response.data.created_at)
            $('.rating-user-name').html(response.data.user_name)
            $('.rating-content').html(response.data.content)
            $('.rating-created-at').html(response.data.created_at)
            $('.rating-rate').html(response.data.rating_rate)
            $('.reply-user-name').html(response.data.user_name)
            $('.reply-content').html(response.data.content)
            $('.reply-created-at').html(response.data.created_at)

            showNotification(response.data.message);
        } catch (error) {
            console.error(error);
            showNotification('Something went wrong', 'error');
        }
        }

        function showNotification(message, type = 'success') {
        Swal.fire({
            position: 'top',
            icon: type,
            title: message,
            showConfirmButton: false,
            customClass: 'swal-wide',
            timer: 1500
        });
        }

        $('.basketAddBtn').click(function() {
        const id = $(this).data('id');
        addToCart(id);
        });

        $('.createQuestion').click(function() {
        const id = $(this).data('id');
        const content = $('#question-content').val();
        createQuestion(id, content);
        $('#question-content').val('');
        const newQuestion = `
            <footer class="flex justify-between items-center mb-2 m-6 text-base bg-white rounded-lg">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 "><img
                                class="mr-2 w-6 h-6 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                alt="Michael Gough"><span class='question-user-name'></span></p>
                        <p class="text-sm text-gray-600 "><time pubdate class="question-created-at"></time></p>
                    </div>
                    @if (auth()->user()->type == 'admin')
                    <button 
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 deleteQuestion"
                        type="button"><i class="fa-solid fa-trash"></i>
                    </button>
                    @endif
                </footer>
                <p class="text-gray-500 ml-8 question-content"></p>
                @if (auth()->user()->type == 'admin')
                <div class="flex items-center mt-4 ml-8 mb-8 space-x-4">
                    <button type="button" class="flex items-center text-sm text-gray-500 hover:underline"
                        ">
                        <i class="fa-solid fa-comments mr-2"></i>
                        Reply
                    </button>
                </div>
                @endif
                `;
        $("#parentDiv").prepend(newQuestion);
        });

        $('.createReply').click(function() {
        const id = $(this).data('id');
        console.log(id);
        const content = $(`#replyContent${id}`).val();
        createReply(id, content);
        $(`#replyContent${id}`).val('');
        const newReply = `
        <article class="mb-6 ml-6 lg:ml-12 pb-3 text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 "><img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                        alt="Jese Leos"><span class="reply-user-name"></span></p>
                                <p class="text-sm text-gray-600 "><time class="reply-created-at"></time></p>
                            </div>
                            <button
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                type="button"><i class="fa-solid fa-trash"></i>
                            </button>
                        </footer>
                        <p class="text-gray-500 ml-3 reply-content"></p>
                    </article>
                `;
        $(`#reply-parent-div${id}`).prepend(newReply);
        });

        $('.createRating').click(function() {
        const id = $(this).data('id');
        const content = $('#rate-content').val();
        const rate = $('#rate-num').val();
        createRating(id, content, rate);
        $('#rate-content').val('');
        const newRate = `
            <footer class="flex justify-between items-center mb-2 m-6 text-base bg-white rounded-lg">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 "><img
                                class="mr-2 w-6 h-6 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                alt="Michael Gough"><span class='rating-user-name'></span></p>
                        <p class="text-sm text-gray-600 "><time pubdate class="rating-created-at"></time></p>
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" class="ml-2 w-4 h-4 text-yellow-500"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <p class="ml-2 mt-0.5 text-sm font-bold text-gray-900 rating-rate"></p>
                    </div>
                    @if (auth()->user()->type == 'admin')
                    <button 
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 deleteQuestion"
                        type="button"><i class="fa-solid fa-trash"></i>
                    </button>
                    @endif
                </footer>
                <p class="text-gray-500 ml-8 mb-10 rating-content"></p>
                `;
        $("#rate-parent-div").prepend(newRate);
        $(this).closest(`#post-rate-div`).remove();
        });

        $(".deleteQuestion").click(function() {
            const id = $(this).data("id");
            let productId = $('#product-id').val();
            deleteQuestion(id, productId);
            $(this).closest(`.question-item${id}`).remove();
        })
        $(".deleteReply").click(function() {
            const id = $(this).data("id");
            deleteReply(id);
            $(this).closest(`.reply-item${id}`).remove();
        })

        $(".deleteRating").click(function() {
            const id = $(this).data("id");
            let productId = $('#productId').val();
            deleteRating(id, productId);
            $(this).closest(`.rating-item${id}`).remove();
        })
    </script>
</x-app-layout>