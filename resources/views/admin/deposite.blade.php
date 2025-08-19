@extends('admin.layouts.app')

@section('content')

  <!-- Main Page Container (medium) -->
  <div class="flex w-full justify-center">
    <!-- Content Card Container -->
    <div class="w-full max-w-2xl"> <!-- Medium width -->
    <!-- Card Component -->
    <div class="card text-white p-6 md:p-8 rounded-xl"> <!-- Medium padding -->

      <!-- Header Section -->
      <div class="mb-5"> <!-- Medium margin -->
      <h1 class="text-xl font-bold text-white">Deposit Amount</h1> <!-- Medium font -->
      <div class="w-14 h-1 bg-blue-400 mt-2"></div> <!-- Medium underline -->
      </div>

      <!-- Deposit Address Section -->
      <div class="mb-5"> <!-- Medium margin -->
      <!-- <h2 class="text-sm font-medium text-gray-300 mb-3">Name / Deposit</h2> -->
      <!-- Address Box -->
      <div class="address-box p-4 rounded-lg mb-3"> <!-- Medium padding -->

        <div>
        <p class="info-label text-xs font-medium mb-1"></p>
        <input value="" type="number" id="amount" v-model="user.deposit_amount"
          class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none"
          placeholder="00.00" />
        </div>

      </div>
      <!-- Button Group -->
      <div class="flex space-x-3"> <!-- Medium spacing -->
        <button class="btn-outline text-gray-300 py-2 px-4 rounded-lg text-sm"
        onclick="addDeposit()"><!-- Medium padding/font -->
        <!-- Medium padding/font -->
        ADD
        </button>
        <!-- <button class="btn-primary text-white py-2 px-4 rounded-lg text-sm">
      CONT
      </button> -->
      </div>
      </div>

    </div>
    </div>
  </div>




  <!-- Main Page Container (medium) -->
  <div class="flex w-full justify-center mt-2" id="qrSection1">
    <!-- Content Card Container -->
    <div class="w-full max-w-2xl"> <!-- Medium width -->
    <!-- Card Component -->
    <div class="card text-white p-6 md:p-8 rounded-xl"> <!-- Medium padding -->

      <!-- Header Section -->
      <div class="mb-5"> <!-- Medium margin -->
      <h1 class="text-xl font-bold text-white">Deposit</h1> <!-- Medium font -->
      <div class="w-14 h-1 bg-blue-400 mt-2"></div> <!-- Medium underline -->
      </div>

      <!-- Deposit Address Section -->
      <div class="mb-5"> <!-- Medium margin -->
      <!-- <h2 class="text-sm font-medium text-gray-300 mb-3">Name / Deposit</h2> -->
      <!-- Address Box -->
      <div class="address-box p-4 rounded-lg mb-3"> <!-- Medium padding -->
        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
      <!-- Row 2 -->
      <div>
      <p class="info-label text-xs font-medium mb-1"></p>
      <input value="{{ $qr['code_1'] }}" type="text" id="" v-model="qr.code_1"
        class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none"
        placeholder="" />
      </div>
      @else
      <p class="text-sm break-all"> <!-- Medium font -->
      {{ $qr['code_1'] }}
      </p>
      @endif

      </div>
      <!-- Button Group -->
      <div class="flex space-x-3"> <!-- Medium spacing -->
        <button class="btn-outline text-gray-300 py-2 px-4 rounded-lg text-sm"
        v-on:click="navigator.clipboard.writeText(`{{ $qr['code_1'] }}`)"> <!-- Medium padding/font -->
        Copy Address
        </button>
        <!-- <button class="btn-primary text-white py-2 px-4 rounded-lg text-sm">
      CONT
      </button> -->
      </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-700 my-3"></div> <!-- Medium margin -->

      <!-- History Button -->
      <button class="w-full btn-outline text-gray-300 py-2.5 rounded-lg text-sm font-medium"
      onclick="window.location.href='transaction-history'"> <!-- Medium padding -->
      Check Deposit History
      </button>

      <!-- QR Code Section -->
      <div class="flex justify-center mt-5"> <!-- Medium margin -->
      <!-- QR Code Container -->
      <div class="bg-white p-2 rounded-lg" id="uploadBox"> <!-- Medium padding -->
        <!-- QR Code Placeholder -->
        <div class="w-28 h-28 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">

        <img src="{{ asset($qr['qr_path_1'] ?? 'uploads/qr/qr_1.jpeg') }}" id="qr_path" alt="QR Code"
          class="w-full h-full object-cover">
        <!-- Medium size -->
        </div>
      </div>
      </div>
      <input type="file" id="fileInput" class="hidden" accept="image/jpeg,image/png">

    </div>
    </div>
  </div>

  <!-- Main Page Container (medium) -->
  <div class="flex w-full justify-center mt-2" id="qrSection2">
    <!-- Content Card Container -->
    <div class="w-full max-w-2xl"> <!-- Medium width -->
    <!-- Card Component -->
    <div class="card text-white p-6 md:p-8 rounded-xl"> <!-- Medium padding -->

      <!-- Header Section -->
      <div class="mb-5"> <!-- Medium margin -->
      <h1 class="text-xl font-bold text-white">Deposit</h1> <!-- Medium font -->
      <div class="w-14 h-1 bg-blue-400 mt-2"></div> <!-- Medium underline -->
      </div>

      <!-- Deposit Address Section -->
      <div class="mb-5"> <!-- Medium margin -->
      <!-- <h2 class="text-sm font-medium text-gray-300 mb-3">Name / Deposit</h2> -->
      <!-- Address Box -->
      <div class="address-box p-4 rounded-lg mb-3"> <!-- Medium padding -->
        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
      <!-- Row 2 -->
      <div>
      <p class="info-label text-xs font-medium mb-1"></p>
      <input value="{{ $qr['code_2'] }}" type="text" id="" v-model="qr.code_2"
        class="w-full px-3 py-2 text-sm rounded-lg input-field-border-none placeholder-gray-300 focus:outline-none"
        placeholder="" />
      </div>
      @else
      <p class="text-sm break-all"> <!-- Medium font -->
      {{ $qr['code_2'] }}
      </p>
      @endif

      </div>
      <!-- Button Group -->
      <div class="flex space-x-3"> <!-- Medium spacing -->
        <button class="btn-outline text-gray-300 py-2 px-4 rounded-lg text-sm"
        v-on:click="navigator.clipboard.writeText(`{{ $qr['code_2'] }}`)"> <!-- Medium padding/font -->
        Copy Address
        </button>
        <!-- <button class="btn-primary text-white py-2 px-4 rounded-lg text-sm">
      CONT
      </button> -->
      </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-700 my-3"></div> <!-- Medium margin -->

      <!-- History Button -->
      <button class="w-full btn-outline text-gray-300 py-2.5 rounded-lg text-sm font-medium"
      onclick="window.location.href='transaction-history'"> <!-- Medium padding -->
      Check Deposit History
      </button>

      <!-- QR Code Section -->
      <div class="flex justify-center mt-5"> <!-- Medium margin -->
      <!-- QR Code Container -->
      <div class="bg-white p-2 rounded-lg" id="uploadBox"> <!-- Medium padding -->
        <!-- QR Code Placeholder -->
        <div class="w-28 h-28 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">

        <img src="{{ asset($qr['qr_path_22'] ?? 'uploads/qr/qr_1.jpeg') }}" id="qr_path" alt="QR Code"
          class="w-full h-full object-cover">
        <!-- Medium size -->
        </div>
      </div>
      </div>
      <input type="file" id="fileInput" class="hidden" accept="image/jpeg,image/png">

    </div>
    </div>
  </div>

  <script>
    function addDeposit() {
    const amt = document.getElementById("amount").value;
    if (!amt) {
      Swal.fire({
      title: "Amount Required",
      text: "Please enter a deposit amount.",
      icon: "warning",
      confirmButtonText: "OK"
      });
      return;
    }
    if (isNaN(amt) || amt <= 0) {
      Swal.fire({
      title: "Invalid Amount",
      text: "Please enter a valid deposit amount.",
      icon: "error",
      confirmButtonText: "OK"
      });
      return;
    }
    axios.post('/api/deposite', {
      amount: amt
    }, {
      headers: {
      'Content-Type': 'application/json'
      },
      withCredentials: true
    }).then(response => {
      Swal.fire({
      title: "Deposit Added",
      text: "Your deposit has been successfully added.",
      icon: "success",
      confirmButtonText: "OK"
      });
      document.getElementById("amount").value = ""; // Clear input
    }).catch(error => {
      console.error(error);
      Swal.fire({
      title: "Error",
      text: "There was an error adding your deposit.",
      icon: "error",
      confirmButtonText: "OK"
      });
    });
    }

    document.getElementById("uploadBox").addEventListener("click", () => {
    document.getElementById("fileInput").click();
    });

    document.getElementById("fileInput").addEventListener("change", (event) => {
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      if (file) {
      const validTypes = ["image/jpeg", "image/png", "image/jpg"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
        title: "Invalid File Type",
        text: "Please upload a valid image file (JPEG/PNG).",
        icon: "error",
        confirmButtonText: "OK"
        });
        event.target.value = ""; // reset input
        return;
      }
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById("qr_path").src = e.target.result; // show selected image
      };
      reader.readAsDataURL(file);
      }
      // TODO: Upload via AJAX or preview the file
    }
    });
  </script>
@endsection