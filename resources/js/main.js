document.addEventListener("livewire:init", () => {
    Alpine.data("nav", () => ({
        open: false,
        hideSession: true,
        isHidden: false,
        hideScrollbar: false,

        profile() {
            this.open = !this.open;
        },

        statusAlert(data) {
            console.log(data);
            // $wire.on('status', (data) => {
            //     console.log(this.detail);
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "success",
                title: "<p class='text-md font-normal'> Hello </p>",
            });
            // });
        },

        hideScroll() {
            this.isHidden = !this.isHidden;
        },

        setHideScrollbar() {
            this.hideScrollbar = !this.hideScrollbar;
        },
    }));
});
