<main class="mt-5 flex m-0 w-full" x-data="dataImageReviewable" x-init="initialized">
    @if (count($reviewableImage) > 0)
    <div x-show="show" class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex justify-center items-center z-20" x-cloak>
        <div class="bg-white w-fit h-fit py-6 px-5 rounded-lg" x-on:click.outside="messagePopup">
            <form wire:submit="setRejectMessage(id.imageId, id.userId)">
                @csrf
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-yellow-400"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                    <h1>Rejected Message</h1>
                </div>
                <textarea wire:model="message" name="message" id="" class="resize-y min-h-24 w-[500px] rounded-lg border-purple-900 bg-purple-50"></textarea>
                @error('message') <span class="my-2 text-red-600 bg-red-200 py-2 px-3 w-full block rounded-lg text-center">{{ $message }}</span> @enderror
                @error('value') <span class="my-2 text-red-600 bg-red-200 py-2 px-3 w-full block rounded-lg text-center">{{ $message }}</span> @enderror
                <div class="mt-3">
                    <div wire:loading wire:target="setRejectMessage" class="p-1 rounded-full bg-purple-700 hover:bg-purple-600 text-center opacity-50 cursor-not-allowed pr-3">
                        <div class="flex gap-x-2 text-purple-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mx-auto inline" viewBox="0 0 24 24"><path fill="#fff" d="M12 2A10 10 0 1 0 22 12A10 10 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8A8 8 0 0 1 12 20Z" opacity="0.5"/><path fill="#fff" d="M20 12h2A10 10 0 0 0 12 2V4A8 8 0 0 1 20 12Z"><animateTransform attributeName="transform" dur="1s" from="0 12 12" repeatCount="indefinite" to="360 12 12" type="rotate"/></path></svg> 
                            Loading
                        </div>    
                    </div>
                    <button wire:loading.remove wire:target="setRejectMessage" type="submit" class="w-24 h-7 rounded-full bg-purple-700 text-purple-200 hover:bg-purple-600 block">Send</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex w-full items-start">
        <div class="max-w w-full">
            @foreach ($reviewableImage as $image)
            <section x-on:click="detailInfo({{$image->id}})" class="flex mb-2 bg-white p-2 rounded-xl cursor-pointer border border-gray-300 hover:border-purple-600 hover:bg-purple-100 shadow-sm">
                <div class="flex w-2/3">
                    <div class="bg-gray-200 cursor-pointer w-28 h-28 rounded-md bg-center bg-cover" style="background-image: url('{{ asset('/storage/photos/'. $image->name) }}')"></div>
                        <div class="ml-3 text-gray-600 flex flex-col justify-start gap-y-2">
                        <span class="text-gray-500 text-sm">{{ $image->created_at->diffForHumans() }}</span>
                        <div class="my-2">
                            <h2>Lorem ipsum dolor sit amet.</h2>
                            <p class="text-sm text-gray-500">by <a href="#" class="text-sm text-gray-500 hover:underline">{{ $image->user->name }}</a></p>
                        </div>
                    </div>
                </div>
                <template x-if="!isSuccess">
                    <div  class="w-1/3 flex gap-x-5">
                        <div x-on:click.stop wire:click="approveImage({{ $image->id }})" class="p-2 bg-green-100 hover:bg-green-200 ml-auto my-auto rounded-full w-fit" title="Approve Image">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-green-500"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path></svg>
                        </div>
                        
                        <hr class="w-[1px] h-1/2 my-auto bg-gray-300">
                        <div x-on:click.stop x-on:click="rejected({{ $image->id }},{{ $image->user->id }})" class="p-2 bg-red-100 hover:bg-red-200 my-auto rounded-full mr-3 w-fit" title="Reject Image">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-red-500"><path d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"></path><path d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"></path></svg>
                        </div>
                    </div>
                </template>
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm6 0h4v4h-4zM4 10h4v4H4z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no images submitted for review</h1>
        </div>
    @endif
</main>
@script
<script>
    Alpine.data('dataImageReviewable', () => ({
        
        sideWidth: 0,
        show: false,
        id: {
            'imageId': null,
            'userId': null
        },

        hideScroll: false,
        isSuccess: false,

        initialized(){
            
            $wire.on('status-sending', (data) => {

                if(data.status[0] == 'success'){
                    this.isSuccess = true;
                }

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
                    icon: data.status[0],
                    title: "<p class='text-md font-normal'>"+data.status[1]+"</p>",
                });
            })
        },
        
        detailInfo(id){
            if (this.sideWidth == 0) this.sideWidth = 50;

            $wire.dispatch('detail-reviewable', {index: id, type: 'pending'})
        },

        messagePopup(){
            this.show = !this.show
            $dispatch('hide-overflow-parent')
        },

        rejected(imageId, userId){
            this.messagePopup()
            this.id = {
                "imageId":imageId,
                "userId": userId
            }
        },
    }))
</script>
@endscript