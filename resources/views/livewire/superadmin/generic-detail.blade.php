<main x-data="rejectedDetail" x-on:detail-rejected.window="getDetailData" x-on:detail-reviewable.window="getDetailData" x-on:detail-approved.window="getDetailData">
    <div class="py-4 px-3">
        <p class="text-lg">Detail Image</p>
        <p class="text-sm text-gray-500 capitalize flex items-center gap-x-1">
            By
            <template x-if="detailImage?.username">
                <a :href="'/profile/'+ detailImage?.UUID" wire:navigate class="text-md hover:underline" x-text="detailImage?.username"></a>
            </template>
            <template x-if="!detailImage?.username">
                <span class="inline-block h-5 w-24 bg-gray-100 animate-pulse rounded-md"></span>
            </template>
        </p>
        <section class="my-4">
            <template x-if="detailImage.image?.name">
                <div class="rounded-md overflow-hidden">
                    <img class="w-full h-fit" :src="'/storage/photos/'+detailImage.image['name']" alt=""> 
                </div>
            </template>
            <template x-if="!detailImage.image?.name">
                <div class="bg-gray-100 w-full h-52 animate-pulse rounded-md"></div>
            </template>
        </section>
        <section class="my-4">
            <p class="text-gray-500">Title</p>
            <template x-if="detailImage.image?.title">
            <div class="rounded-md overflow-hidden"> 
                <div class="bg-gray-100 w-full h-fit py-1 px-4 rounded-md" x-text="detailImage.image['title']"></div>
            </div>
            </template>
            <template x-if="!detailImage.image?.title">
                <div class="bg-gray-100 w-full h-10 animate-pulse rounded-md"></div>
            </template>
        </section>
        <section class="my-4">
            <p class="text-gray-500">Description</p>
            <template x-if="detailImage.image?.description">
                <div class="rounded-md overflow-hidden">
                    <div class="bg-gray-100 w-full h-fit py-1 px-4 rounded-md" x-text="detailImage.image['description']"></div>
                </div>
            </template>
            <template x-if="!detailImage.image?.description">
                <div class="bg-gray-100 w-full h-40 animate-pulse rounded-md"></div>
            </template>
        </section>
        <template x-if="isPending==2">
            <section class="my-4">
                <p class="text-gray-500">Rejected Message</p>
                <template x-if="detailImage.message">
                    <div class="rounded-md overflow-hidden">
                        <div class="bg-gray-100 w-full h-fit py-1 px-4 rounded-md" x-text="detailImage.message"></div>
                    </div>
                </template>
                <template x-if="!detailImage.message">
                    <div class="bg-gray-100 w-full h-40 animate-pulse rounded-md"></div>
                </template>
            </section>
        </template>
        <template x-if="isPending==1 && !isSuccess">
            <template x-if="detailImage.image">
                <div class="flex justify-between">
                    <button class="bg-green-400 hover:bg-green-300 py-1 px-5 rounded-full" wire:click="approveImage(detailImage.image['id'])">Accept</button>
                    <button class="bg-red-400 hover:bg-red-300 py-1 px-5 rounded-full" x-on:click="rejected(detailImage.image['id'], detailImage.userId)">Reject</button>
                </div>
            </template>
        </template>
        <template x-if="isPending==2">
            <template x-if="detailImage.image">
                <button class="bg-red-400 hover:bg-red-300 py-1 px-5 rounded-full" x-on:click="deleteRejectedImage(detailImage.image['id'])">Delete</button>
            </template>
        </template>
    </div>
</main>
@script
<script>
    Alpine.data('rejectedDetail', () => ({

        detailImage: {
            "image": null,
            "userId": null,
            "username": null,
        },

        isPending: 0,

        getDetailData(prop){

            switch (prop.detail.type) {
                case "pending":
                    this.isPending = 1
                    break;
                case "rejected":
                    this.isPending = 2
                    break;
                default:
                    this.isPending = 0
                    break;
            }
            

            this.detailImage = {
                'image': null,
                'userId': null,
                'username': null
            }

            $wire.renderContent(prop.detail).then((data) => {
                
                let detailData = {
                    "image" :data.all,
                    "userId": data.userId,
                    "username": data.username,
                    "UUID": data.UUID
                }

                if(data.message){
                    detailData = { ...detailData, 'message' : data.message }
                }

                this.detailImage = detailData
                console.log(this.detailImage)
            })
        },
    }))
</script>
@endscript
