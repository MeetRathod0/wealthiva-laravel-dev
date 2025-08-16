<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>@yield('title', 'Panel')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://cdn.tailwindcss.com"></script>
      <!--script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script-->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <script src="/assets/js/vue.global.js"></script>
      <script src="/assets/js/axios.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="/assets/js/jquery-3.7.1.js"></script>
      <script src="/assets/js/dataTables.js"></script>
      <script src="/assets/js/datatables.tailwindcss.js"></script>
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <style>
         ..my-custom-confirm-button {
  font-size: 1.3em;
  padding: 12px 24px;
  /* Add other styles like background-color, border-radius, etc. */
}

.my-custom-cancel-button {
  font-size: 1em;
  padding: 7px 15px;
}
      </style>
   </head>
   <body>
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
            <div class="main-panel">
               <div class="content-wrapper">

                  <div class="flex flex-row relative">
                        <!-- Sidebar with initial 'hidden' class on mobile -->
                        <div id="sidebar"
                              class="sidebar fixed top-0 left-0 bottom-0 max-md:max-w-[450px] w-full md:w-64 min-h-screen hidden md:block z-40 transition-all duration-300">
                              @include('admin.partials.sidebar')
                        </div>

                        <!-- Hamburger Menu Button (visible only on mobile) -->
                        <button id="hamburger" class="md:hidden fixed top-2 left-2 z-30 p-1.5 rounded-lg bg-transprent text-white">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                              </svg>
                        </button>

                        <!-- Main Content Area -->
                        <main class="ms-sm-auto px-4 md:px-6 md:ml-64 py-16 w-full transition-all duration-300">
                              @yield('content')
                        </main>
                     </div>
               </div>
               
            </div>
         </div>
         <!-- END MAIN BODY -->
      </div>
      <script>
         document.getElementById('logoutBtn').addEventListener('click', function () {
             console.log("Logout button clicked");
            axios.post('/api/logout',[],{headers: {
                       'Content-Type': 'application/json'
                   },
                   withCredentials: true }).then(function (response) {
                window.location.href = "/login";
                //console.log(response);
            }).catch(function (error) {
               //console.error('Logout failed:', error);
               window.location.href = "/login";
            });
         });
      </script>
       <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            const closeBtn = document.getElementById('closeBtn');

            // Toggle sidebar visibility
            hamburger.addEventListener('click', function () {
                if (sidebar.classList.contains('hidden')) {
                    sidebar.classList.remove('hidden');
                    sidebar.classList.add('block');
                }
            });

            closeBtn.addEventListener('click', function () {
                if (sidebar.classList.contains('block')) {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('block');
                }
            });
        });
    </script>
   </body>
</html>