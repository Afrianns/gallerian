<main x-data="gallery" x-init="initialized">
    <div class="absolute top-0 h-[400px] w-full bg-red-50 mb-10 flex flex-col items-center justify-center bg-center bg-no-repeat bg-cover" style="background-image: url('/storage/placeholders/search/image.png')">
        <span class="absolute bg-black/30 top-0 left-0 bottom-0 right-0"></span>
        <h3 class="my-5 text-white text-3xl z-10">The best images, vector; share by professionals</h3>
        <livewire:components.search/>
    </div>
    <div class="max-w mt-[400px]">
        @if (count($images) > 0)
            <div class="grid mb-10">
                @foreach ($images as $image)
                    <div class="grid-sizer"></div>
                    <section x-on:click='showDetail' class="group grid-item border border-gray-100 bg-white shadow rounded h-fit relative overflow-hidden">
                        <div class="bg-gray-100 cursor-pointer">
                            <img src="/storage/photos/{{ $image->name }}" class="group-hover:scale-105 transition-all duration-200" alt="">
                        </div>
                        <div class="bg-gradient-to-t from-black/25 to-transparent absolute bottom-0 left-0 right-0 py-2 px-3 hidden group-hover:flex gap-x-3 items-center">
                            <img src="{{ $image->user->avatar }}"class="rounded-full w-7 h-7" alt="">
                            <a href="/profile/{{ $image->user->UUID }}" class="text-white capitalize hover:underline">{{ $image->user->name }}</a>
                        </div>
                        <div class="bg-gradient-to-b from-black/25 to-transparent absolute top-0 left-0 right-0 group-hover:flex hidden justify-end">
                            <span class="p-2 m-2 rounded-xl hover:bg-black/20 hover:cursor-pointer block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-white"><path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"></path></svg>
                            </span>
                        </div>
                    </section>
                @endforeach
            </div>
            <div x-show="detail" class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex justify-center z-20 overflow-y-scroll" x-cloak>
                <div class="bg-white w-4/5 py-6 px-5 rounded-xl mt-10 top-0 h-fit" x-on:click.outside="showDetail">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-x-2">
                            <img src="{{ $image->user->avatar }}"class="rounded-full w-8 h-8" alt="">
                            <a href="/profile/{{ $image->user->UUID }}" class="capitalize hover:underline">{{ $image->user->name }}</a>
                        </div>
                        <span class="p-2 m-2 rounded-md hover:bg-gray-500/10 hover:cursor-pointer flex items-center gap-x-2 py-1 px-4 border border-gray-300 hover:border-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-darkPurple"><path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"></path></svg>
                            Like 0
                        </span>
                    </div>
                    <div class="my-5">
                        <img src="/storage/photos/{{ $image->name }}" class="w-1/2 mx-auto mb-5" alt="">
                        <div class="w-1/2">
                            <h2 class="text-xl my-2 font-semibold font-kumbhSans">{{ $image->title }}</h2>
                            <p class="font-light text-sm">{{ $image->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center my-20">
                <div class="icon-style">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm6 0h4v4h-4zM4 10h4v4H4z"></path></svg>
                </div>
                <h1 class="font-semibold uppercase opacity-75 text-xl">There are no published images</h1>
                <p class="text-md opacity-50">Please upload best images you have ever created and submit for review; show your creativity</p>
            </div>
        @endif
    </div>
</main>

@script
<script>
        Alpine.data('gallery', () => ({

            detail: false,

            initialized(){
                // let img = new Image()
                // img.src = '/storage/placeholders/search/image.png'
                // img.crossOrigin = "Anonymous"
                
                // img.onload = () => {
                //     const imgData = blurhash.getImageData(img);
                //     console.log(img, imgData)
                //     blurhash.encodePromise(imgData, img.width, img.height, 4, 4)
                //         .then((hash) => {
                //             console.log(hash)
                //         })
                // }
                
                $dispatch('gallery')
            },

            showDetail(){
                $dispatch('overflowhid')
                this.detail = !this.detail;
            },
        }))
</script>
@endscript