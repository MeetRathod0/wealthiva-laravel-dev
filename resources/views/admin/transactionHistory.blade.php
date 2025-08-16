@extends('admin.layouts.app')

@section('content')
  <div class="mx-auto text-white ">
    <!-- Breadcrumb and Title -->
    <div class="mb-4">
    <!-- <div class="text-xs text-gray-300 mb-1">
      <a href="#" class="hover:text-gray-200">Home</a>
      <span class="mx-1">/</span>
      <span>Transaction History</span>
      </div> -->
    <h1 class="text-xl font-bold text-white">Transaction History</h1>
    </div>

    <!-- Filter Tabs -->
    <div class="flex border-b border-gray-700 mb-4">
    <button class="px-3 py-1.5 text-sm border-b-2 border-blue-500 text-gray-400">
      All
    </button>
    <button class="px-3 py-1.5 text-sm text-gray-400 hover:text-white">
      Deposit
    </button>
    <button class="px-3 py-1.5 text-sm text-gray-400 hover:text-white">
      Withdraw
    </button>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
      <div class="card p-3 rounded-md">
      <p class="text-xs text-gray-300">Total Transactions</p>
      <p class="text-xl font-bold">1</p>
      </div>
      <div class="card p-3 rounded-md">
      <p class="text-xs text-gray-300">Total Amount</p>
      <p class="text-xl font-bold">$25.00</p>
      </div>
      <div class="card p-3 rounded-md">
      <p class="text-xs text-gray-300">Total Fees</p>
      <p class="text-xl font-bold">$2.50</p>
      </div>
      </div> -->

    <!-- Transaction Table -->
    <div class="card rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-xs sm:text-sm">
      <thead>
        <tr class="table-header text-left text-gray-300">
        <th class="px-4 py-2">S.NO</th>
        <th class="px-4 py-2">AMOUNT ($)</th>
        <th class="px-4 py-2">CHARGES ($)</th>
        <th class="px-4 py-2">NET AMOUNT ($)</th>
        <th class="px-4 py-2">REQUEST DATE</th>
        <th class="px-4 py-2">STATUS</th>
        <th class="px-4 py-2">WALLET ADDRESS</th>
        <th class="px-4 py-2">HASH</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-800">
        <!-- Transaction Row -->
        <tr class="table-row">
        <td class="px-4 py-3 whitespace-nowrap">1</td>
        <td class="px-4 py-3 whitespace-nowrap font-medium">25.00</td>
        <td class="px-4 py-3 whitespace-nowrap">2.50</td>
        <td class="px-4 py-3 whitespace-nowrap font-bold text-green-400">
          22.50
        </td>
        <td class="px-4 py-3 whitespace-nowrap">07/07/2025</td>
        <td class="px-4 py-3 whitespace-nowrap">
          <span class="status-unpaid px-2 py-0.5 rounded-full text-xs">UnPaid</span>
        </td>
        <td class="px-4 py-3 whitespace-nowrap text-gray-300 font-mono">
          0x99E5...4BF0
          <button class="ml-1 text-gray-400 hover:text-gray-300" title="Copy">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
          </svg>
          </button>
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
          <!-- <button class="text-gray-300 hover:text-gray-400 text-xs">
      View
      </button> -->
        </td>
        </tr>
      </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 flex flex-col sm:flex-row items-center justify-between border-t border-gray-800 gap-2">
      <div class="text-xs text-gray-300">
      Showing <span class="font-medium">1</span> to
      <span class="font-medium">1</span> of
      <span class="font-medium">1</span>
      </div>
      <div class="flex space-x-1">
      <button
        class="px-2 py-1 rounded border border-gray-700 text-xs text-gray-300 hover:bg-gray-800 disabled:opacity-50"
        disabled>
        Prev
      </button>
      <button class="px-2 py-1 rounded bg-blue-600 text-xs text-white hover:bg-blue-700">
        1
      </button>
      <button
        class="px-2 py-1 rounded border border-gray-700 text-xs text-gray-300 hover:bg-gray-800 disabled:opacity-50"
        disabled>
        Next
      </button>
      </div>
    </div>
    </div>

    <!-- Export Button -->
    <!-- <div class="mt-4 flex justify-end">
      <button
      class="bg-indigo-600 hover:bg-indigo-700 px-3 py-1.5 rounded-md text-xs flex items-center"
      >
      <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-3.5 w-3.5 mr-1.5"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      >
      <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
      />
      </svg>
      Export
      </button>
      </div> -->
  </div>

  <script>
    // Copy to clipboard functionality
    document.querySelectorAll('[title="Copy"]').forEach((button) => {
    button.addEventListener("click", (e) => {
      const address = e.target
      .closest("td")
      .textContent.trim()
      .split("...")[0];
      navigator.clipboard.writeText(address);
      const originalHTML = button.innerHTML;
      button.innerHTML = `
      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      `;
      setTimeout(() => {
      button.innerHTML = originalHTML;
      }, 2000);
    });
    });
  </script>
@endsection