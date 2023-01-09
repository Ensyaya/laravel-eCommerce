<x-app-layout>
    <section class="bg-white mt-10">
        <div class="mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 ">Rating (<span
                        class="ratingCount">{{$ratingAll}}</span>)</h2>
            </div>
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
                        <input type="hidden" value="{{$productId}}" id="productId">
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
    <script>
        const baseUrl = '/';

        function deleteRating(id, productId) {
        sendRequest(`${baseUrl}admin/product/rating/${id}`, 'DELETE', { productId });
        }

        async function sendRequest(url, method, data) {
        try {
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            const headers = { 'X-CSRF-TOKEN': csrfToken };
            const response = await axios({ method, url, headers, data });

            $('.ratingCount').html(response.data.ratingCount)
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

        $(".deleteRating").click(function() {
            const id = $(this).data("id");
            let productId = $('#productId').val();
            deleteRating(id, productId);
            $(this).closest(`.rating-item${id}`).remove();
        })
    </script>


</x-app-layout>