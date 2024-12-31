<main>
    <livewire:uploader.images-navbar />
    @if (count($rejectedImages) > 0)
    <div class="mt-5 flex m-0 w-full">
        <section class="max-w w-full mb-5 bg-white rounded shadow border border-gray-100">
                <div class="py-5 px-4">
                    <h1>Rejected Images</h1>
                    <div class="flex gap-4 mt-3">
                        @foreach ($rejectedImages as $image)
                                <section class="image-container w-full flex gap-x-3 hover:bg-red-100 hover:border-red-500">
                                    <div class="w-36 h-36 bg-cover bg-center bg-no-repeat" style="background-image: url('/storage/photos/{{ $image->name }}')">
                                    </div>
                                    <div class="w-full h-fit relative">
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
                                        <span class="absolute top-0 right-0 text-red-500 w-fit h-fit bg-red-200 py-2 px-4 fill-red-500 flex gap-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                                            Rejected
                                        </span>
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no Rejected Images</h1>
            <p class="text-md opacity-50">Keep it up, don't stop to showcase your skill to the world.</p>
        </div>
    @endif
</main>