@extends('admin.layouts.auth')

@section('title', 'Admin Login')

@section('content')

    <div class="w-full max-w-3xl">
        <!-- Wider container -->
        <!-- Signup Card -->
        <div class="signup-card text-white p-8 rounded-xl" id="appCapsule">
            <!-- Header -->
            <div class="mb-8 text-center">
                <!-- Brand Logo -->
                <div class="mb-6 flex justify-center">
                    <img src="{{ asset('logo.png') }}" alt="Brand Logo" class="h-16 w-auto rounded-md">
                </div>
                <h1 class="text-2xl font-bold">Hello {{ auth()->user()->fullname }}, Welcome to WEALTHIVA</h1>
                <p>Please update email, phone and password.</p>
                <div class="w-20 h-1 bg-blue-400 mx-auto mt-3"></div>
            </div>

            <!-- Signup Form - Alternating Columns -->
            <form class="space-y-4 md:space-y-0 form-grid">
                <!-- Field 4 (Right Column) -->
                <div class="field-odd">
                    <label class="block text-xs font-medium text-gray-200 mb-1">
                        PLEASE ENTER EMAIL
                    </label>
                    <input type="email" v-on:blur="validateField('email')"
                        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none"
                        placeholder="your@email.com" v-model="user_data.email" />
                    <span class="text-xs text-red-500">[[ errors.email ]]</span>
                </div>

                <div class="field-even">
                    <label class="block text-xs font-medium text-gray-200 mb-1">
                        MOBILE NO
                    </label>
                    <input type="number" v-on:blur="validateField('phone')" min="0"
                        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none"
                        placeholder="9999999999" v-model="user_data.phone" />
                    <span class="text-xs text-red-500">[[ errors.phone ]]</span>
                </div>

                <!-- Field 5 (Left Column) -->
                <div class="field-odd">
                    <label class="block text-xs font-medium text-gray-200 mb-1">
                        PLEASE ENTER NEW PASSWORD
                    </label>
                    <input type="password" v-on:blur="validateField('password')"
                        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none"
                        placeholder="Create password" v-model="user_data.password" />
                    <span class="text-xs text-red-500">[[ errors.password ]]</span>
                </div>

                <!-- Field 6 (Right Column) -->
                <div class="field-even">
                    <label class="block text-xs font-medium text-gray-200 mb-1">
                        CONFIRM PASSWORD
                    </label>
                    <input type="password" v-on:blur="validateField('confirm_password')"
                        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none"
                        placeholder="Confirm password" v-model="user_data.confirm_password" />
                    <span class="text-xs text-red-500">[[ errors.confirm_password ]]</span>
                </div>

                <!-- Full Width Fields -->
                <!-- Country Search -->
                <div class="field-odd">
                    <label class="block text-xs font-medium text-gray-200 mb-1">
                        SEARCH BY COUNTRY OR CODE...
                    </label>
                    <select type="text" v-on:change="validateField('country')"
                        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none"
                        placeholder="Country name or code" v-model="user_data.country">
                        <option value="" disabled>Select a country</option>
                        <option v-for="country in countries" :key="country.cca2" :value="country.cca2"
                            style="color: black;">
                            [[ country.name ]]
                        </option>
                    </select>
                    <span class="text-xs text-red-500">[[ errors.country ]]</span>
                </div>



                <!-- Register Button -->
                <button type="button" class="full-width btn-primary py-2 px-4 rounded-lg text-sm font-medium mt-6"
                    v-on:click="register_user()">
                    SAVE CHANGES
                </button>
            </form>

        </div>
    </div>
    <script>
        //const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const { createApp, ref, onMounted, computed, reactive } = Vue;
        const pathSegments = window.location.pathname.split('/');
        // Assuming the structure is: /register/WG002
        const referralCode = pathSegments[2];

        const app = createApp({
            setup() {
                const countries = ref([]);
                const user_data = ref({
                    email: '',
                    password: '',
                    confirm_password: '',
                    country: '',
                    phone: ''
                });

                const errors = ref({
                    email: '',
                    password: '',
                    confirm_password: '',
                    country: '',
                    phone: ''
                });

                const validateField = (field) => {
                    switch (field) {
                        case 'email':
                            if (!user_data.value.email) {
                                errors.value.email = 'Email is required';
                            } else if (!/\S+@\S+\.\S+/.test(user_data.value.email)) {
                                errors.value.email = 'Email is invalid';
                            } else {
                                errors.value.email = '';
                            }
                            break;
                        case 'password':
                            if (!user_data.value.password) {
                                errors.value.password = 'Password is required';
                            } else if (user_data.value.password.length < 6) {
                                errors.value.password = 'Password must be at least 6 characters';
                            } else {
                                errors.value.password = '';
                            }
                            break;
                        case 'confirm_password':
                            if (!user_data.value.confirm_password) {
                                errors.value.confirm_password = 'Confirm Password is required';
                            } else if (user_data.value.confirm_password !== user_data.value.password) {
                                errors.value.confirm_password = 'Passwords do not match';
                            } else {
                                errors.value.confirm_password = '';
                            }
                            break;
                        case 'country':
                            if (!user_data.value.country) {
                                errors.value.country = 'Country is required';
                            } else {
                                errors.value.country = '';
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
                onMounted(async () => {
                    try {
                        const res = await fetch("https://restcountries.com/v3.1/all?fields=name,idd");
                        const data = await res.json();

                        countries.value = data
                            .flatMap(c => {
                                const root = c.idd?.root || '';
                                const suffixes = c.idd?.suffixes || [''];
                                return suffixes.map(suffix => ({
                                    name: c.name?.common || '',
                                    cca2: `${root}${suffix}`
                                }));
                            })
                            .filter(c => c.cca2) // remove any empty ones
                            .sort((a, b) => a.name.localeCompare(b.name));

                    } catch (err) {
                        console.error("Failed to fetch countries:", err);
                    }
                });

                // must return 
                return {
                    user_data,
                    countries,
                    errors,
                    validateField
                }
            },
            methods: {


                async register_user() {
                    const url = '/api/registerfirstime';

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
                    data.phone = data.country + " " + data.phone;
                    data.user_type_id = 3; // Assuming user_type_id is always 2 for regular users
                    if (data.password !== data.confirm_password) {
                        Swal.fire({
                            icon: "error",
                            background: 'oklch(20.5% 0 0)',
                            color: 'white',
                            title: "Oops...",
                            text: "Passwords do not match!",
                        });
                        return;
                    }

                    await axios.post(url, data, {
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        withCredentials: true
                    })
                        .then(response => {
                            Swal.fire({
                                icon: "success",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white',
                                title: "Your details have been saved",
                                text: 'You will be redirected in 5 seconds.',
                                timer: 5000, // Auto-close after 5 seconds
                                timerProgressBar: true, // Show a progress bar for the timer
                                showConfirmButton: false, // Hide the "OK" button
                                didClose: () => { // Callback when the alert closes (either by timer or user interaction)
                                    window.location.href = '/admin/home'; // Redirect to the specified URL
                                }
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: "error",
                                background: 'oklch(20.5% 0 0)',
                                color: 'white',
                                title: "Registration Failed",
                                text: error.response.data.message || "An error occurred. Please try again.",
                            });
                        });

                },

            },
            // preinit data
            data() {
                return {
                    user_data: {
                        sponsor_code: '',
                        sponsor_name: '',
                        full_name: '',
                        email: '',
                        password: '',
                        confirm_password: '',
                        country: '',
                        phone: '',
                        terms: false
                    },
                    countries: []
                };

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