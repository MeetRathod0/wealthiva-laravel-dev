@extends('admin.layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold">Team Management</h1>
    <!-- <div class="flex space-x-4">
        <button class="btn-primary px-4 py-2 rounded-lg text-sm font-medium">
        Export Data
        </button>
        <button
        class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg text-sm font-medium transition"
        >
        Add Member
        </button>
      </div> -->
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="card p-6 rounded-xl">
      <h3 class="text-gray-300 text-sm font-medium mb-1">Total Members</h3>
      <p class="text-3xl font-bold">19</p>
    </div>
    <div class="card p-6 rounded-xl">
      <h3 class="text-gray-300 text-sm font-medium mb-1">Qualified</h3>
      <p class="text-3xl font-bold">12</p>
    </div>
    <div class="card p-6 rounded-xl">
      <h3 class="text-gray-300 text-sm font-medium mb-1">Not Qualified</h3>
      <p class="text-3xl font-bold">7</p>
    </div>
    </div>

    <!-- Team Levels -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    <!-- Level 1 -->
    <div class="card p-4 rounded-lg qualified">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-1</h3>
        <p class="text-sm text-green-400">Qualified</p>
      </div>
      <span class="text-xl font-bold">3</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline">
      View More →
      </button>
    </div>

    <!-- Level 2 -->
    <div class="card p-4 rounded-lg qualified">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-2</h3>
        <p class="text-sm text-green-400">Qualified</p>
      </div>
      <span class="text-xl font-bold">6</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline">
      View More →
      </button>
    </div>

    <!-- Level 3 -->
    <div class="card p-4 rounded-lg qualified">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-3</h3>
        <p class="text-sm text-green-400">Qualified</p>
      </div>
      <span class="text-xl font-bold">3</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline">
      View More →
      </button>
    </div>

    <!-- Level 4 -->
    <div class="card p-4 rounded-lg not-qualified">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-4</h3>
        <p class="text-sm text-red-400">Not Qualified</p>
      </div>
      <span class="text-xl font-bold">3</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline">
      View More →
      </button>
    </div>

    <!-- Level 5 -->
    <div class="card p-4 rounded-lg not-qualified">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-5</h3>
        <p class="text-sm text-red-400">Not Qualified</p>
      </div>
      <span class="text-xl font-bold">4</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline">
      View More →
      </button>
    </div>

    <!-- Empty Levels (6-20) -->
    <div class="card p-4 rounded-lg not-qualified opacity-70">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-6</h3>
        <p class="text-sm text-red-400">Not Qualified</p>
      </div>
      <span class="text-xl font-bold">0</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline" disabled>
      View More →
      </button>
    </div>

    <!-- You would continue this pattern for levels 7-20 -->
    <!-- For brevity, I'm showing one more example -->
    <div class="card p-4 rounded-lg not-qualified opacity-70">
      <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold">Level-20</h3>
        <p class="text-sm text-red-400">Not Qualified</p>
      </div>
      <span class="text-xl font-bold">0</span>
      </div>
      <button class="mt-3 text-gray-300 text-sm font-medium hover:underline" disabled>
      View More →
      </button>
    </div>
    </div>
  </div>
@endsection