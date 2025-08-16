<div class="container-scroller">

        <nav
            class="sidebar col-lg-12 col-12 fixed top-0 left-0 right-0 d-flex flex-row shadow p-2 flex justify-end md:ml-64 z-20">
            <span class="text-sm py-2 font-semibold text-white">
                @switch(auth()->user()->user_type_id)
                    @case(1)
                        Super Admin
                        @break

                    @case(2)
                        Admin
                        @break

                    @case(3)
                        Client
                        @break

                    @case(4)
                        Manager
                        @break

                    @default
                        Unknown Role
                @endswitch
    
        </span>
            <button class="text-gray-300 py-2 px-4 rounded-lg text-sm flex justify-center gap-2 item-center" id="logoutBtn">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
            </button>

        </nav>
       

        <!-- MAIN BODY -->
        <div class="container-fluid page-body-wrapper">

            <!-- <nav class="sidebar sidebar-offcanvas" id="sidebar"> -->
            <!-- ADMIN SIDEBAR -->
            <!-- <livewire:admin-sidebar /> -->
            <!-- END ADMIN SIDEBAR -->
            <!-- </nav> -->

            <div class="main-panel">
                <!-- ---BODY---- -->
                <div class="content-wrapper">