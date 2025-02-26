<main x-data="detailImg" class="max-w-[600px] mx-auto mb-10 h-full">
    <div class="p-5 bg-white rounded-md shadow-md border mt-10">
        <div class="mb-5 flex gap-x-3 items-center">
            <img src="{{ $image->user->avatar }}" class="w-10 h-10" alt="">
            <div>
                <a class="text-md font-medium hover:underline" href="/profile/{{ $image->user->UUID }}">{{ $image->user->name }}</a>
                <a href="mailto:{{ $image->user->email }}" class="text-base font-light block">{{ $image->user->email }}</a>
            </div>
        </div>

        <img src="/storage/photos/{{ $image->name }}" alt="">
        <p class="text-gray-600 font-thin">img_name: {{ $image->name }}</p>
        
        <h1 class="mt-5 text-2xl font-medium">{{ $image->title }}</h1>
        <p class="w-3/4 font-light">
            {{ $image->description }}
        </p>
    </div>
    <hr class="my-4 border-t border-gray-500">
    {{-- <div class="bg-white py-2 px-3 rounded-md border shadow-md mb-100">
        <h2 class="font-medium text-lg mb-2 underline">Comment</h2>
        <form wire:submit="save">
            <textarea name="comment" id="comment" class="resize-y min-h-32 profile-input" wire:model="comment"></textarea>
            <button type="submit" class="py-1 px-6 bg-purple-700 rounded-full text-white hover:bg-purple-500">Post</button>
            @error('comment')            
                <p class="bg-red-500 text-red-50 rounded mt-3 py-1 px-3">{{ $message }}</p>
            @enderror
        </form>
    </div> --}}
    <livewire:components.comments :id="$image->id" />
</main>
@script
<script>
    // detailImg
    Alpine.data('detailImg', () => ({
        
        inputMsg(val) {
            console.log(val)
        }
    }))
</script>
@endscript
