@extends('admin.layouts.app')

@section('content')
  <div class="flex w-full justify-center">
    <div class="w-full max-w-md">
    <div class="card text-white p-6 md:p-8 rounded-lg">
      <!-- Header -->
      <div class="mb-4">
      <h1 class="text-lg font-bold">Withdrawal</h1>
      <!-- <p class="text-2xs text-gray-300">Home / Withdrawal</p> -->
      <div class="w-12 h-0.5 bg-blue-400 mt-1"></div>
      </div>

      <!-- Withdrawal Type -->
      <div class="mb-4">
      <h2 class="text-xs font-medium text-gray-300 mb-2">
        Withdrawal Type
      </h2>
      <div class="space-y-1.5">
        <select class="w-full input-field p-2.5 rounded-md bg-zinc-800 border border-zinc-700">
        <option selected>Working Wallet</option>
        <option>Non-Working Wallet</option>
        <option>Direct Wallet</option>
        <option>Principal Withdrawal</option>
        </select>

      </div>
      </div>

      <!-- Wallet Address -->
      <div class="mb-3">
      <label class="info-label text-gray-300 font-medium block mb-1">Wallet Address</label>
      <input type="text" class="w-full input-field rounded-md" value="0" />
      </div>

      <!-- Amount -->
      <div class="mb-3">
      <label class="info-label text-gray-300 font-medium block mb-1">Amount</label>
      <input type="text" class="w-full input-field rounded-md" value="0.00" />
      </div>

      <!-- Google Authenticator -->
      <div class="mb-4">
      <label class="info-label block text-gray-300 font-medium mb-1">Google Auth Code</label>
      <input type="text" class="w-full input-field rounded-md" value="0" />
      <p class="text-2xs text-gray-300 mt-1">Available: 9.76 USD</p>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row gap-2">
      <button class="btn btn-primary rounded-md font-semibold">Submit</button>
      <button class="btn btn-outline text-gray-300 rounded-md">
        Check History
      </button>
      </div>
    </div>
    </div>
  </div>
@endsection