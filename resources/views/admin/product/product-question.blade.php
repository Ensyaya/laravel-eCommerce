<x-app-layout>
    <section class="bg-white mt-10">
        <div class="mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 ">Questions (<span
                        class="questionCount">{{count($questionsAll)}}</span>)</h2>
            </div>
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
                            <input type="hidden" value="{{$productId}}" id="productId">
                            <button data-id="{{$question->id}}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 deleteQuestion"
                                type="button"><i class="fa-solid fa-trash"></i>
                            </button>
                            @endif

                        </footer>
                        <p class="text-gray-500 ml-3">{{$question->content}}</p>
                    </article>
                    @foreach ($question->replies as $reply)
                    <div id="reply-parent-div{{$question->id}}">
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
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            <div class="flex justify-end mb-10 mt-5">
                {{$questions->links()}}
            </div>

        </div>
    </section>
    <slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    </slot>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

    <script>
        $(".deleteQuestion").click(function() {
            const id = $(this).data("id");
            const productId = $('#productId').val();

            var token = document.head.querySelector('meta[name="csrf-token"]');
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

            axios.post(`/product-question/destroy/${id}`,{productId}).then((res) => {
                console.log(res);
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: res.data.message,
                    showConfirmButton: false,
                    customClass: 'swal-wide',
                    timer: 1500
                })
            $(this).closest(`.question-item${id}`).remove();

            $('.questionCount').html(res.data.questionAll)

            }).catch((err) => {
                console.log("err", err)
                swal.fire("", "something went wrong", "error")
            })
        })
        $(".deleteReply").click(function() {
            const id = $(this).data("id");
            
            var token = document.head.querySelector('meta[name="csrf-token"]');
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

            axios.post(`/product-reply/destroy/${id}`).then((res) => {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: res.data.message,
                    showConfirmButton: false,
                    customClass: 'swal-wide',
                    timer: 1500
                })
            $(this).closest(`.reply-item${id}`).remove();

            }).catch((err) => {
                console.log("err", err)
                swal.fire("", "bir hata oluştu", "error")
            })
        })
    </script>


</x-app-layout>