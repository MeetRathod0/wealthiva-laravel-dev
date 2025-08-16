@extends('admin.layouts.app')

@section('content')
  <div class="w-full flex flex-col gap-6 items-center justify-center">
    <div class="w-full max-w-4xl">
    <!-- Wider container -->
    <!-- Income Card -->
    <div class="card text-white p-6 md:p-8 rounded-xl">
      <!-- Increased padding -->
      <!-- User Info Header -->
      <div class="flex flex-wrap justify-between items-start mb-8 gap-1">
      <div>
        <h1 class="text-2xl font-bold mb-2 text-white">User Dashboard</h1>
        <div class="flex space-x-6">
        <div>
          <p class="text-xs text-gray-300 mb-1">USER ID</p>
          <p class="font-medium">{{ $user->wg_id }}</p>
        </div>
        <div>
          <p class="text-xs text-gray-300 mb-1">NAME</p>
          <p class="font-medium">{{ $user->fullname }}</p>
        </div>
        </div>
      </div>
      <div class="bg-blue-900/30 text-gray-300 px-3 py-1 rounded-full text-sm">
        Active Member
      </div>
      </div>

      <!-- Referral Section -->
      <div class="highlight-box p-4 rounded-lg mb-8">
      <h2 class="text-sm font-bold text-gray-300 mb-3">
        YOUR REFERRAL LINK
      </h2>
      <div class="flex items-center">
        <div class="input-field p-3 rounded-lg text-sm flex-1 truncate" id="clickupTag">
        https://{{ request()->getHost() }}/register/{{ $user->wg_id }}
        </div>
        <button id="copyTagBtn"
        class="ml-3 py-2 px-4 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 whitespace-nowrap">
        Copy Link
        </button>
      </div>
      </div>

      <script>
      document.getElementById('copyTagBtn').addEventListener('click', function () {
        const tagElement = document.getElementById('clickupTag');
        const tagText = tagElement?.textContent || '';
        const button = this;
        const originalText = button.textContent;

        if (tagText) {
        navigator.clipboard.writeText(tagText)
          .then(() => {
          button.textContent = 'Copied!';
          setTimeout(() => {
            button.textContent = originalText;
          }, 5000); // 3 seconds
          })
          .catch(err => {
          console.error('Failed to copy: ', err);
          alert('Failed to copy tag.');
          });
        } else {
        alert('No tag content found to copy.');
        }
      });
      </script>



      <!-- Income Summary -->
      <div class="mb-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold">Income Summary</h2>
        <div class="text-sm text-gray-300">Updated: Just now</div>
      </div>

      <!-- Summary Cards -->
      <div class="grid sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white/5 p-4 rounded-lg">
        <p class="text-xs text-gray-300 mb-1">Today's Income</p>
        <p class="text-2xl font-bold">{{ $incomeSummary['income_breakdown']['Total']['today'] }}</p>
        </div>
        <div class="bg-white/5 p-4 rounded-lg">
        <p class="text-xs text-gray-300 mb-1">Monthly Income</p>
        <p class="text-2xl font-bold">{{ $incomeSummary['monthly_income'] }}</p>
        </div>
        <div class="bg-white/5 p-4 rounded-lg">
        <p class="text-xs text-gray-300 mb-1">Total Earned</p>
        <p class="text-2xl font-bold">{{ $incomeSummary['total_earned'] }}</p>
        </div>
      </div>

      <!-- Detailed Income Table -->
      <div class="overflow-x-auto">
        <table class="w-full">
        <thead>
          <tr class="text-left text-sm text-gray-300 border-b border-white/10">
          <th class="pb-3 font-medium">Income Type</th>
          <th class="pb-3 font-medium text-right">Today</th>
          <th class="pb-3 font-medium text-right">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
          <td class="py-3">Monthly ROI Income</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Monthly ROI Income']['today'] }}</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Monthly ROI Income']['total'] }}</td>
          </tr>
          <tr class="table-row">
          <td class="py-3">Total Income</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Total']['today'] }}</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Total']['total'] }}</td>
          </tr>
          <tr class="table-row">
          <td class="py-3">Direct Income</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Direct Income']['today'] }}</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Direct Income']['total'] }}</td>
          </tr>
          <tr class="table-row">
          <td class="py-3">Level ROI Income</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Level ROI Income']['today'] }}</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Level ROI Income']['total'] }}</td>
          </tr>
          <tr class="table-row">
          <td class="py-3">Arbitrage Salary</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Arbitrage Salary']['today'] }}</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Arbitrage Salary']['total'] }}</td>
          </tr>
          <tr class="table-row">
          <td class="py-3">Reward Income</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Reward Income']['today'] }}</td>
          <td class="text-right">{{ $incomeSummary['income_breakdown']['Reward Income']['total'] }}</td>
          </tr>
          <tr class="table-row text-gray-300">
          <td class="py-3 font-bold">Total</td>
          <td class="text-right font-bold">{{ $incomeSummary['income_breakdown']['Total']['today'] }}</td>
          <td class="text-right font-bold">{{ $incomeSummary['income_breakdown']['Total']['total'] }}</td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>

      <!-- Action Buttons
      <div class="flex justify-end space-x-3">
      <button
      class="py-2 px-4 border border-blue-400 text-gray-300 text-sm rounded-lg hover:bg-blue-900/20"
      >
      Export Report
      </button>
      <button
      class="py-2 px-4 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700"
      >
      View Full History
      </button>
      </div> -->
    </div>
    </div>



  @endsection