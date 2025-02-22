<main class="mx-auto md:w-[720px]" x-data="avatarUploader">
    @if ($errors->any())
        <div class="bg-red-500 rounded">
            <ul class="my-5 mx-10 list-disc py-2">
                @foreach ($errors->all() as $error)
                    <li class="text-red-50">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w bg-white border border-gray-100 rounded-lg my-5 mt-8 shadow">
        <h1 class="my-6 mx-5 font-semibold text-xl">SETTINGS</h1>
        <form wire:submit="save" class="pb-8 px-5">
            @csrf
            <section>
                <p class="font-normal text-lg">Avatar</p>
                <div class="relative bg-red-50 rounded-full w-52 h-52 bg-cover bg-no-repeat bg-center" :style="'background-image: url('+showAvatar()+')'">
                    {{-- <img :src="(tempImage == '') ? $wire.avatar : tempImage" class="bg-cover rounded-full w-40 h-40 my-2 border-2 border-dashed border-purple-600" alt=""> --}}
                    <input type="file" name="avatar" id="avatar" x-on:change="uploadAvatar" wire:model="newAvatar" class="absolute top-0 left-0 right-0 bottom-0 opacity-0 cursor-pointer">
                </div>
            </section>
            @error('newAvatar') <span class="error">{{ $message }}</span> @enderror
            <section class="my-3">
                <label for="name" class="font-normal text-lg">Name</label> <br>
                <input type="text" name="name" id="name" class="profile-input" wire:model="name">
            </section>
            @if (Auth::user()->type == "user")
                <section class="my-3">
                    <label for="bio" class="font-normal text-lg">Bio</label> <br>
                    <textarea name="bio" id="bio" class="resize-y min-h-32 profile-input" wire:model="bio"></textarea>
                </section>
                <section class="my-3">
                    <label for="website" class="font-normal text-lg">Website</label> <br>
                    <input name="website" id="website" class="profile-input" wire:model="website"></input>
                </section>
            @endif

            <div class="flex justify-between items-center mt-8">
                <a wire:loading.remove wire:target="save" class="text-semibold hover:underline" href="/profile/{{Auth::user()->UUID}}" wire:navigate>Back</a>
                <button type="submit" wire:loading.remove wire:target="save" class="py-2 px-8 bg-purple-700 rounded-full text-white hover:bg-purple-500">Update Profile</button>
            </div>
            <p class="text-md text-center" wire:loading wire:target="save">Loading...</p>
        </form>
    </div>
</main>
@script
<script>
    Alpine.data('avatarUploader', () => ({
        
        tempImage: '',
        
        showAvatar() {
            return (this.tempImage == '') ? $wire.avatar : this.tempImage
        },

        uploadAvatar(e) {
            this.tempImage = URL.createObjectURL(e.target.files[0])
        },
    }))
</script>
@endscript