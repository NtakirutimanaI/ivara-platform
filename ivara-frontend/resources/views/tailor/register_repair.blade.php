@include('layouts.header') <!-- optional header include -->
@include('layouts.sidebar')
@include('tailor.connect')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<style>
  .bg-overlay {
    background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.2));
  }
  .link-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-weight: 500;
    font-size: 0.875rem;
    text-decoration: none;
    box-shadow: 0 1px 4px rgba(0,0,0,0.15);
    transition: background-color 0.3s ease;
  }
  .link-button i { margin-right: 0.4rem; }
  .link-button-indigo { background-color: #4f46e5; color: white; }
  .link-button-indigo:hover { background-color: #924FC2; }
  .link-button-green { background-color: #10b981; color: white; }
  .link-button-green:hover { background-color: #059669; }
  .link-button-red { background-color: #ef4444; color: white; }
  .link-button-red:hover { background-color: #b91c1c; }
  .modal-bg {
    background-color: rgba(0,0,0,0.5);
  }
</style>

<div class="container mx-auto" style="width:80%; margin-left:240px; margin-top:100px;" data-aos="fade-up">

  <div class="flex justify-between items-center mb-6 flex-wrap">
    <h1 class="text-2xl font-bold text-indigo-600 mb-2 md:mb-0">Tailor Repairs</h1>
    <button id="toggleForm" class="link-button link-button-green max-w-xs">
      <i class="fas fa-plus"></i> Add New Repair
    </button>
  </div>

  <!-- Success / Error Messages -->
  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
  @endif

  <!-- Create Repair Form -->
  <div id="repairForm" class="bg-white shadow rounded p-6 mb-8 hidden">
    <form action="{{ route('tailor.save_repair') }}" method="POST">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block font-semibold">Customer Name</label>
          <input type="text" name="customer_name" required class="w-full border p-2 rounded" />
        </div>
        <div>
          <label class="block font-semibold">Customer Contact</label>
          <input type="text" name="customer_contact" class="w-full border p-2 rounded" />
        </div>
        <div>
          <label class="block font-semibold">Item Name</label>
          <input type="text" name="item_name" required class="w-full border p-2 rounded" />
        </div>
        <div>
          <label class="block font-semibold">Item Model</label>
          <input type="text" name="item_model" class="w-full border p-2 rounded" />
        </div>
        <div class="md:col-span-2">
          <label class="block font-semibold">Repair Details</label>
          <textarea name="repair_details" rows="3" required class="w-full border p-2 rounded"></textarea>
        </div>
        <div>
          <label class="block font-semibold">Repair Status</label>
          <select name="repair_status" class="w-full border p-2 rounded">
            <option value="Pending" selected>Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
            <option value="Collected">Collected</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold">Price</label>
          <input type="number" step="0.01" name="price" class="w-full border p-2 rounded" />
        </div>
        <div>
          <label class="block font-semibold">Date Received</label>
          <input type="date" name="date_received" required class="w-full border p-2 rounded" />
        </div>
        <div>
          <label class="block font-semibold">Expected Completion</label>
          <input type="date" name="expected_completion_date" class="w-full border p-2 rounded" />
        </div>
      </div>
      <div class="mt-4">
        <button type="submit" class="link-button link-button-indigo">
          <i class="fas fa-save"></i> Save Repair
        </button>
      </div>
    </form>
  </div>

  <!-- Repairs Table -->
  <div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-4 py-2 text-left">#</th>
          <th class="px-4 py-2 text-left">Customer</th>
          <th class="px-4 py-2 text-left">Contact</th>
          <th class="px-4 py-2 text-left">Item</th>
          <th class="px-4 py-2 text-left">Model</th>
          <th class="px-4 py-2 text-left">Details</th>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-left">Price</th>
          <th class="px-4 py-2 text-left">Received</th>
          <th class="px-4 py-2 text-left">Expected</th>
          <th class="px-4 py-2 text-left">Completed</th>
          <th class="px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @foreach($repairs as $index => $repair)
        <tr>
          <td class="px-4 py-2">{{ $index + 1 }}</td>
          <td class="px-4 py-2">{{ $repair->customer_name }}</td>
          <td class="px-4 py-2">{{ $repair->customer_contact }}</td>
          <td class="px-4 py-2">{{ $repair->item_name }}</td>
          <td class="px-4 py-2">{{ $repair->item_model ?? '-' }}</td>
          <td class="px-4 py-2">{{ $repair->repair_details }}</td>
          <td class="px-4 py-2">{{ $repair->repair_status }}</td>
          <td class="px-4 py-2">{{ number_format($repair->price,2) }}</td>
          <td class="px-4 py-2">{{ $repair->date_received }}</td>
          <td class="px-4 py-2">{{ $repair->expected_completion_date ?? '-' }}</td>
          <td class="px-4 py-2">{{ $repair->date_completed ?? '-' }}</td>
          <td class="px-4 py-2 flex space-x-2">
            <!-- View Button -->
            <button class="link-button link-button-blue-light px-2 py-1" onclick="openModal('viewModal{{ $repair->id }}')">
              <i class="fas fa-eye"></i>
            </button>
            <!-- Edit Button -->
            <button class="link-button link-button-indigo px-2 py-1" onclick="openModal('editModal{{ $repair->id }}')">
              <i class="fas fa-edit"></i>
            </button>
            <!-- Delete Button -->
            <button class="link-button link-button-red px-2 py-1" onclick="openModal('deleteModal{{ $repair->id }}')">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>

        <!-- View Modal -->
        <div id="viewModal{{ $repair->id }}" class="fixed inset-0 hidden items-center justify-center modal-bg z-50">
          <div class="bg-white rounded shadow-lg w-11/12 md:w-1/2 p-6 relative">
            <h2 class="text-xl font-bold mb-4">View Repair #{{ $index + 1 }}</h2>
            <p><strong>Customer:</strong> {{ $repair->customer_name }}</p>
            <p><strong>Contact:</strong> {{ $repair->customer_contact }}</p>
            <p><strong>Item:</strong> {{ $repair->item_name }}</p>
            <p><strong>Model:</strong> {{ $repair->item_model ?? '-' }}</p>
            <p><strong>Details:</strong> {{ $repair->repair_details }}</p>
            <p><strong>Status:</strong> {{ $repair->repair_status }}</p>
            <p><strong>Price:</strong> {{ number_format($repair->price,2) }}</p>
            <p><strong>Received:</strong> {{ $repair->date_received }}</p>
            <p><strong>Expected:</strong> {{ $repair->expected_completion_date ?? '-' }}</p>
            <p><strong>Completed:</strong> {{ $repair->date_completed ?? '-' }}</p>
            <button onclick="closeModal('viewModal{{ $repair->id }}')" class="link-button link-button-red mt-4 w-full">Close</button>
          </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal{{ $repair->id }}" class="fixed inset-0 hidden items-center justify-center modal-bg z-50">
          <div class="bg-white rounded shadow-lg w-11/12 md:w-1/2 p-6 relative">
            <h2 class="text-xl font-bold mb-4">Edit Repair #{{ $index + 1 }}</h2>
            <form action="{{ route('tailor.update_repair', $repair->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block font-semibold">Customer Name</label>
                  <input type="text" name="customer_name" value="{{ $repair->customer_name }}" required class="w-full border p-2 rounded" />
                </div>
                <div>
                  <label class="block font-semibold">Customer Contact</label>
                  <input type="text" name="customer_contact" value="{{ $repair->customer_contact }}" class="w-full border p-2 rounded" />
                </div>
                <div>
                  <label class="block font-semibold">Item Name</label>
                  <input type="text" name="item_name" value="{{ $repair->item_name }}" required class="w-full border p-2 rounded" />
                </div>
                <div>
                  <label class="block font-semibold">Item Model</label>
                  <input type="text" name="item_model" value="{{ $repair->item_model }}" class="w-full border p-2 rounded" />
                </div>
                <div class="md:col-span-2">
                  <label class="block font-semibold">Repair Details</label>
                  <textarea name="repair_details" rows="3" required class="w-full border p-2 rounded">{{ $repair->repair_details }}</textarea>
                </div>
                <div>
                  <label class="block font-semibold">Repair Status</label>
                  <select name="repair_status" class="w-full border p-2 rounded">
                    <option value="Pending" {{ $repair->repair_status=='Pending'?'selected':'' }}>Pending</option>
                    <option value="In Progress" {{ $repair->repair_status=='In Progress'?'selected':'' }}>In Progress</option>
                    <option value="Completed" {{ $repair->repair_status=='Completed'?'selected':'' }}>Completed</option>
                    <option value="Collected" {{ $repair->repair_status=='Collected'?'selected':'' }}>Collected</option>
                  </select>
                </div>
                <div>
                  <label class="block font-semibold">Price</label>
                  <input type="number" step="0.01" name="price" value="{{ $repair->price }}" class="w-full border p-2 rounded" />
                </div>
                <div>
                  <label class="block font-semibold">Date Received</label>
                  <input type="date" name="date_received" value="{{ $repair->date_received }}" required class="w-full border p-2 rounded" />
                </div>
                <div>
                  <label class="block font-semibold">Expected Completion</label>
                  <input type="date" name="expected_completion_date" value="{{ $repair->expected_completion_date }}" class="w-full border p-2 rounded" />
                </div>
              </div>
              <div class="mt-4 flex space-x-2">
                <button type="submit" class="link-button link-button-indigo flex-1"><i class="fas fa-save"></i> Update</button>
                <button type="button" onclick="closeModal('editModal{{ $repair->id }}')" class="link-button link-button-red flex-1">Cancel</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal{{ $repair->id }}" class="fixed inset-0 hidden items-center justify-center modal-bg z-50">
          <div class="bg-white rounded shadow-lg w-11/12 md:w-1/3 p-6 relative text-center">
            <h2 class="text-xl font-bold mb-4">Delete Repair #{{ $index + 1 }}</h2>
            <p>Are you sure you want to delete this repair record?</p>
            <form action="{{ route('tailor.delete_repair', $repair->id) }}" method="POST" class="mt-4 flex justify-center space-x-2">
              @csrf
              @method('DELETE')
              <button type="submit" class="link-button link-button-red px-4 py-2">Yes, Delete</button>
              <button type="button" onclick="closeModal('deleteModal{{ $repair->id }}')" class="link-button link-button-green px-4 py-2">Cancel</button>
            </form>
          </div>
        </div>

        @endforeach
      </tbody>
    </table>
  </div>

</div>

<script>
  AOS.init();
  document.getElementById('toggleForm').addEventListener('click', function() {
    const form = document.getElementById('repairForm');
    form.classList.toggle('hidden');
  });

  function openModal(id){
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
  }

  function closeModal(id){
    document.getElementById(id).classList.remove('flex');
    document.getElementById(id).classList.add('hidden');
  }
</script>

@include('layouts.footer') <!-- optional footer include -->
