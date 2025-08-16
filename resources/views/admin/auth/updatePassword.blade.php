@extends('admin.layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-[340px]">
        <!-- Reduced max width -->
        <!-- Login Card -->
        <div class="login-card text-white p-8 rounded-xl" id="appCapsule">
            <!-- Reduced padding -->
            <!-- Compact Header -->
            <div class="mb-6 text-center">
                <!-- Brand Logo -->
                <div class="mb-6 flex justify-center">
                    <img src="{{ asset('logo.png') }}" alt="Brand Logo" class="h-16 w-auto rounded-md">
                </div>
                <!-- Reduced margin -->
                <h1 class="text-xl font-bold">CHANGE PASSWORD</h1>
                <!-- Smaller text -->
            </div>

            <!-- Compact Form -->
            <form class="space-y-4">


                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-200 mb-1">
                        <!-- Smaller text -->
                        PASSWORD
                    </label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" id="password" v-model="user_data.password"
                            v-on:blur="validateField('password')"
                            class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none pr-10"
                            placeholder="••••••••" />
                        <button type="button" class="absolute right-2 top-2 text-xs text-gray-300 font-medium"
                            @click="showPassword = !showPassword">
                            <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg v-else fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16" id="Flat"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.647 10.051a0.75 0.75 0 1 1 -1.299 0.75L12.331 9.039a7.938 7.938 0 0 1 -1.835 0.842l0.324 1.839a0.75 0.75 0 1 1 -1.477 0.261l-0.316 -1.791a8.775 8.775 0 0 1 -2.059 -0.001l-0.316 1.791a0.75 0.75 0 0 1 -1.477 -0.261l0.324 -1.84a7.938 7.938 0 0 1 -1.833 -0.842l-1.024 1.774a0.75 0.75 0 0 1 -1.299 -0.75l1.116 -1.933a9.563 9.563 0 0 1 -1.043 -1.102 0.75 0.75 0 0 1 1.167 -0.943C3.566 7.3 5.304 8.75 8 8.75c2.696 0 4.434 -1.45 5.417 -2.667a0.75 0.75 0 1 1 1.167 0.943 9.563 9.563 0 0 1 -1.045 1.104Z" />
                            </svg>


                        </button>
                        <span class="text-xs text-red-500">[[ errors.password ]]</span>

                    </div>
                </div>
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-200 mb-1">
                        <!-- Smaller text -->
                        CONFIRM PASSWORD
                    </label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" id="password" v-model="user_data.confirm_password"
                            v-on:blur="validateField('confirm_password')"
                            class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none pr-10"
                            placeholder="••••••••" />
                        <button type="button" class="absolute right-2 top-2 text-xs text-gray-300 font-medium"
                            @click="showPassword = !showPassword">
                            <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg v-else fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16" id="Flat"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.647 10.051a0.75 0.75 0 1 1 -1.299 0.75L12.331 9.039a7.938 7.938 0 0 1 -1.835 0.842l0.324 1.839a0.75 0.75 0 1 1 -1.477 0.261l-0.316 -1.791a8.775 8.775 0 0 1 -2.059 -0.001l-0.316 1.791a0.75 0.75 0 0 1 -1.477 -0.261l0.324 -1.84a7.938 7.938 0 0 1 -1.833 -0.842l-1.024 1.774a0.75 0.75 0 0 1 -1.299 -0.75l1.116 -1.933a9.563 9.563 0 0 1 -1.043 -1.102 0.75 0.75 0 0 1 1.167 -0.943C3.566 7.3 5.304 8.75 8 8.75c2.696 0 4.434 -1.45 5.417 -2.667a0.75 0.75 0 1 1 1.167 0.943 9.563 9.563 0 0 1 -1.045 1.104Z" />
                            </svg>


                        </button>
                        <span class="text-xs text-red-500">[[ errors.confirm_password ]]</span>

                    </div>
                </div>
                <!-- Compact Sign In Button -->
                <button type="button" class="w-full btn-primary py-2 px-4 rounded-lg text-sm font-medium mt-3"
                    v-on:click="update_pass()">
                    <!-- Smaller button -->
                    SAVE
                </button>
            </form>

            <!-- Compact Divider -->
            <div class="relative my-4">


            </div>

        </div>
    </div>

    <script>


        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const { createApp, ref, onMounted, computed } = Vue;



        const app = createApp({
            setup() {
                const user_data = ref({
                    id: `{{ $pwd->id }}`,
                    user_id: `{{ $pwd->user_id }}`,
                    password: '',
                    confirm_password: ''
                });

                const errors = ref({
                    id: '',
                    password: '',
                    confirm_password: ''
                });

                const validateField = (field) => {
                    switch (field) {

                        case 'password':
                            if (!user_data.value.password) {
                                errors.value.password = 'Password is required!';
                            } else {
                                errors.value.password = '';
                            }
                            break;
                        case 'confirm_password':
                            if (!user_data.value.confirm_password) {
                                errors.value.confirm_password = 'Confirm Password is required!';
                            } else if (user_data.value.confirm_password !== user_data.value.password) {
                                errors.value.confirm_password = 'Passwords do not match!';
                            } else {
                                errors.value.confirm_password = '';
                            }
                    }
                };

                const showPassword = ref(false);

                // must return 
                return {
                    user_data,
                    errors,
                    showPassword,
                    validateField,
                }
            },
            methods: {
                async update_pass() {
                    const url = '/api/user-password-update/';

                    const data = this.user_data;
                    // Check if any field is empty
                    if (Object.values(data).some(e => !e)) {
                        Object.keys(data).forEach(field => {
                            this.validateField(field);
                        });
                        return;
                    }

                    Swal.fire({
                        title: '',
                        background: 'oklch(20.5% 0 0)',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    // Show loading state
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
                                title: "Success",
                                text: "Password updated successfully!",

                            }).then(() => {
                                window.location.href = '/login';
                            });
                            // Redirect to login page;

                            // Optionally trigger any follow-up like:
                            // this.fetch_active_users();
                        })
                        .catch(error => {
                            Swal.close();
                            Swal.fire({
                                background: 'oklch(20.5% 0 0)',
                                color: 'white',
                                icon: "error",
                                title: "Oops...",
                                text: "Not able to update password!",
                            });
                        });

                },

            },
            // preinit data
            data() {

            },

            mounted() {

            }

        });
        app.config.compilerOptions = {
            isCustomElement: (tag) => tag === 'ion-icon' || tag === 'box-icon',
        };
        app.config.compilerOptions.delimiters = ['[[', ']]'];
        app.mount('#appCapsule');
    </script>
@endsection