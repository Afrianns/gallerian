<main x-data="uploader" x-init="initialized">
    <livewire:uploader.images-navbar />
    <div class="mt-5 flex m-0 w-full">
        <section class="max-w w-full mb-5">
            @if (request()->session()->has("status"))
                <div class="bg-red-400 py-2 px-5 rounded">
                    <p class="text-red-900">{{ request()->session()->get('status') }}</p>
                </div>
            @endif
            <div class="bg-white shadow-sm pt-10 pb-7 px-3 md:px-10 rounded">
                <form>
                    <h2 class="title-font">Upload Images here.</h2>
                    <div class="border-purple-300 border-dashed bg-purple-50 c-hover cursor-pointer border-2 rounded-lg h-52 flex flex-col justify-center w-full relative">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="4rem" height="4rem" viewBox="0 0 24 24" class="mx-auto fill-gray-400"><path d="M13 19v-4h3l-4-5-4 5h3v4z"></path><path d="M7 19h2v-2H7c-1.654 0-3-1.346-3-3 0-1.404 1.199-2.756 2.673-3.015l.581-.102.192-.558C8.149 8.274 9.895 7 12 7c2.757 0 5 2.243 5 5v1h1c1.103 0 2 .897 2 2s-.897 2-2 2h-3v2h3c2.206 0 4-1.794 4-4a4.01 4.01 0 0 0-3.056-3.888C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.611 5.757 9.15 3.609 9.792 2 11.82 2 14c0 2.757 2.243 5 5 5z"></path></svg>
                            <p class="pointer-none text-gray-400 ">Drag and drop files here <br /> or <span class="text-blue-400 hover:underline">click the area</span> to upload from your computer</p>
                        </div>
                        <input type="file" id="photos" x-on:change="uploadFile" wire:model="photos" class="absolute w-full h-full opacity-0" title="" multiple>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mt-1">
                        <p>JPG, JPEG, PNG only</p>
                        <p>Max: 10mb</p>
                    </div>
                    @error("photos.*") <span class="error">{{ $message }}</span> @enderror
                    <div x-cloak>
                        <div x-show="images.length > 0" class="flex justify-between items-center my-2">
                            <h2 class="title-font mb-2 mt-5 text-xl">All Files</h2>

                            <button x-on:click.prevent="submitReview" class="mt-6 ml-auto block text-sm rounded-full bg-teal py-1 px-5 w-50 hover:bg-cyan-400 hover:border-cyan-900">Submit for Review</button>
                        </div>
                        <template x-if="images.length > 0">
                            <ul class="flex flex-wrap items-start gap-3 justify-center">
                                <template x-for="(image, idx) in images">
                                    <li x-on:click="selected(idx, image.id)">
                                        <div class="relative w-fit min-h-20 border-2 border-gray-200 bg-white rounded-xl p-2 mt-1 hover:cursor-pointer" :class=" clickable[idx] ? 'indicator':'c-hover'">
                                            <div x-show="image.saving" :class="image.saving ? 'flex items-center justify-center bg-gray-200/50 top-0 bottom-0 left-0 right-0 absolute h-full' : ''">  
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#555" d="M12 2A10 10 0 1 0 22 12A10 10 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8A8 8 0 0 1 12 20Z" opacity="0.5"/><path fill="#fff" d="M20 12h2A10 10 0 0 0 12 2V4A8 8 0 0 1 20 12Z"><animateTransform attributeName="transform" dur="1s" from="0 12 12" repeatCount="indefinite" to="360 12 12" type="rotate"/></path></svg>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <div class="bg-gray-200 h-32 w-36 rounded overflow-hidden">
                                                    <img :src=" (image.blob) ? URL.createObjectURL(image.blob) : '/storage/photos/'+ image['name']" class="object-cover h-full w-full">
                                                </div>
                                                <div class="ml-3 z-10">
                                                    <section x-show="!image.saving" title="delete uploaded file" x-on:click="deleteFile(idx,image.id)" wire:confirm="are your sure want to delete this file?" class="py-2 px-1 bg-red-100/40 hover:bg-red-100/60 rounded fill-red-400 hover:fill-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                                                    </section>
                                                </div>
                                            </div>
                                            <div class="mt-2" x-show="image.saving">
                                                <div class="flex justify-between text-sm text-gray-500">
                                                    <span>Loading</span>
                                                    <span x-text="progress[image.id]+'%'"></span>
                                                </div>
                                                <div class="w-full h-2 bg-gray-100 rounded-full relative my-2">
                                                    <span class="bg-purple-500 h-full absolute rounded-full" :style="'width:'+progress[image.id]+'%;'"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </template>
                            </div>
                        </template>
                    </div>
                </form>
            </div>
        </section>
        <section class="bg-white shadow-sm rounded-s max-w-[400px] h-svh overflow-y-scroll transition-all duration-200 ease-in sticky top-0 justify-start" :style="'width:' +sideWidth+'%'" x-cloak>
                <livewire:uploader.detail-file :$imageID/>
        </section>
    </div>
    @script
    <script>
    Alpine.data('uploader', () => ({
    
        clickable: [],
        // uploading: [],
        progress: [],
        images: [],

        sideWidth: 0,
        selectable: false,
        
        initialized() {
            this.sideWidth = 0
            this.fetchHTMLImageTemplates();
    
            $wire.on("image-saved", (result) => {
                if(result.success){
                    for (let i = 0; i < this.images.length; i++) {
                        console.log(this.images[i])
                        if(this.images[i].id == result.tempIndex){
                            console.log(this.images[i].id, result.tempIndex)
                            this.images[i] = {
                                "id" : result.imageData.id,
                                "name": result.imageData.name,
                                "title": result.imageData.title,
                                "description": result.imageData.description,
                                'saving': false
                            }

                            // this.uploading[result.tempIndex] = false
                            // console.log(this.images)
                            $wire.$set(`photos.${result.tempIndex}`, null)
                        }
                    }
                } else {
                    for (let i = 0; i < this.images.length; i++) {
                        if(this.images[i].id == result.tempIndex)
                            this.images[i] = null
                    }
                }
            })
            
            $wire.on('to-reviewing', (indexes) => {
            
                for (const index of indexes.id) {

                    for (const idx in this.images) {
                        if(this.images[idx].id == index)
                            this.images.splice(idx, 1)
                    }
                }
                this.sideWidth = 0
            })

            $wire.on('status', (result) => {

                for (const key in this.images) {

                    if(this.images[key].id == result.detail.id){
                        this.images[key].title = result.detail['title']
                        this.images[key].description = result.detail['description']
                    }
                }
            })
        },
    
        fetchHTMLImageTemplates(){
            $wire.images.forEach((image, id) => {
                this.images[id] = image

            })
        },
    
        uploadFile(event) {
            let index = this.images.length
            let files = event.target.files
    
            for (const file of files) {
                
                // this.uploading[index] = true;
                this.progress[index] = 0;
    
                let image = {
                    "id": index,
                    "name": file.name,
                    "saving": true,
                    "blob": file,
                    "url": null
                }
                
                this.images.push(image)
                this.doUpload(file, index++)
            }
        },
    
        doUpload(file, i){
            $wire.upload('photos.' + i, file, (result) => {
                $wire.save(result)
            }, () => {
            }, (event) => {
                this.progress[i] = event.detail.progress
                
            }, () => {
                this.images.saving = false
            })
        },
    
        cancelUploading(idx){
            if(this.progress[idx] <= 90){
                this.images.splice(idx, 1)
                $wire.cancelUpload('photos.'+ idx)
            }
        },
    
        deleteFile(idx,id){
            if (this.images[idx].saving) return
            
            this.images.forEach((image, idx) => {
                if(image.id == id){
                    this.images.splice(idx, 1)
                    $wire.deleteFile(id)
                    this.sideWidth = 0
                }
            });
        },

        selected(idx, id) {
            // console.log(this.images[idx].saving)
            if (this.images[idx].saving) return
    
            for (const index in this.clickable)
                this.clickable[index] = false

            this.clickable[idx] = true
            this.sideWidth = 50
            
            $wire.dispatch('show-detail-data',{ index: id })
        },
    
        setSelectable()
        {
            this.selectable = !this.selectable
        },
    
        submitReview()
        {
            let checkedIMG = []
            let HTMLImageTemplate = []
            let imagesID = []
            
            for (let image of this.images) {
                if (!image.description || !image.title)
                    continue
                
                imagesID.push(image.id)

                HTMLImageTemplate += `
                <li>
                <input type='checkbox' id='image${image.id}' name='image' class='peer hidden'>
                <label for='image${image.id}' class='inline-flex peer-checked:bg-red-200'>
                    <img src='/storage/photos/${image.name}' class='p-2 w-24 h-24 bg-contain border border-gray-300'>
                </label>
                </li>
                `
            }

            if(HTMLImageTemplate.length <= 0)
                HTMLImageTemplate = "<div class='flex flex-col justify-center'><p class='uppercase text-black text-bold'>empty image</p> <span class=' text-light text-gray-400'> you need to fill all detail! </span></div>"
    
            Swal.fire({
                title: "Select file to review",
                icon: "info",
                html: "<ul class='flex justify-center gap-5'>" +HTMLImageTemplate+ "</ul>",
                confirmButtonText:  `submit`,
                preConfirm: async () => {
                    try {
                        if(imagesID.length <= 0){
                            $wire.callSessionStatus();
                            throw new Error("There is no image")
                            
                        }
                        imagesID.forEach((id) => {
                            
                            let data = document.querySelector(`#image${id}`)

                            if(data.checked)
                                checkedIMG.push(id);
                        })

                        $wire.reviewImages(checkedIMG)

                    } catch (error) {
                        console.log(error)
                    }
                },
            });
        },
    }));
    </script>
    @endscript
</main>