<main>
    <livewire:uploader.images-navbar />
    @if (count($approvedImages) > 0)
        <div class="bg-orange-400 py-2 px-5 rounded">
            <p class="text-orange-900">Approved images will be displayed for atleast 5 days; since approved</p>
        </div>
        <div class="mt-5 flex m-0 w-full">
            <section class="max-w w-full mb-5 bg-white rounded shadow border border-gray-100">
                <div class="py-5 px-4">
                    <h1>Approved Images</h1>
                    <div class="gap-4 mt-3">
                        @foreach ($approvedImages as $image)
                            <section class="image-container flex gap-x-3 hover:bg-purple-100 hover:border-purple-500">
                                <div class="w-36 h-36 bg-cover bg-center bg-no-repeat" style="background-image: url('/storage/photos/{{ $image->name }}')">
                                </div>
                                <div class="w-full h-fit">
                                    <ul>
                                        <li class="my-2">
                                            <h3 class="text-opacity-70">Title</h3>
                                            <p class="text-opacity-50">{{ $image->title }}</p>
                                        </li>
                                        <li class="my-2">
                                            <h3 class="text-opacity-70">Description</h3>
                                            <p class="text-opacity-50">{{ $image->description }} </p>   
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    @else
        <div class="text-center mt-24">
            <div class="icon-style">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no images you Published</h1>
            <p class="text-md opacity-50">Don't worry, keep trying and upload more of your best images.</p>
        </div>
    @endif
</main>