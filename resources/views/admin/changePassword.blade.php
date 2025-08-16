@extends('admin.layouts.app')

@section('content')
  <div class="w-full max-w-md mx-auto" id="appCapsule">
    <!-- Password Change Card -->
    <div class="card text-white p-6 md:p-8 rounded-xl">
    <!-- Compact Header -->
    <div class="mb-6 text-center">
      <h1 class="text-xl font-bold text-white ">Change Password</h1>
    </div>

    <!-- Compact Form -->
    <form class="space-y-4">
      <!-- Current Password Field -->
      <div>
      <label for="current-password" class="block text-xs font-medium text-gray-200 mb-1">
        CURRENT PASSWORD
      </label>
      <div class="relative">
        <input type="password" id="current-password" v-model="user_data.current_password"
        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none pr-10"
        placeholder="Enter Current Password" />
        <button type="button" class="absolute right-2 top-2 text-xs text-gray-300 font-medium">
        SHOW
        </button>
      </div>
      </div>

      <!-- New Password Field -->
      <div>
      <label for="new-password" class="block text-xs font-medium text-gray-200 mb-1">
        NEW PASSWORD
      </label>
      <div class="relative">
        <input type="password" id="new-password" v-model="user_data.new_password"
        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none pr-10"
        placeholder="Enter Password" />
        <button type="button" class="absolute right-2 top-2 text-xs text-gray-300 font-medium">
        SHOW
        </button>
      </div>
      </div>

      <!-- Confirm Password Field -->
      <div>
      <label for="confirm-password" class="block text-xs font-medium text-gray-200 mb-1">
        CONFIRM NEW PASSWORD
      </label>
      <div class="relative">
        <input type="password" id="confirm-password" v-model="user_data.confirm_password"
        class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none pr-10"
        placeholder="Enter Confirm Password" />
        <button type="button" class="absolute right-2 top-2 text-xs text-gray-300 font-medium">
        SHOW
        </button>
      </div>
      </div>

      <!-- OTP Field -->
      <div>
      <!--label for="otp" class="block text-xs font-medium text-gray-200 mb-1">
      GOOGLE AUTHENTICATOR CODE
      </label>
      <input type="text" id="otp" inputmode="numeric" pattern="[0-9]*"
      class="w-full px-3 py-2 text-sm rounded-lg input-field placeholder-gray-300 focus:outline-none"
      placeholder="Enter OTP" />
      </div-->

      <!-- Submit Button -->
      <button type="button" v-on:click="updatePassword()"
        class="w-full btn-primary py-2 px-4 rounded-lg text-sm font-medium mt-3">
        UPDATE PASSWORD
      </button>
    </form>
    </div>
  </div>

  <style>
    .login-card {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }

    .input-field {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    }

    .input-field:focus {
    border-color: #93c5fd;
    box-shadow: 0 0 0 2px rgba(147, 197, 253, 0.3);
    }

    .btn-primary {
    background-color: #3b82f6;
    color: white;
    transition: background-color 0.2s;
    }

    .btn-primary:hover {
    background-color: #2563eb;
    }

    .password-strength {
    transition: width 0.3s;
    }
  </style>

  <script>
    // Simple password strength indicator (example)
    document.getElementById('new-password').addEventListener('input', function (e) {
    const strengthBar = document.querySelector('.password-strength');
    const strength = Math.min(e.target.value.length * 10, 100);
    strengthBar.style.width = strength + '%';
    strengthBar.style.backgroundColor = strength < 50 ? '#ef4444' : strength < 80 ? '#f59e0b' : '#10b981';
    });
  </script>
  <script>


    // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const { createApp, ref, onMounted, computed } = Vue;

    const app = createApp({
    setup() {
      const user_data = ref({
      current_password: '',
      new_password: '',
      confirm_password: ''
      });

      // must return 
      return {
      user_data
      }
    },
    methods: {
      async updatePassword() {
      const url = '/api/update-password';

      if (!this.user_data.current_password || !this.user_data.new_password) {
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Please fill in all fields!",
        });
        return;
      }

      if (this.user_data.new_password !== this.user_data.confirm_password) {
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "New password and confirm password do not match!",
        });
        return;
      }
      const data = this.user_data;

      await axios.post(url, data, {
        headers: {
        'Content-Type': 'application/json'
        },
        withCredentials: true
      })
        .then(response => {
        Swal.fire({
          icon: "success",
          title: "Success!",
          text: "Password updated successfully!",
        });
        // Optionally trigger any follow-up like:
        // this.fetch_active_users();
        })
        .catch(error => {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: error.response ? error.response.data.message : "An error occurred!",
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