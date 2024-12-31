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
    <body class="bg-lightTeal text-darkPurple font-kanit" :class="{'overflow-hidden' : isHidden}" x-data="nav" @check="hideScroll">
        @if (request()->session()->has("status"))
            <div class="bg-orange-400 py-2 px-5 transition-all duration-200" x-show="hideSession" x-init="setTimeout(() => hideSession = false, 3000)">
                <p class="text-orange-900">{!! request()->session()->get('status') !!}</p>
            </div>
        @endif
        <nav class="bg-white py-4 shadow-sm">
            <div class="flex justify-between px-2 max-w">
                <h1 class="font-kalnia font-bold text-3xl leading-normal">Gallerian</h1>
                <nav class="flex gap-x-5 items-center">
                    <a wire:navigate href="/" class="hover:underline @if (request()->is('/')) underline @endif">Home</a>
                    <a wire:navigate href="/gallery" class="hover:underline @if (request()->is('gallery')) underline @endif">Gallery</a>

                    @if (Auth::check())
                        <a wire:navigate href="/upload" class="hover:underline @if (request()->is('upload/*') || request()->is('upload')) underline @endif">Upload</a>
                        <div class="relative">
                            <div class="flex gap-x-1 items-center cursor-pointer bg-purple-50 hover:bg-purple-100 p-1 rounded-full bg-center bg-cover" @click="profile">
                                <img src="{{ Auth::user()->avatar }}" referrerpolicy="no-referrer" class="w-10 h-10 rounded-full" alt="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
                            </div>

                            <div x-show="open" @click.outside="profile" x-cloak class="absolute bg-white p-3 rounded z-20 border border-gray-300 right-0 top-12 w-32">
                                <section class="flex gap-x-2 py-2 rounded px-2 hover:bg-purple-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg>
                                    <a href="/profile/{{ Auth::user()->UUID }}" wire:navigate>Profile</a>
                                </section>
                                <form action="/logout" method="post" class="flex gap-x-2 py-2 hover:bg-red-100 rounded px-2 text-red-700 fill-red-700">
                                    @csrf
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="m2 12 5 4v-3h9v-2H7V8z"></path><path d="M13.001 2.999a8.938 8.938 0 0 0-6.364 2.637L8.051 7.05c1.322-1.322 3.08-2.051 4.95-2.051s3.628.729 4.95 2.051 2.051 3.08 2.051 4.95-.729 3.628-2.051 4.95-3.08 2.051-4.95 2.051-3.628-.729-4.95-2.051l-1.414 1.414c1.699 1.7 3.959 2.637 6.364 2.637s4.665-.937 6.364-2.637c1.7-1.699 2.637-3.959 2.637-6.364s-.937-4.665-2.637-6.364a8.938 8.938 0 0 0-6.364-2.637z"></path></svg>
                                    <button type="submit">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/auth/redirect" class="btn-style">Login</a>
                    @endif
                </nav>
            </div>
        </nav>
        {{ $slot }}
    </body>
</html>
