
<div class="bg-[#fbfeff] shadow-sm py-4 border-t-2">
    <nav class="flex gap-x-8 text-gray-500 max-w">
        <a wire:navigate href="/upload" class="upload-menu @if (request()->is('upload')) text-darkPurple bg-lightTeal @endif">Upload</a>  
        <a wire:navigate href="/upload/review" class="upload-menu @if (request()->is('upload/review')) text-darkPurple bg-lightTeal @endif">Pending</a> 
        <a wire:navigate href="/upload/publish" class="upload-menu @if (request()->is('upload/publish')) text-darkPurple bg-lightTeal @endif">Publish</a>   
        <a wire:navigate href="/upload/reject" class="upload-menu @if (request()->is('upload/reject')) text-darkPurple bg-lightTeal @endif">Reject</a>    
    </nav>
</div>
