
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Supervisor - Invoices & Transactions</h2>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Invoices Table --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Invoice No</th>
                    <th class="px-4 py-2 border">Client</th>
                    <th class="px-4 py-2 border">Issued At</th>
                    <th class="px-4 py-2 border">Due Date</th>
                    <th class="px-4 py-2 border">Subtotal</th>
                    <th class="px-4 py-2 border">Tax</th>
                    <th class="px-4 py-2 border">Grand Total</th>
                    <th class="px-4 py-2 border">Amount Due</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $invoice->id }}</td>
                        <td class="px-4 py-2 border font-bold">#{{ $invoice->number }}</td>
                        <td class="px-4 py-2 border">
                            {{ $invoice->client?->name ?? 'Unknown Client' }}
                        </td>
                        <td class="px-4 py-2 border">{{ $invoice->issued_at ? $invoice->issued_at->format('Y-m-d') : '-' }}</td>
                        <td class="px-4 py-2 border">{{ $invoice->due_date ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ number_format($invoice->subtotal, 2) }}</td>
                        <td class="px-4 py-2 border">{{ number_format($invoice->tax_total, 2) }}</td>
                        <td class="px-4 py-2 border font-semibold">{{ number_format($invoice->grand_total, 2) }}</td>
                        <td class="px-4 py-2 border text-red-600">{{ number_format($invoice->amount_due, 2) }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-sm rounded 
                                {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-800' : 
                                   ($invoice->status == 'pending' ? 'bg-[#f5f3ff] text-[#924FC2]' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border">
                            <button onclick="openViewModal({{ $invoice->id }})" 
                                class="bg-blue-600 text-white px-3 py-1 rounded">View</button>
                            <button onclick="openEditModal({{ $invoice->id }})" 
                                class="bg-green-600 text-white px-3 py-1 rounded">Edit</button>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="bg-red-600 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-4 py-2 text-center">No invoices found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $invoices->links() }}
    </div>
</div>

{{-- =================== View Invoice Modal =================== --}}
<div id="viewModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
        <h3 class="text-lg font-bold mb-4">Invoice Details</h3>
        <div id="invoice-details">
            {{-- AJAX will load invoice details here --}}
        </div>
        <button onclick="closeViewModal()" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded">Close</button>
    </div>
</div>

<script>
    function openViewModal(id) {
        document.getElementById('viewModal').classList.remove('hidden');
        // Fetch invoice details via AJAX
        fetch(`/invoices/${id}`)
            .then(res => res.text())
            .then(data => {
                document.getElementById('invoice-details').innerHTML = data;
            });
    }
    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }
</script>
