<main x-data="rejectedImages">
    <div class="flex">
        <section class="w-full rounded-md h-full">
            @if (count($all_rejected_images) > 0)
                <div class="flex w-full items-start">
                    <div class="max-w w-full">
                        @foreach ($all_rejected_images as $image)
                        <section x-on:click="detailInfo({{$image->id}})" class="flex mb-2 bg-white p-2 rounded-xl cursor-pointer border border-gray-300 hover:border-purple-600 hover:bg-purple-100 shadow-sm min-h-36 h-full">
                            <div class="flex w-2/3">
                                <div class="bg-gray-200 cursor-pointer w-full max-w-40 h-full rounded-md bg-center bg-cover" style="background-image: url('{{ asset('/storage/photos/'. $image->name) }}')"></div>
                                    <div class="ml-3 text-gray-600 flex flex-col justify-between">
                                    <span class="text-gray-500 text-sm">{{ $image->created_at->diffForHumans() }}</span>
                                    <div class="my-2">
                                        <h2>{{ Str::of($image->description)->words(10,'...') }}</h2>
                                        <p class="text-sm text-gray-500" x-on:click.stop>by <a href="/profile/{{ $image->user->UUID }}" class="text-sm text-gray-500 hover:underline" wire:navigate>{{ $image->user->name }}</a></p>
                                    </div>
                                    <div class="opacity-80 flex gap-x-1 border border-red-400 py-1 px-3 rounded-full text-sm items-center w-fit bg-red-100">
                                        <svg mlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="fill-red-600"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
                                        <span class="text-red-600">Image not Eligible</span>
                                    </div>
                                </div>
                            </div>
                            <div  class="w-1/3 flex gap-x-5">
                                <hr class="w-[1px] h-1/2 my-auto bg-gray-300">
                                <div class="w-full">
                                    <h3 class="text-red-500 text-sm mb-2">Reason</h3>
                                    <p class="text-xs w-full min-w-1/2 text-gray-500">{{ Str::of($image->rejectedInfo->message)->words(20,'...') }}</p>
                                </div>
                                
                                <hr class="w-[1px] h-1/2 my-auto bg-gray-300">
                                <div class="p-2 bg-red-100 hover:bg-red-200 m-auto rounded-full mr-3" title="delete image" x-on:click.stop x-on:click="deleteRejectedImage({{ $image->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-red-600"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                                </div>
                            </div>
                        </section>
                        @endforeach
                    </div>
                    <div class="bg-white shadow-sm rounded-xl max-w-[400px] h-svh overflow-y-scroll transition-all duration-200 ease-in sticky top-0 justify-start rounded-l-xl border border-gray-300" :style="'width:'+sideWidth+'%'" x-cloak>
                        <livewire:superadmin.generic-detail />
                    </div>
                </div>
            @else
                <div class="text-center mt-24 mx-auto">
                    <div class="icon-style">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
                    </div>
                    <h1 class="font-semibold uppercase opacity-75 text-xl">There are no Rejected Images</h1>
                </div>
            @endif
        </section>
    </div>
</main>

@script
<script>
    Alpine.data('rejectedImages', () => ({

        sideWidth: 0,

        detailInfo(id){
            this.sideWidth = 50;
            $wire.dispatch("detail-rejected", { index: id, type: 'rejected'})
        },

        deleteRejectedImage(id)
        {
            console.log('deleting', id)
            $wire.deleteImage(id)
        }

    }))
</script>
@endscript