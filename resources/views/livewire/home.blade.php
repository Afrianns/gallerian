<main class="mx-auto" x-data='home' x-cloak>
    <section class="h-[500px] w-full bg-gradient-to-b  from-[#05FFF7] to-purple-500 relative overflow-hidden">
        <div class="max-w flex flex-col justify-center text-center align-middle h-full items-center z-10 relative">
            <h1 class="text-5xl font-kumbhSans font-extrabold w-4/5 leading-snug  mix-blend-darken">FIND THE MOST CREATIVE DESIGN YOU HAVE EVER SEEN </h1>
            <div class="flex justify-center gap-x-4 mt-5 items-center">
                {{-- <a class="btn-style" href="/auth/redirect">Getting Started</a> --}}
                <p class="hover:underline cursor-pointer">Explore Gallery</p>
            </div>
        </div>
        <div class="absolute top-0 flex justify-between gap-2 w-full mix-blend-overlay">
            <template x-for="(image, id) in overlayBannerImages" :key="id">
                <div class="relative w-[25%]" :style="'top: -'+image.topPos+'rem'">
                    <img :src="'/storage/placeholders/image' +image.imageID[0]+ '.png'" class="mb-2 w-full" alt="">
                    <img :src="'/storage/placeholders/image' +image.imageID[1]+ '.png'" class="mb-2 w-full" alt="">
                    <img :src="'/storage/placeholders/image' +image.imageID[2]+ '.png'" class="mb-2 w-full" alt="">
                </div>
            </template>
        </div>
    </section>
    <section class="flex justify-center gap-x-10 my-36">
        <div class="w-3/12">
            <h2 class="w-fit text-3xl text-white bg-lightBlue font-kalnia font-bold py-3 px-6 rounded-full">1</h2>
            <h3 class="font-medium mt-5">Find Inspiration from People Around the world</h3>
            <p class="font-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat atque, explicabo.</p>
        </div>
        <div class="w-3/12">
            <h2 class="w-fit text-3xl text-white bg-lightBlue font-kalnia font-bold py-3 px-5 rounded-full">2</h2>
            <h3 class="font-medium mt-5">Showcase your creative works to the world</h3>
            <p class="font-light">Est natus sit laboriosam ipsam officiis. Quod beatae quisquam rerum sit cum facilis.</p>
        </div>
        <div class="w-3/12">
            <h2 class="w-fit text-3xl text-white bg-lightBlue font-kalnia font-bold py-3 px-5 rounded-full">3</h2>
            <h3 class="font-medium mt-5">Get Feedback by designer around the world</h3>
            <p class="font-light">Enim quis facere ipsum possimus odit, itaque corporis earum, harum tenetur rem.</p>
        </div>
    </section>
    <section class="relative h-[300px] bg-gradient-to-b  from-purple-500 to-[#05FFF7] overflow-hidden">
        <div class="absolute top-0 flex justify-between gap-2 w-full mix-blend-overlay rotate-12 -left-24">
            <template x-for="(image, id) in overlayCardImages" :key="id">
                <div class="relative w-[25%]" :style="'top: -'+image.topPos+'rem'">
                    <img :src="'/storage/placeholders/image' +image.imageID[0]+ '.png'" class="mb-2 w-full" alt="">
                    <img :src="'/storage/placeholders/image' +image.imageID[1]+ '.png'" class="mb-2 w-full" alt="">
                    <img :src="'/storage/placeholders/image' +image.imageID[2]+ '.png'" class="mb-2 w-full" alt="">
                </div>
            </template>
        </div>
        <div class="bg-black/10 top-0 left-0 right-0 bottom-0 absolute"></div>
        <div class="flex justify-center items-center h-full relative flex-col uppercase z-10"> 
            <h2 class="font-semibold text-3xl">Join with Million Artists around the World</h2>
            <p class="text-2xl font-semibold text-green-500">It's Free</p>

            {{-- <a class="btn-style mt-8" href="/auth/redirect">
                Register an Account
            </a> --}}
        </div>
    </section>

    <footer class="my-16 text-center">
        <p>Gallerian by <a href="http://hanif.rf.gd/" class="hover:underline">HanifNA</a></p>
    </footer>
</main>

@script
<script>
    Alpine.data('home', () => ({
        popup: false,
        overlayBannerImages: [
            {
                topPos: 13,
                imageID: [0,1,2],
            },
            {
                topPos: 7,
                imageID: [3,4],
            },
            {
                topPos: 9,
                imageID: [5,6,7],
            },
            {
                topPos: 5,
                imageID: [8, 9],
            },
            {
                topPos: 14,
                imageID: [10,11,12],
            },
            {
                topPos: 9,
                imageID: [13,14,15],
            },
        ],

        overlayCardImages: [
            {
                topPos: 13,
                imageID: [0,1,2],
            },
            {
                topPos: 10,
                imageID: [3,4],
            },
            {
                topPos: 8,
                imageID: [5,6,7],
            },
            {
                topPos: 5,
                imageID: [8, 9],
            },
            {
                topPos: 17,
                imageID: [10,11,12],
            }
        ]
    }))
</script>
@endscript