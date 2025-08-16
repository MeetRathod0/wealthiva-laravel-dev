@extends('admin.layouts.app')

@section('content')
  <div class="mx-auto text-white">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
    <div>
      <h1 class="text-xl font-bold">Layer List</h1>
      <!-- <p class="text-gray-300 text-xs">
      Team members and business overview
      </p> -->
    </div>
    <div>
      <a href="all-team" class="text-gray-300 hover:text-gray-400 text-xs font-medium flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
      </svg>
      Back to Layers
      </a>
    </div>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
    <div class="card p-3 rounded-md">
      <p class="text-xs text-gray-300 mb-1">Total Members</p>
      <p class="text-xl font-bold">3</p>
    </div>
    <div class="card p-3 rounded-md">
      <p class="text-xs text-gray-300 mb-1">Total Business</p>
      <p class="text-xl font-bold">90</p>
    </div>
    <div class="card p-3 rounded-md">
      <p class="text-xs text-gray-300 mb-1">Average Business</p>
      <p class="text-xl font-bold">30</p>
    </div>
    </div> -->

    <!-- Layer Table -->
    <div class="card rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-xs sm:text-sm">
      <thead>
        <tr class="table-header text-left text-gray-300">
        <th class="px-4 py-2">SrNo</th>
        <th class="px-4 py-2">CODE</th>
        <th class="px-4 py-2">NAME</th>
        <th class="px-4 py-2 text-right">Business</th>
        <th class="px-4 py-2">Activation Date</th>
        <th class="px-4 py-2">LEVEL</th>
        <!-- <th class="px-4 py-2 text-right">Actions</th> -->
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-800">
        <!-- Row 1 -->
        <tr class="table-row">
        <td class="px-4 py-3 whitespace-nowrap">1</td>
        <td class="px-4 py-3 whitespace-nowrap text-gray-300 font-mono">
          BIT461653
        </td>
        <td class="px-4 py-3 whitespace-nowrap font-medium">
          Yogesh Patel
        </td>
        <td class="px-4 py-3 whitespace-nowrap text-right font-bold">
          50
        </td>
        <td class="px-4 py-3 whitespace-nowrap">21-03-2025</td>
        <td class="px-4 py-3 whitespace-nowrap text-center">
          <span class="level-badge level-1">1</span>
        </td>
        <!-- <td class="px-4 py-3 whitespace-nowrap text-right">
      <button class="text-gray-300 hover:text-gray-400 text-xs font-medium">
      View
      </button>
      </td> -->
        </tr>

        <!-- Row 2 -->
        <tr class="table-row">
        <td class="px-4 py-3 whitespace-nowrap">2</td>
        <td class="px-4 py-3 whitespace-nowrap text-gray-300 font-mono">
          BIT543241
        </td>
        <td class="px-4 py-3 whitespace-nowrap font-medium">
          Jignesh venikil Patel
        </td>
        <td class="px-4 py-3 whitespace-nowrap text-right font-bold">
          20
        </td>
        <td class="px-4 py-3 whitespace-nowrap">16-04-2025</td>
        <td class="px-4 py-3 whitespace-nowrap text-center">
          <span class="level-badge level-1">1</span>
        </td>
        <!-- <td class="px-4 py-3 whitespace-nowrap text-right">
      <button class="text-gray-300 hover:text-gray-400 text-xs font-medium">
      View
      </button>
      </td> -->
        </tr>

        <!-- Row 3 -->
        <tr class="table-row">
        <td class="px-4 py-3 whitespace-nowrap">3</td>
        <td class="px-4 py-3 whitespace-nowrap text-gray-300 font-mono">
          BIT642634
        </td>
        <td class="px-4 py-3 whitespace-nowrap font-medium">
          Sanjay Rahied
        </td>
        <td class="px-4 py-3 whitespace-nowrap text-right font-bold">
          20
        </td>
        <td class="px-4 py-3 whitespace-nowrap">16-04-2025</td>
        <td class="px-4 py-3 whitespace-nowrap text-center">
          <span class="level-badge level-1">1</span>
        </td>
        <!-- <td class="px-4 py-3 whitespace-nowrap text-right">
      <button class="text-gray-300 hover:text-gray-400 text-xs font-medium">
      View
      </button>
      </td> -->
        </tr>

        <!-- Total Row -->
        <tr class="total-row">
        <td class="px-4 py-3 whitespace-nowrap">0</td>
        <td class="px-4 py-3 whitespace-nowrap"></td>
        <td class="px-4 py-3 whitespace-nowrap font-medium">TOTAL</td>
        <td class="px-4 py-3 whitespace-nowrap text-right font-bold">
          90
        </td>
        <td class="px-4 py-3 whitespace-nowrap"></td>
        <td class="px-4 py-3 whitespace-nowrap text-center">
          <span class="level-badge level-0">0</span>
        </td>
        <!-- <td class="px-4 py-3 whitespace-nowrap text-right"></td> -->
        </tr>
      </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 flex flex-col sm:flex-row items-center justify-between border-t border-gray-800 gap-2">
      <div class="text-xs text-gray-300">
      Showing <span class="font-medium">1</span> to
      <span class="font-medium">3</span> of
      <span class="font-medium">3</span> members
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
      class="bg-indigo-600 hover:bg-indigo-700 px-3 py-1.5 rounded-md text-xs font-medium transition flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
      </svg>
      Export Data
    </button>
    </div> -->
  </div>
@endsection