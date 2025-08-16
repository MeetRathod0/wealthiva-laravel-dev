@extends('admin.layouts.app')

@section('content')

    <div class="flex-1 flex-col gap-6" id="appCapsule">
        <!-- Profile Card -->
        <div class="profile-card text-white p-6 rounded-xl max-w-2xl mx-auto">
            <!-- Card Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold">User Profile</h2>

                <div class="flex justify-end gap-4">
                    @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                        <button v-on:click="update_profile"
                            class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-xs px-2 py-1 text-center inline-flex items-center me-1 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                            SAVE
                        </button>
                        <button v-on:click="updatePassword"
                            class="text-green-700 border border-green-700 hover:bg-green-700 hover:text-white focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-md text-xs px-2 py-1 text-center inline-flex items-center me-1 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:focus:ring-green-800 dark:hover:bg-green-500">
                            <i class="bx bx-key"></i>
                        </button>

                    @endif

                    <!--button id="copyTagBtn"
                                                                                                                                                                                      class="py-1 px-4 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 whitespace-nowrap">
                                                                                                                                                                                      Save
                                                                                                                                                                                      </button-->
                </div>
            </div>

            <!-- Profile Picture Placeholder -->
            <div class="flex justify-center mb-6">
                <div
                    class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-2xl font-bold">
                    {{ substr($user->fullname, 0, 1) ?? 'UK' }}
                </div>
            </div>

            <!-- User Information Grid -->
            <div class="space-y-4">
                <!-- Row 1 -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="info-label text-xs font-medium mb-1">USER ID</p>
                        <p class="info-value text-sm font-medium">{{ $user->wg_id }}</p>
                        <input type="hidden" name="id" value="{{ $user->id }}" v-model="user_data.id" />
                    </div>
                    <div>
                        <p class="info-label text-xs font-medium mb-1">USER NAME</p>
                        <input value="{{ $user->fullname }}" type="text" id="fullname" v-model="user_data.fullname"
                            class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none"
                            placeholder="Enter your fullname" />
                    </div>
                </div>

                <!-- Divider -->
                <div class="divider border-t my-2"></div>

                <!-- Row 2 -->
                <div>
                    <p class="info-label text-xs font-medium mb-1">EMAIL</p>
                    <!-- <p class="info-value text-sm font-medium">{{ $user->email }}</p> -->
                    <input value="{{ $user->email }}" type="email" id="email" v-model="user_data.email"
                        class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none"
                        placeholder="Enter your email" />
                </div>

                <!-- Divider -->
                <div class="divider border-t my-2"></div>

                <!-- Row 3 -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="info-label text-xs font-medium mb-1">MOBILE NO</p>
                        <!-- <p class="info-value text-sm font-medium">{{ $user->phone }}</p> -->
                        <input value="{{ $user->phone }}"
                            class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none text-white"
                            placeholder="+1 234 567 890" type="text" v-model="user_data.phone" />
                    </div>
                    <div>
                        <p class="info-label text-xs font-medium mb-1">SPONSOR ID</p>
                        <p class="info-value text-sm font-medium">{{ $sponser_id ?? 'YOU ARE PARENT' }}</p>
                    </div>
                </div>

                <!-- Divider -->
                <div class="divider border-t my-2"></div>

                <!-- Row 4 -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="info-label text-xs font-medium mb-1">
                            REGISTRATION DATE
                        </p>
                        <p class="info-value text-sm font-medium">{{ $user->created_datetime }}</p>
                    </div>
                    <div>
                        <p class="info-label text-xs font-medium mb-1">ACTIVATION DATE</p>
                        <p class="info-value text-sm font-medium">{{ $user->created_datetime }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        const { createApp, ref, onMounted, computed, reactive } = Vue;

        const app = createApp({
            setup() {
                const countries = ref([]);
                const user_data = ref({
                    id: `{{ $user->id }}`,
                    fullname: `{{ $user->fullname }}`,
                    email: `{{ $user->email }}`,
                    phone: `{{ $user->phone }}`
                });

                const errors = ref({
                    fullname: '',
                    email: '',
                    phone: ''
                });

                const validateField = (field) => {
                    switch (field) {
                        case 'fullname':
                            if (!user_data.value.fullname) {
                                errors.value.fullname = 'Full Name is required';
                            } else {
                                errors.value.fullname = '';
                            }
                            break;
                        case 'email':
                            if (!user_data.value.email) {
                                errors.value.email = 'Email is required';
                            } else if (!/\S+@\S+\.\S+/.test(user_data.value.email)) {
                                errors.value.email = 'Email is invalid';
                            } else {
                                errors.value.email = '';
                            }
                            break;

                        case 'phone':
                            if (!user_data.value.phone) {
                                errors.value.phone = 'Phone number is required';
                            } else if (!/^\+?[1-9]\d{1,10}$/.test(user_data.value.phone)) {
                                errors.value.phone = 'Phone number is invalid';
                            } else {
                                errors.value.phone = '';
                            }
                            break;

                    }
                };

                // must return 
                return {
                    user_data,
                    errors,
                    validateField
                }
            },
            methods: {

                async updatePassword() {
                    const url = '/api/generate-password-change-request';
                    const data = {
                        user_id: this.user_data.id,
                    };
                    await axios.post(url, data, {
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        withCredentials: true
                    })
                        .then(response => {
                            Swal.fire({
                                title: "Password Updated",
                                text: "New Password is " + response.data.new_password + ". Please change it after login.",
                                icon: "success",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white'
                            }).then(() => {
                                navigator.clipboard.writeText(response.data.new_password);

                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: "error",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white',
                                title: "Update Failed",
                                text: error.response.data.message || "An error occurred. Please try again.",
                            });
                        });
                },



                async update_profile() {
                    console.log("Updating user profile with data:", this.user_data);
                    const url = '/api/updateuserprofile';

                    // Check if any field is empty
                    if (Object.values(this.user_data).some(e => !e)) {
                        Object.keys(this.user_data).forEach(field => {
                            this.validateField(field);
                        });
                        return;
                    }

                    // Validate all fields: invalid values will be set in errors
                    if (Object.values(this.errors).some(e => !!e)) {
                        Object.keys(this.user_data).forEach(field => {
                            this.validateField(field);
                        });
                        return;
                    }

                    const data = this.user_data;

                    Swal.fire({
                        title: '',
                        background: 'oklch(20.5% 0 0)',
                        color: 'white',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    await axios.post(url, data, {
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        withCredentials: true
                    })
                        .then(response => {
                            Swal.close();
                            Swal.fire({
                                background: 'oklch(20.5% 0 0)',
                                color: 'white',
                                icon: "success",
                                title: "Profile Updated",
                                text: "",
                            });
                        })
                        .catch(error => {
                            Swal.close();
                            Swal.fire({
                                icon: "error",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white',
                                title: "Update Failed",
                                text: error.response.data.message || "An error occurred. Please try again.",
                            });
                        });

                },

            },
            // preinit data
            data() {

            },

            mounted() {
                //this.getSponserIdName();
            }

        });
        app.config.compilerOptions = {
            isCustomElement: (tag) => tag === 'ion-icon' || tag === 'box-icon',
        };
        app.config.compilerOptions.delimiters = ['[[', ']]'];
        app.mount('#appCapsule');
    </script>
@endsection