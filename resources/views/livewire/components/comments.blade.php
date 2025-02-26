<div x-data="comments">
    <div class="bg-white py-2 px-3 rounded-md border shadow-md mb-100">
        <h2 class="font-medium text-lg mb-2 underline">Comment</h2>
        @if (Auth::check())
            <form wire:submit="save">
                <textarea name="comment" id="comment" class="resize-y min-h-32 profile-input" wire:model="inputComment"></textarea>
                <button type="submit" class="py-1 px-6 bg-purple-700 rounded-full text-white hover:bg-purple-500">Post</button>
                @error('inputComment')            
                    <p class="bg-red-500 text-red-50 rounded mt-3 py-1 px-3">{{ $message }}</p>
                @enderror
            </form>
        @else
            <div class="flex justify-center my-2">
                <h1>You need to login/register to leave a comment!</h1>
            </div>
        @endif
    </div>
    <div class="mt-5 bg-white py-2 px-3 rounded-md border shadow-md">
        <h2 class="font-medium text-lg mb-2 underline">All Comments</h2>
        @if ($totalComments > 0)
            <livewire:components.child-comments :id="$imageID" :gap="0"/>
        @else
            <div class="mx-auto text-center my-5">
                <img src="{{ url('assets/comments.svg') }}" class="w-1/2 my-5 mx-auto" alt="">
                <h1 class="text-xl font-medium">There is no comment found</h1>
                <p class="text-md font-light text-gray-600">Be the first to comment!</p>
            </div>
        @endif
    </div>
</div>
@script
<script>
    // detailImg
    Alpine.data('comments', () => ({
        reply: []
    }))
</script>
@endscript
