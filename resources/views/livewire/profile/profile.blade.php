<main class="max-w" x-data="bannerUploader">
    @auth
    @if ($profile->UUID === Auth::user()->UUID)
        <div x-show="popup" class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex justify-center items-center z-20">
            <div class="bg-white py-6 px-5 rounded-lg shadow-md border border-purple-100 w-full max-w-[900px]" x-on:click.outside="uploader" x-cloak>
                <h1 class="mb-4 py-0 text-lg font-medium font-kumbhSans">Upload Banner</h1>
                <form wire:submit="uploadBanner"
                    x-on:livewire-upload-finish="finished = true"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                    @csrf
                    <div x-show="!tempImage">
                        <div class="border-purple-300 border-dashed bg-purple-50 c-hover border-2 rounded-lg h-52 flex flex-col justify-center w-full relative">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="4rem" height="4rem" viewBox="0 0 24 24" class="mx-auto fill-gray-400"><path d="M13 19v-4h3l-4-5-4 5h3v4z"></path><path d="M7 19h2v-2H7c-1.654 0-3-1.346-3-3 0-1.404 1.199-2.756 2.673-3.015l.581-.102.192-.558C8.149 8.274 9.895 7 12 7c2.757 0 5 2.243 5 5v1h1c1.103 0 2 .897 2 2s-.897 2-2 2h-3v2h3c2.206 0 4-1.794 4-4a4.01 4.01 0 0 0-3.056-3.888C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.611 5.757 9.15 3.609 9.792 2 11.82 2 14c0 2.757 2.243 5 5 5z"></path></svg>
                                <p class="pointer-none text-gray-400 ">Drag and drop files here <br /> or <span class="text-blue-400 hover:underline">click the area</span> to upload from your computer</p>
                            </div>
                            <input type="file" x-on:change="banner" wire:model="banner" class="absolute w-full h-full opacity-0">
                        </div>
                    </div>
                    <div x-show="tempImage">
                        <div class="h-52 w-full overflow-hidden rounded-lg bg-cover bg-center relative" :style="'background-image: url('+tempImage+')'">
                            <span x-on:click="deleteTempBanner" class="absolute top-5 right-5 bg-red-100/50 py-1 px-3 text-red-700 rounded cursor-pointer hover:underline hover:bg-red-200/50">Delete</span>
                        </div>  
                    </div>
                    
                    <div class="flex justify-between mt-3 text-sm">
                        <p class="text-gray-400">Max size: 5MB</p>
                        <p class="text-gray-400">Recomended Size: 1080x250</p>
                    </div>
                    <section class="mt-5 w-full" wire:loading wire:target="banner">
                        <div class="flex justify-between my-1 text-sm">
                            <p class="text-gray-400">Loading</p>
                            <p class="text-gray-400" x-text="progress+'%'"></p>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full relative my-2">
                            <span class="bg-purple-500 h-full absolute rounded-full" :style="'width:'+progress+'%;'"></span>
                        </div>
                    </section>

                    <div class="flex justify-end mt-5">
                        <template x-if="tempImage && finished">
                            <button type="submit" class="py-1 px-7 bg-purple-700 rounded-full text-white border-2 border-purple-700 hover:bg-purple-500">Update</button>
                        </template>
                        
                        <template x-if="!tempImage || !finished">
                            <span class="py-1 px-7 bg-purple-700/50 border-2 border-dashed border-purple-600 rounded-full text-white hover:bg-purple-500/50 cursor-not-allowed">Update</span>
                        </template>

                    </div>
                </form>
            </div>
        </div>
    @endif
    @endauth
    <div class="px-5 border flex justify-center border-gray-200 rounded shadow w-full h-52 bg-no-repeat bg-ccover bg-center relative" style="background-image: url('{{ isset($profile->banner) ? $profile->banner : "/storage/banner/default.jpg"  }}')">
        @auth
        @if ($profile->UUID === Auth::user()->UUID)
            <div x-on:click="uploader">
                <livewire:components.editor-link info="update banner">
            </div>                
        @endif
        @endauth
        <div class="bg-white rounded-full p-2 w-40 h-40 absolute -bottom-16 overflow-hidden bg-no-repeat bg-cover border-8 border-white z-10 bg-center" style="background-image: url('{{ $profile->avatar }}')">
        </div>
    </div>
    <div class="bg-white border border-gray-200 h-fit pb-10 pt-16 text-center relative rounded">
        @auth
        @if ($profile->UUID === Auth::user()->UUID)
        <a wire:navigate href="/profile/{{ Auth::user()->UUID }}/settings">
            <livewire:components.editor-link>
        </a>            
        @endif
        @endauth

        <h1 class="text-xl w-1/2 mx-auto my-2">{{ $profile->name }}</h1>
        @if (!Auth::check() || Auth::check() && Auth::user()->type == "user")
            <p class="text-gray-400 text-sm w-1/2 mx-auto">
                @if(strlen($profile->bio) > 0)
                    {{ $profile->bio }}
                @else
                    I'm an annonymous person whon never share any thing even a single word/text. But in anyway i graphic design, illustrator.
                @endif
            </p>
            @if(strlen($profile->website) > 0)
                <div class="my-5">
                    <a href="{{ $profile->website }}" target="_blank" class="mx-auto block w-fit p-1 bg-purple-50 rounded-full hover:bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm7.931 9h-2.764a14.67 14.67 0 0 0-1.792-6.243A8.013 8.013 0 0 1 19.931 11zM12.53 4.027c1.035 1.364 2.427 3.78 2.627 6.973H9.03c.139-2.596.994-5.028 2.451-6.974.172-.01.344-.026.519-.026.179 0 .354.016.53.027zm-3.842.7C7.704 6.618 7.136 8.762 7.03 11H4.069a8.013 8.013 0 0 1 4.619-6.273zM4.069 13h2.974c.136 2.379.665 4.478 1.556 6.23A8.01 8.01 0 0 1 4.069 13zm7.381 6.973C10.049 18.275 9.222 15.896 9.041 13h6.113c-.208 2.773-1.117 5.196-2.603 6.972-.182.012-.364.028-.551.028-.186 0-.367-.016-.55-.027zm4.011-.772c.955-1.794 1.538-3.901 1.691-6.201h2.778a8.005 8.005 0 0 1-4.469 6.201z"></path></svg>
                    </a>
                </div>
            @endif
            <ul class="flex justify-center gap-x-10 mt-5 text-md">
                <li class="flex gap-x-1 font-medium">
                    <span>{{ count($images) }}</span>
                    @if(count($images) > 1)
                        <p>Images</p>
                    @else
                        <p>Image</p>
                    @endif
                </li>
                <li class="flex gap-x-1 font-medium">
                    <span>0</span>
                    <p>Like</p>
                </li>
            </ul>
        @endif
        @if (Auth::check() && Auth::user()->type == "admin")
            <h3 class="text-md text-gray-700 mt-5">This is Admin</h3>
            <p class="text-sm text-gray-500">Admin cannot like or post images!</p>
        @endif
    </div>
    <livewire:components.images-showcase :id="$profile->id"/>
    {{-- @if (count($images) > 0)
        <div class="grid mt-16">
            @foreach ($images as $image)
                <div class="grid-sizer"></div>
                <section class="grid-item border border-gray-100 bg-white shadow rounded h-fit relative overflow-hidden">
                    <div class="bg-gray-100 cursor-pointer">
                        <img src="/storage/photos/{{ $image->name }}" class="hover:scale-105 transition-all duration-200" alt="">
                    </div>
                    <div class="bg-black/25 absolute bottom-0 left-0 right-0 py-2 px-3 ">
                        <p class="text-white capitalize">hello world</p>
                    </div>
                </section>
            @endforeach
        </div>
    @else
        <div class="text-center my-10">
            <div class="icon-style">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm6 0h4v4h-4zM4 10h4v4H4z"></path></svg>
            </div>
            <h1 class="font-semibold uppercase opacity-75 text-xl">There are no published images</h1>
            <p class="text-md opacity-50">Please upload best images you have ever created and submit for review; show your creativity</p>
        </div>
    @endif --}}
</main>

@script
<script>
    Alpine.data('bannerUploader', () => ({
        
        popup: false,
        tempImage: '',

        finished: false, 
        progress: 0,

        uploader(){
            $dispatch('overflowhid');
            this.popup = !this.popup;
        },

        banner(e){
            this.tempImage = URL.createObjectURL(e.target.files[0])
        },

        deleteTempBanner() {
            this.finished = false;
            this.tempImage = '';
            $wire.cleanModel();
        }
    }))
</script>
@endscript