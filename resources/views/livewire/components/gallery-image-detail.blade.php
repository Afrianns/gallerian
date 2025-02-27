<div class="bg-white w-4/5 py-6 px-5 rounded-xl mt-10 top-0 h-fit" x-data="galleryDetail" x-on:click.outside="showDetail, resetImg()">
    @if ($image)
        @if (!Auth::check() || Auth::user()->id != $image->user_id)  
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-x-2">
                    <img src="{{ $image->user->avatar }}"class="rounded-full w-8 h-8" alt="">
                    <a href="/profile/{{ $image->user->UUID }}" class="capitalize hover:underline">{{ $image->user->name }}</a>
                </div>
                <livewire:components.like :id="$image->id" />
            </div>
        @else
            <div class="flex justify-end">
                <p class="py-2 px-6 rounded-md border border-gray-200 cursor-text bg-gray-50 hover:bg-gray-100 hover:border-gray-300">
                    @if ($totalLikes > 1)
                    Likes {{ $totalLikes }}
                    @else
                    Like {{ $totalLikes }}
                    @endif   
                </p>
            </div>
        @endif
        <div class="my-5">
            <img src="/storage/photos/{{ $image->name }}" class="w-1/2 mx-auto mb-5" alt="">
            <div class="w-1/2">
                <a href="image/{{ $image->id }}" wire:navigate>
                    <h2 class="text-xl my-2 font-semibold font-kumbhSans hover:underline flex items-center gap-x-2" title="more detail">{{ $image->title }} 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 font-black stroke-blue-500" viewBox="0 0 24 24"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 10.5L21 3m-5 0h5v5m0 6v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"/></svg>
                    </h2>
                </a>
                <p class="font-light text-sm">{{ $image->description }}</p>
            </div>
        </div>
    @else
        
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-x-2">
                <div class="bg-gray-100 rounded-full w-8 h-8 animate-pulse" alt=""></div>
                <span class="bg-gray-100 w-10 h-5 animate-pulse"></span>
            </div>
            <span class="w-24 bg-gray-100 rounded h-10 animate-pulse"></span>
        </div>
        
        <div class="my-5">
            <div class="w-1/2 h-96 rounded-md bg-gray-100 mx-auto mb-5 animate-pulse"></div>
            <div class="w-1/2">
                <h2 class="w-30 bg-gray-100 h-7 rounded-md my-2 animate-pulse"></h2>
                <p class="w-80 bg-gray-100 h-24 rounded-md animate-pulse"></p>
            </div>
        </div>

    @endif
</div>

@script
<script>
    Alpine.data('galleryDetail', () => ({

        image: null,
        totalLikes: null,
        
        getDetail(data){
            $wire.getDetailImage(data.detail.index).then((image) => {
                this.image = image.image;
                this.totalLikes = image.totalLikes;

                console.log(this.image, this.totalLikes)
            })
        },

        resetImg(){
            $wire.resetImg()
        },
    }))
</script>
@endscript