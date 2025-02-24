<div class="bg-white w-4/5 py-6 px-5 rounded-xl mt-10 top-0 h-fit" x-data="galleryDetail" x-on:click.outside="showDetail, resetImg()">
    @if ($image)
        @if (!Auth::check() || Auth::user()->id != $image->user_id)  
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-x-2">
                <img src="{{ $image->user->avatar }}"class="rounded-full w-8 h-8" alt="">
                <a href="/profile/{{ $image->user->UUID }}" class="capitalize hover:underline">{{ $image->user->name }}</a>
            </div>
            @if (!Auth::check() || Auth::check() && Auth::user()->type == "user")
                <span wire:click="$parent.setLike({{ $image->id }})" @class(["p-2 m-2 rounded-md hover:bg-gray-500/10 hover:cursor-pointer flex items-center gap-x-2 py-1 px-4 border border-gray-300 hover:border-gray-500", "bg-red-200 hover:bg-red-300" => $like])>
                    @if ($like)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-red-600"><path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path></svg> Liked
                    @else                            
                    <svg xmlns  ="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-darkPurple"><path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"></path></svg> Like
                    @endif      
                </span>
            @endif
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
                <h2 class="text-xl my-2 font-semibold font-kumbhSans">{{ $image->title }}</h2>
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