<main class="mt-5 flex m-0 w-full" x-data="approvedImages" x-init="initalized">
    @if (count($approvedImage) > 0)
        <div class="flex w-full items-start">
            <div class="max-w w-full">
                <div class="grid grid-cols-3">
                    @foreach ($approvedImage as $image)
                    <section x-on:click="detailInfo({{ $image->id }})" class="border-2 border-gray-100 bg-white shadow rounded h-52 relative overflow-hidden m-2">
                        <div class="bg-gray-100 cursor-pointer w-full h-full bg-center bg-cover hover:scale-110 transition-all" style="background-image: url('{{ asset('/storage/photos/'. $image->name) }}')">
                        </div>
                        <div class="bg-green-500/25 absolute bottom-0 left-0 right-0 py-2 px-3 flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-green-500"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path></svg>
                            <div class="my-0">
                                <p class="text-white capitalize">hello world</p>
                                <p class="text-sm text-gray-200">by <a href="/profile/{{ $image->user->UUID }}" class="text-sm text-gray-200 hover:underline">{{ $image->user->name }}</a></p>
                            </div>
                        </div>
                    </section>
                    @endforeach
                </div>
            </div>
            <div class="sidebar-styles" :style="'width:' +sideWidth+ '%'" x-cloak>
                <livewire:superadmin.generic-detail />
            </div>
        </div>
    @else
        <div class="text-center my-24 mx-auto">
            <div class="icon-style">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no approved images</h1>
        </div>
    @endif
</main>

@script
<script>
    Alpine.data('approvedImages', () => ({

        sideWidth: 0,

        initalized(){
            $wire.on('close-side', () => { 
                this.sideWidth = 0
            });
        },

        detailInfo(id){
            this.sideWidth = 50;
            $wire.dispatch("detail-approved", { index: id, type: 'approved'})
        }
    }))
</script>
@endscript
