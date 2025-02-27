<main x-data="gallery" x-init="initialized">
    <div class="absolute top-0 h-[400px] w-full bg-red-50 mb-10 flex flex-col items-center justify-center bg-center bg-no-repeat bg-cover " style="background-image: url('/assets/placeholders/search/image.png')">
        <span class="absolute bg-black/30 top-0 left-0 bottom-0 right-0"></span>
        <h3 class="my-5 mx-5 md:mx-auto text-white text-3xl z-10">The best images, vector; share by professionals</h3>
        <livewire:components.search/>
    </div>
    <div class="max-w mt-[350px]">
        <livewire:components.images-showcase/>
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