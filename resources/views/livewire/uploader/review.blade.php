<main x-data="detail" x-init="initialized">
    <livewire:uploader.images-navbar />
    @if(count($reviewableImages) > 0)
        <div class="mt-5 flex m-0 h-1/2s">
            <section class="max-w w-full">
                <div class="bg-white rounded shadow border border-gray-100 py-5 px-4">
                    <h1>PENDING REVIEW</h1>
                    <div class="flex gap-4 mt-3">
                        @foreach ($reviewableImages as $image)
                        <section class="image-container">
                            <div class="w-36 h-36 bg-cover bg-center bg-no-repeat" style="background-image: url('/storage/photos/{{ $image->name }}')" x-on:click="detailImage({{ $image }})">
                            </div>
                        </section>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="fixed z-10 right-0 top-0 bottom-0 bg-white shadow-sm rounded-s max-w-[400px] h-svh overflow-y-scroll transition-all duration-200 ease-in md:sticky md:top-0 justify-start" :style="'width:' +sideWidth+'%'" x-cloak>
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <h2 class="title-font">Detail Image</h2>
                        <button x-on:click="closeSide" class="cursor-pointer mb-3 hover:underline">Close</button>
                    </div>
                    <div class="w-full h-56 bg-red-100 bg-cover bg-center bg-no-repeat mt-5" :style="`background-image: url('/storage/photos/`+detail['name']+`');`">
                    </div>
                    <div class="mb-2 mt-5">
                        <p>Title</p>
                        <h3 class="text-gray-500 bg-gray-100 py-2 px-3" x-text="(detail['title']) ? detail['title'] : '-'"></h3>
                    </div>
                    <div class="my-2">
                        <p>Description</p>
                        <h3 class="text-gray-500 bg-gray-100 py-2 px-3" x-text="(detail['description']) ? detail['description'] : '-'"></h3>
                    </div>
                    
                    <div class="my-2">
                        <p>Tag</p>
                        <h3 class="text-gray-500 bg-gray-100 py-2 px-3" x-text="(detail['tag']) ? detail['tag'] : '-'"></h3>
                    </div>

                    <div class="mb-2 mt-5">
                        <button class="py-1 px-5 bg-red-500 rounded-full text-white" wire:click="deleteFile(detail['id'], detail['name'])">Delete</button>
                    </div>
                </div>
            </section>
        </div>
    @else
        <div class="text-center mt-24">
            <div class="icon-style">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm6 0h4v4h-4zM4 10h4v4H4z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no images you submitted for review</h1>
            <p class="text-md opacity-50">Please upload best images you have ever created and submit for review; show your creativity</p>
        </div>
    @endif
</main>

@script
<script>
    Alpine.data('detail', () => ({

        detail: {},
        sideWidth: 0,
        selected: [],

        initialized(){
            $wire.on("delete-status", (status) => {
                if(status.success){
                    this.detail = {};
                    this.sideWidth = 0;
                } else{
                    alert("failed to delete");
                    console.log(status.success);
                }
            })
        },

        detailImage(image){
            this.sideWidth = 75;
            console.log(image);

            this.detail = {
                'id': image['id'],
                'name' : image['name'],
                'title': image['title'],
                'description': image['description'],
                'tag': image['tag'],
            }
        },

        closeSide(){
            this.sideWidth = 0;
        }
    }))

</script>
@endscript
