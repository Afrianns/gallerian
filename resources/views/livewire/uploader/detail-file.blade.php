<main class="py-6 px-5 h-fit" x-data="Detail" x-init="initialized" x-on:show-detail-data.window="setDetail($event)">
    <h2 class="title-font">Edit Detail Image</h2>
    <div class="w-full h-64 form-input-style rounded overflow-hidden  border-none" :class="detail ? '': 'animate-pulse'">
        <template x-if="detail">
                <img :src="'/storage/photos/'+ detail.name" class="w-full h-full bg-cover" alt="">
        </template>
    </div>
    <form wire:submit="updateFileInfo(detail.id)" method="post" class="mt-5">
        @csrf
        <div>
            <label for="title">Title</label> <br>
            <div class="form-input-style min-h-10 mt-2" :class="detail ? '' : 'cursor-progress border-none animate-pulse'">
                <template x-if="detail">
                    <input type="text" name="title" wire:model="title" id="title" class="outline-teal min-h-10 w-full bg-transparent py-1 px-2" :value="detail.title" placeholder="Fill the title of the image!">
                </template>
            </div>
            @error('title') <span class="text-red-500 my-2 text-center italic text-xs">{{ $message }}</span> @enderror 
        </div>
        <div class="mt-5">
            <label for="description">Description</label><br>
            <div class="form-input-style h-36 mt-2" :class="detail ? '' : 'cursor-progress border-none animate-pulse'">
                <template x-if="detail">
                    <textarea name="description" id="description" wire:model="description" class="resize-none outline-teal w-full bg-transparent py-1 px-2 h-36" placeholder="Fill the description related to the image!" :value="detail.description"></textarea>
                </template>
            </div>
            @error('description') <span class="text-red-500 my-2 text-center italic text-xs">{{ $message }}</span> @enderror 
        </div>

        <button type="submit" class="bg-teal py-2 px-5 w-full my-5 hover:bg-cyan-400 hover:border-cyan-900" wire:loading.class="opacity-50 cursor-not-allowed">
        <span wire:loading>
            Loading Update...
        </span>
        <span wire:loading.remove>
            Update Detail
        </span>
        </button>
    </form>
</main>

@script
<script>    
    Alpine.data('Detail', () => ({
        detail: null,

        initialized(){
            $wire.on("detail-image-fetched", () => {
                this.detail = $wire.detailImage;
            })

            $wire.on('status', (data) => {
                console.log(this.detail);
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: (Object.keys(data)[0]).toString(),
                    title: "<p class='text-md font-normal'>"+data.success+"</p>",
                });
            });
        },

        setDetail(res){
            this.detail = null;
            $wire.getDetail(res.detail.index);
        },
    }))
</script>
@endscript