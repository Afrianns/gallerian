<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        <title>{{ $title ?? 'Gallerian' }}</title>
    </head>
    <body x-data='nav' class="bg-lightTeal text-darkPurple font-kanit" x-on:hide-overflow-parent="setHideScrollbar" :class="{'overflow-hidden' : hideScrollbar}">
        
        @if (session('success'))
            <div class="bg-green-400 py-2 px-6 flex gap-x-3 items-center" x-show="hideSession" x-init="setTimeout(() => hideSession = false, 3000)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                <h1 class="text-green-800">{{ session('success') }}</h1>
            </div>
        @endif

        @if (session('failed'))
            <div class="bg-red-400 py-2 px-6 flex gap-x-3 items-center" x-show="hideSession" x-init="setTimeout(() => hideSession = false, 3000)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                <h1 class="text-red-800">{{ session('failed') }}</h1>
            </div>
        @endif

        <nav class="bg-white rounded-full border border-gray-500/20 p-1 my-8 w-fit max-w-900 mx-auto shadow-md sticky top-8 z-10">
            <ul class="flex items-center gap-x-1">
                <a wire:navigate href="/su-admin" title="Pending Review" class="admin-nav hover:bg-purple-100 @if (request()->is('su-admin')) bg-purple-100 @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mx-auto"><path d="M19 10H5c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2zM5 20v-8h14l.002 8H5zM5 6h14v2H5zm2-4h10v2H7z"></path></svg>
                </a>
                <a wire:navigate href="/su-admin/rejected" title="Rejected Images" class="admin-nav hover:bg-purple-100 @if (request()->is('su-admin/rejected')) bg-purple-100 @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mx-auto"><path d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"></path><path d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"></path></svg>
                </a>
                <a wire:navigate href="/su-admin/approved" title="Published Images" class="admin-nav hover:bg-purple-100 @if (request()->is('su-admin/approved')) bg-purple-100 @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mx-auto"><path d="M21 5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5zM5 19V5h14l.002 14H5z"></path><path d="M7 7h1.998v2H7zm4 0h6v2h-6zm-4 4h1.998v2H7zm4 0h6v2h-6zm-4 4h1.998v2H7zm4 0h6v2h-6z"></path></svg>
                </a>
                <span class="h-5 w-[.2px] bg-gray-200 mx-1"></span>
                <a wire:navigate href="#" title="Logout" class="admin-nav hover:bg-red-100 hover:fill-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mx-auto"><path d="m2 12 5 4v-3h9v-2H7V8z"></path><path d="M13.001 2.999a8.938 8.938 0 0 0-6.364 2.637L8.051 7.05c1.322-1.322 3.08-2.051 4.95-2.051s3.628.729 4.95 2.051 2.051 3.08 2.051 4.95-.729 3.628-2.051 4.95-3.08 2.051-4.95 2.051-3.628-.729-4.95-2.051l-1.414 1.414c1.699 1.7 3.959 2.637 6.364 2.637s4.665-.937 6.364-2.637c1.7-1.699 2.637-3.959 2.637-6.364s-.937-4.665-2.637-6.364a8.938 8.938 0 0 0-6.364-2.637z"></path></svg>
                </a>
            </ul>
        </nav>
        <main class="mx-5">
            {{ $slot }}
        </main>
    </body>
</html>
