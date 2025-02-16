<main x-data="imagesShowcase" class="my-10 pb-10">
    {{-- @php
       $curPath = request()->path(); 
    @endphp
    @if (request()->is("profile/*"))
    <div class="flex justify-end my-5">
        <ul class="flex gap-x-2">
            <li wire:click="sorting('desc', '{{ $curPath }}')" class="py-2 px-7 hover:bg-cyan-400 rounded cursor-pointer bg-teal border border-gray-300 p-2 text-center h-fit">Latest</li>
            <li wire:click="sorting('asc', '{{ $curPath }}')" class="py-2 px-7 hover:bg-gray-50 rounded cursor-pointer bg-white border border-gray-300 p-2 text-center h-fit">Oldest</li>
        </ul>
    </div>
    @endif --}}
    @if ($images->total() > 0)
    <div class="grid grid-cols-3 gap-x-3 mb-20">
            @foreach ($images as $image)
                @php
                    $like = false;
                    if(!Auth::check() || Auth::user()->id != $image->user_id){
                        $like = $image->likes($image->id)?->like;
                    }
                @endphp
                <section x-on:click='showDetail(), sendData({{ $image->id }})' class="group border border-gray-100 bg-white shadow rounded h-fit relative overflow-hidden">
                    <div class="bg-gray-100 cursor-pointer">
                        <img src="/storage/photos/{{ $image->name }}" class="group-hover:scale-105 transition-all duration-200" alt="">
                    </div>
                    @if (!Auth::check() || Auth::user()->id != $image->user_id)
                    <div class="bg-gradient-to-t from-black/25 to-transparent absolute bottom-0 left-0 right-0 py-2 px-3 hidden group-hover:flex gap-x-3 items-center" x-on:click.stop>
                        <img src="{{ $image->user->avatar }}"class="rounded-full w-7 h-7" alt="">
                        <a href="/profile/{{ $image->user->UUID }}" wire:navigate class="text-white capitalize hover:underline">{{ $image->user->name }}</a>
                    </div>
                    <div class="bg-gradient-to-b from-black/25 to-transparent absolute top-0 left-0 right-0 group-hover:flex justify-end hidden">
                        <span wire:click="setLike({{ $image->id }})" @class(['p-2 m-2 rounded-xl hover:bg-black/20 hover:cursor-pointer block', 'hover:bg-red-500/20' => $like])
                        x-on:click.stop>
                            @if ($like)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-red-600"><path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path></svg>
                            @else                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-white"><path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"></path></svg>
                            @endif
                        </span>
                    </div>
                    @else
                    <div class="bg-gradient-to-t from-black/25 to-transparent absolute bottom-0 left-0 right-0 py-2 px-3 hidden group-hover:flex gap-x-3 items-center">
                        <p class="text-white">{{ $image->title }}</p>
                    </div>
                    @endif
                </section>
            @endforeach
        </div>
        <div x-show="detail" class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex justify-center z-20 overflow-y-scroll" x-cloak>
            <livewire:components.gallery-image-detail :like="$like" />
        </div>
        {{ $images->links() }}
    @else
        <div class="text-center my-20">
            <div class="icon-style">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm6 0h4v4h-4zM4 10h4v4H4z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no published images</h1>
            <p class="text-md opacity-50">Please upload best images you have ever created and submit for review; show your creativity</p>
        </div>
    @endif
</main>
@script
<script>
    Alpine.data('imagesShowcase', () => ({
        detail: false, 
        selectedImage: null,

        showDetail(){
            $dispatch('overflowhid')
            this.detail = !this.detail;
        },
        
        sendData(id){
            $wire.dispatch('show-detail',{index: id})
        },
    }))
</script>
@endscript

