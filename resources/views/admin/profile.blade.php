@extends('admin.layouts.app')

@section('content')

  <div class="flex-1 flex-col gap-6">
    <!-- Profile Card -->
    <div class="profile-card text-white p-6 rounded-xl max-w-2xl mx-auto">
    <!-- Card Header -->
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-bold">User Profile</h2>

      <div class="flex justify-end gap-4">
      <span class="status-badge text-xs font-medium py-1 px-2 rounded-full">ACTIVE</span>
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
      SR
      </div>
    </div>

    <!-- User Information Grid -->
    <div class="space-y-4">
      <!-- Row 1 -->
      <div class="grid grid-cols-2 gap-4">
      <div>
        <p class="info-label text-xs font-medium mb-1">USER ID</p>
        <p class="info-value text-sm font-medium">{{ $user->wg_id }}</p>
      </div>
      <div>
        <p class="info-label text-xs font-medium mb-1">USER NAME</p>
        <p class="info-value text-sm font-medium">{{ $user->fullname }}</p>
      </div>
      </div>

      <!-- Divider -->
      <div class="divider border-t my-2"></div>

      <!-- Row 2 -->
      <div>
      <p class="info-label text-xs font-medium mb-1">EMAIL</p>
      <!-- <p class="info-value text-sm font-medium">{{ $user->email }}</p> -->
      <input value="{{ $user->email }}" type="email" id="email" v-model="user.email" disabled
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
        <input value="{{ $user->phone }}" disabled
        class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none text-white"
        placeholder="+1 234 567 890" type="text" v-model="user.phone" />
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

      </div>
    </div>

    <!-- Action Buttons -->
    <!-- <div class="mt-8 grid grid-cols-2 gap-3">
      <button
      class="py-2 px-4 rounded-lg border border-blue-400 text-gray-300 text-sm font-medium hover:bg-blue-900/20 transition-colors"
      >
      Edit Profile
      </button>
      <button
      class="py-2 px-4 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors"
      >
      View Transactions
      </button>
      </div> -->
    </div>

  </div>
@endsection