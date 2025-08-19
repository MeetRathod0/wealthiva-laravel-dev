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
                        <h1 class="text-2xl font-bold mb-2 text-white">User List ({{ $users->count() }})</h1>
                    </div>
                </div>

                <!-- Detailed Income Table -->
                <div class="overflow-x-auto">
                    <table class="w-full display" id="userTable">
                        <thead>
                            <tr class="text-left text-sm text-gray-300 border-b border-white/10">
                                <th class="pb-3 font-medium">Id</th>
                                <th class="pb-3 font-medium">Name</th>
                                <th class="pb-3 font-medium">Email</th>
                                <th class="pb-3 font-medium">Contact</th>
                                <th class="pb-3 font-medium">Created At</th>
                                <th class="pb-3 font-medium">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="user in userData" class="text-sm text-white border-b border-white/10">
                                <td class="py-3">[[ user.wg_id ]]</td>
                                <td class="py-3">[[ user.fullname ]]</td>
                                <td class="py-3">[[ user.email ]]</td>
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
                                    <a v-if="user.is_active==1"
                                        v-on:click="toggleUserStatus(user.id,user.is_active,user.fullname)"
                                        class="status-badge text-xs font-medium py-1 px-2 rounded-full">
                                        Active</a>
                                    <a v-if="user.is_active==0"
                                        v-on:click="toggleUserStatus(user.id,user.is_active,user.fullname)"
                                        class="status-badge-inactive text-xs font-medium py-1 px-2 rounded-full">
                                        Inactive</a>



                                </td>
                                <td>
                                    <a :href="'/admin/user-profile/' + user.id"
                                        class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-1 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500 h-8 w-8 justify-center">
                                        <i class='bx bxs-edit bx-xs'></i>
                                    </a>
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

                async toggleUserStatus(id, stat, name) {

                    const status = stat === 1 ? 'Deactivate' : 'Activate'; // Toggle status
                    const url = '/api/updateuserstatus';
                    const data = {
                        id: id
                    };
                    let conf = false
                    await Swal.fire({
                        title: "Confirmation",
                        text: "Do you want to " + status + " " + name + "?",
                        showDenyButton: true,
                        background: 'oklch(20.5% 0 0)',
                        color: 'white',
                        confirmButtonText: "Yes",
                        denyButtonText: `No`,
                        customClass: {
                            confirmButton: 'my-custom-confirm-button',
                            cancelButton: 'my-custom-cancel-button'
                        }
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            conf = true;

                        } else if (result.isDenied) {

                        }
                    });
                    if (conf == false) {
                        return;
                    }

                    await axios.post(url, data, {
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        withCredentials: true
                    })
                        .then(response => {
                            this.userData = this.userData.map(user => {
                                if (user.id === id) {
                                    user.is_active = stat === 1 ? 0 : 1; // Toggle status
                                }
                                return user;
                            });
                            Swal.fire({
                                title: "Saved!",
                                text: "User status has been updated.",
                                icon: "success",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white'
                            });
                        })
                        .catch(error => {
                            console.error('Error updating user status:', error);
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