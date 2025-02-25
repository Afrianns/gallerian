<div x-data="comments">
    <div class="bg-white py-2 px-3 rounded-md border shadow-md mb-100">
        <h2 class="font-medium text-lg mb-2 underline">Comment</h2>
        <form wire:submit="save">
            <textarea name="comment" id="comment" class="resize-y min-h-32 profile-input" wire:model="inputComment"></textarea>
            <button type="submit" class="py-1 px-6 bg-purple-700 rounded-full text-white hover:bg-purple-500">Post</button>
            @error('inputComment')            
                <p class="bg-red-500 text-red-50 rounded mt-3 py-1 px-3">{{ $message }}</p>
            @enderror
        </form>
    </div>
    <div class="mt-5 bg-white py-2 px-3 rounded-md border shadow-md">
        <h2 class="font-medium text-lg mb-2 underline">All Comments</h2>
        {{-- @foreach ($comments as $comment)
            <div class="border rounded-md py-2 px-4 mt-2">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2">
                        <span class="py-2">{{ $comment->user->name }}</span>
                        <span class="text-xs text-gray-500">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans(); }}</span>
                    </div>
                    <p class="text-gray-500 text-xs">{{ Carbon\Carbon::parse($comment->created_at)->format("d F Y")}}</p>
                </div>
                <p class="text-md">{{ $comment->comment }}</p>
                <button class="py-1 px-2 rounded-md bg-gray-200 hover:bg-gray-300 mt-3 text-xs" x-on:click="reply[{{$comment->id}}] = !reply[{{$comment->id}}]">reply</button>
            </div>
            <form wire:submit="save" class="flex items-start gap-x-3 mt-2" x-show="reply[{{$comment->id}}]">
                <textarea name="comment" id="comment" class="resize-none profile-input" wire:model="inputComment"></textarea>
                <button type="submit" class="py-1 px-6 bg-purple-700 rounded-full text-white hover:bg-purple-500">Post</button>
                @error('inputComment')            
                    <p class="bg-red-500 text-red-50 rounded mt-1 py-1 px-2">{{ $message }}</p>
                @enderror
            </form>
            @endforeach --}}
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
