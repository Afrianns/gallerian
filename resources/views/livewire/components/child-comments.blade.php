<div x-data="comments" style="margin-left: {{ $marginLeft }}px">
    @if (count($comments) > 0)
        @foreach ($comments as $comment)
        <div class="border rounded-md py-2 px-4 mt-2">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-x-2">
                    <span class="py-2"> 
                        @if ($comment->user->type != "admin")
                            <a class="text-md hover:underline" href="/profile/{{ $comment->user->UUID }}">{{ $comment->user->name }}</a>  
                        @else
                            {{ $comment->user->name }}
                        @endif
                        @if ($comment->image->user_id == $comment->user_id)
                        <span class="comment-author-styles bg-indigo-300 text-indigo-800">Owner</span>
                    @endif 
                    @if ($comment->user->type == "admin")
                        <span class="comment-author-styles bg-zinc-300 text-zinc-800">Admin</span>
                    @endif
                </span>
                    <span class="text-xs text-gray-500">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans(); }}</span>
                </div>
                <p class="text-gray-500 text-xs">{{ Carbon\Carbon::parse($comment->created_at)->format("d F Y")}}</p>
            </div>
            <p class="text-md">{{ $comment->comment }}</p>
            <div class="flex items-center gap-x-2">
                @if (Auth::check())
                    <button class="py-1 px-3 rounded-md border border-gray-500 hover:bg-gray-200 mt-3 text-xs" x-on:click="reply[{{$comment->id}}] = !reply[{{$comment->id}}]">reply</button>
                    
                    @if (Auth::user()->id == $comment->user_id)
                    <button class="py-1 px-3 text-red-500 rounded-md border border-red-500 hover:bg-red-200 mt-3 text-xs" wire:click="deleteComment({{ $comment->id }})">Delete</button>
                    @endif
                @endif
            </div>
        </div>
        <form wire:submit="save({{ $comment->id }})" class="flex items-start gap-x-3 mt-2" x-show="reply[{{$comment->id}}]" x-cloak>
            <textarea name="comment" id="comment" class="resize-none profile-input" wire:model="inputComment.{{ $comment->id }}"></textarea>
            <button type="submit" class="py-1 px-6 bg-purple-700 rounded-full text-white hover:bg-purple-500">Post</button>
            @error('inputComment')            
                <p class="bg-red-500 text-red-50 rounded mt-1 py-1 px-2">{{ $message }}</p>
            @enderror
        </form>
        <livewire:components.child-comments :id="$comment->image_id" :gap="15" :commentID="$comment->id" />
        @endforeach
    @endif

</div>
@script
<script>
    // detailImg
    Alpine.data('comments', () => ({
        reply: []
    }))
</script>
@endscript
