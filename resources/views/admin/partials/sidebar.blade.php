<!-- User Greeting -->
<div class="p-4 h-full overflow-y-scroll pt-14 md:pt-4 relative">
  <button id="closeBtn" class="md:hidden absolute top-2 right-2 p-1.5 rounded-lg bg-transprent text-white">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>

  <!-- Brand Logo -->
  <div class="mb-6 flex justify-center">
    <img src="{{ asset('logo.png') }}" alt="Brand Logo" class="h-20 w-auto rounded-md">
  </div>

  <!-- <div class="mb-8 p-3 rounded-lg bg-white/5">
    <p class="text-white font-medium">Sanjay Rathod</p>
    <p class="text-gray-300 text-xs">ID: BIT452164</p>
  </div> -->

  <!-- Navigation Menu -->
  <nav class="space-y-1">
    @php
    $currentUrl = url()->current();
    $activeClass = 'bg-gray-600/20 border-l-2 border-gray-400';
  @endphp

    <a href="{{ url('/admin/home') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20  @if(str_contains($currentUrl, needle: url('/admin/home'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>
      Home
    </a>

    <a href="{{ url('/admin/profile') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/profile'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      Profile
    </a>

    @if(auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
    <a href="{{ url('/admin/users') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/users'))) {{ $activeClass }} @endif">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
      </svg>
      User Manager
    </a>
  @endif



    <a href="{{ url('/admin/deposite') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/deposite'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Deposit
    </a>

    <a href="{{ url('/admin/withdraw') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/withdraw'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Withdraw
    </a>

    @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
    <a href="{{ url('/admin/all-team') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/all-team'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
      All Team
    </a>
  @endif


    <a href="{{ url('/admin/layer-1') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/layer-1'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
      My Team
    </a>

    <a href="{{ url('/admin/requests') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/requests'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
      </svg>
      Requests
    </a>

    <a href="{{ url('/admin/tree-view') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/tree-view'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
      </svg>
      Tree View
    </a>

    <a href="{{ url('/admin/transaction-history') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/transaction-history'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
      </svg>
      Transaction History
    </a>

    <a href="{{ url('/admin/change-password') }}"
      class="nav-item flex items-center p-3 text-white rounded-lg hover:bg-gray-600/20 @if(str_contains($currentUrl, url('/admin/change-password'))) {{ $activeClass }} @endif">
      <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
      </svg>
      Change Password
    </a>
  </nav>
</div>