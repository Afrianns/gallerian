<main x-data="detailImg" class="max-w-[600px] mx-auto mb-10 h-full">
    <div class="p-5 bg-white rounded-md shadow-md border mt-10">
        <div class="flex justify-between items-center mb-5">
            <div class="flex gap-x-3 items-center">
                <img src="{{ $image->user->avatar }}" class="w-10 h-10" alt="">
                <div>
                    <a class="text-md font-medium hover:underline" href="/profile/{{ $image->user->UUID }}">{{ $image->user->name }}</a>
                    <a href="mailto:{{ $image->user->email }}" class="text-base font-light block">{{ $image->user->email }}</a>
                </div>
            </div>
            <livewire:components.like  redirect="/image/{{ $image->id }}" :id="$image->id" />
        </div>

        <img src="/storage/photos/{{ $image->name }}" class="rounded-md" alt="">
        <p class="text-gray-600 font-thin">img_name: {{ $image->name }}</p>
        
        <h1 class="mt-5 text-2xl font-medium">{{ $image->title }}</h1>
        <p class="w-3/4 font-light">
            {{ $image->description }}
        </p>
    </div>
    <hr class="my-4 border-t border-gray-500">
    <livewire:components.comments :id="$image->id" />
</main>
@script
<script>
    // detailImg
    Alpine.data('detailImg', () => ({}))
</script>
@endscript
