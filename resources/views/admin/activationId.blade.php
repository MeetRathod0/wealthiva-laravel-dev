@extends('admin.layouts.app')

@section('content')
  <div class="flex w-full justify-center">
    <div class="w-full max-w-2xl">
    <div class="card text-white p-6 md:p-8 rounded-lg">
      <!-- Header -->
      <div class="mb-6">
      <h1 class="text-xl font-semibold">ID Activation</h1>
      <div class="w-16 h-0.5 bg-blue-400 mt-2"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 ">
      <!-- User ID -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Enter User ID</label>
        <input type="text" class="w-full input-field p-2.5 rounded-md bg-gray-700" value="BIT452164" readonly />
      </div>

      <!-- User Name -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">User Name</label>
        <input type="text" class="w-full input-field p-2.5 rounded-md bg-gray-700" value="Sanjay Rathod" readonly />
      </div>

      <!-- Plan Selection -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Plan</label>
        <select class="w-full input-field p-2.5 rounded-md bg-gray-700 border border-gray-600">
        <option selected disabled>-- Please Select Plan --</option>
        <option>Basic Plan</option>
        <option>Premium Plan</option>
        <option>VIP Plan</option>
        </select>
      </div>

      <!-- Enter Amount -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Enter Amount</label>
        <input type="number" class="w-full input-field p-2.5 rounded-md bg-gray-700" value="0.00" />
      </div>

      <!-- No Of Multiple -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">No Of Multiple</label>
        <input type="number" class="w-full input-field p-2.5 rounded-md bg-gray-700" value="0.00" />
      </div>

      <!-- Total Amount -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Total Amount</label>
        <input type="number" class="w-full input-field p-2.5 rounded-md bg-gray-700" value="0.00" readonly />
      </div>



      <!-- Security Code -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Security Code</label>
        <input type="text" class="w-full input-field p-2.5 rounded-md bg-gray-700" placeholder="Enter OTP" />
      </div>

      <!-- Available Balance -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Available Balance</label>
        <div class="p-2.5 rounded-md">0 USD</div>
      </div>
      </div>

      <!-- Action Buttons (Full Width) -->
      <div class="mt-6 flex flex-col sm:flex-row gap-3">
      <button class="btn-primary py-2.5 px-6 rounded-md font-medium text-white flex-1">
        Submit
      </button>
      <button class="btn-outline py-2.5 px-6 rounded-md font-medium text-gray-300 border border-blue-300 flex-1"
        onclick="window.location.href='transaction-history'">
        Check History
      </button>
      </div>
    </div>
    </div>
  </div>
@endsection