@extends('admin.layouts.app')

@section('content')
    <div class="w-full flex flex-col gap-6 items-center justify-center" id="appCapsule">
        <div class="w-full max-w-4xl">
            <!-- Wider container -->
            <!-- Income Card -->
            <div class="card text-white p-6 md:p-8 rounded-xl">
                <!-- Increased padding -->

                <!-- User Info Header -->
                <div class="flex flex-wrap justify-between items-start mb-8 gap-1">
                    <div>
                        <h1 class="text-2xl font-bold mb-2 text-white">Deposit Requests
                            ({{ $users->map(function ($user) {
        return $user->deposite_is_active == 2; })->count() }})</h1>
                    </div>
                </div>

                <!-- Detailed Income Table -->
                <div class="overflow-x-auto">
                    <table class="w-full display" id="userTable">
                        <thead>
                            <tr class="text-left text-sm text-gray-300 border-b border-white/10">
                                <th class="pb-3 font-medium">Id</th>
                                <th class="pb-3 font-medium">Name</th>
                                <th class="pb-3 font-medium">Amount</th>
                                <th class="pb-3 font-medium">Contact</th>
                                <th class="pb-3 font-medium">Created At</th>
                                <th class="pb-3 font-medium">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="user in userData" class="text-sm text-white border-b border-white/10">
                                <td class="py-3"><a :href="'/admin/user-profile/' + user.user_id">[[ user.wg_id ]]</a>
                                </td>
                                <td class="py-3">[[ user.fullname ]]</td>
                                <td class="py-3">$[[ user.amount ]]</td>
                                <td class="py-3">[[ user.phone ]]</td>
                                <td class="py-3">
                                    [[ new Date(user.created_datetime).toLocaleString('en-GB', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true
                                    })]]
                                </td>
                                <td class="py-3">
                                    <a v-if="user.deposite_is_active==1"
                                        class="status-badge text-xs font-medium py-1 px-2 text-black rounded-full bg-green-500">
                                        Accepted</a>
                                    <a v-if="user.deposite_is_active==2"
                                        class="status-badge text-xs font-medium py-1 px-2 text-black rounded-full bg-yellow-500">
                                        Pending</a>
                                    <a v-if="user.deposite_is_active==0"
                                        class="status-badge text-xs font-medium py-1 px-2 text-black rounded-full bg-red-500">
                                        Reject</a>


                                </td>
                                <td>


                                    <div class="inline-flex rounded-md shadow-xs" role="group">
                                        <button type="button" v-on:click="toggleUserStatus(user.id,1)"
                                            class="inline-flex items-center px-2 py-2 text-sm font-medium text-green-900 bg-transparent border border-green-900 rounded-s-lg hover:bg-green-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-green-500 focus:bg-green-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-green-700 dark:focus:bg-green-700">
                                            <i class='bx bx-check'></i>
                                        </button>
                                        <button type="button" v-on:click="toggleUserStatus(user.id,0)"
                                            class="inline-flex items-center px-2 py-2 text-sm font-medium text-red-900 bg-transparent border-t border-b border-red-900 hover:bg-red-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-red-500 focus:bg-red-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-red-700 dark:focus:bg-red-700">
                                            <i class="bx bx-x"></i>
                                        </button>
                                        <button type="button" v-on:click="toggleUserStatus(user.id,2)"
                                            class="inline-flex items-center px-2 py-2 text-sm font-medium text-yellow-900 bg-transparent border border-yellow-900 rounded-e-lg hover:bg-yellow-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-yellow-500 focus:bg-yellow-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-yellow-700 dark:focus:yellow-700">
                                            <i class='bx bx-loader-alt'></i>
                                        </button>
                                    </div>

                                </td>


                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" id="userData" value="{{ $users }}">

    <script>



        //const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const { createApp, ref, onMounted, computed, reactive } = Vue;
        const pathSegments = window.location.pathname.split('/');
        // Assuming the structure is: /register/WG002
        const referralCode = pathSegments[2];

        const app = createApp({
            setup() {
                const userData = ref(JSON.parse(document.getElementById('userData').value));
                // must return 
                return {
                    userData
                }

            },
            methods: {

                async toggleUserStatus(id, stat) {

                    const url = '/api/update-deposite-status';
                    const data = {
                        id: id,
                        status: stat
                    };


                    await axios.post(url, data, {
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        withCredentials: true
                    })
                        .then(response => {
                            this.userData = this.userData.map(user => {
                                if (user.id === id) {
                                    user.deposite_is_active = stat; // Toggle status
                                }
                                return user;
                            });
                            Swal.fire({
                                title: "Saved!",
                                text: "Deposite status has been updated.",
                                icon: "success",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white'
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to update deposite status.",
                                icon: "error",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white'
                            });
                        });

                },

            },
            // preinit data
            data() {
            },

            mounted() {
                this.userData = JSON.parse(document.getElementById('userData').value);
                // Initialize DataTable
                $('#userTable').DataTable({
                    responsive: true,

                });
            }

        });
        app.config.compilerOptions = {
            isCustomElement: (tag) => tag === 'ion-icon' || tag === 'box-icon',
        };
        app.config.compilerOptions.delimiters = ['[[', ']]'];
        app.mount('#appCapsule');
    </script>

@endsection