@include('layouts.header')
@include('layouts.sidebar')

<!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; background: #f5f7fa; color: #333; }
.container { width: 85%; margin-left: 240px; margin-top: 50px; padding: 15px; }
h2 { font-weight: 600; color: #4f46e5; margin-bottom: 20px; }
.table { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.1); font-size: 0.85rem; }
.table thead th { background: #e5e7eb; text-align: center; padding: 10px; border-bottom: 1px solid #ccc; }
.table tbody td { text-align: center; vertical-align: middle; padding: 8px; border-bottom: 1px solid #ccc; }
.table img { max-width: 60px; height: auto; border-radius: 4px; }
.btn-sm { padding: 3px 8px; font-size: 0.75rem; }
.no-data { margin-top: 20px; font-size: 0.9rem; color: #dc2626; }
@media (max-width: 1200px) { .container { width: 90%; margin-left: 200px; } .table img { max-width: 50px; } }
@media (max-width: 992px) { .container { width: 95%; margin-left: 0; } .table img { max-width: 45px; } }
@media (max-width: 768px) { h2 { font-size: 1.4rem; } .table { font-size: 0.75rem; } .table img { max-width: 35px; } }
</style>

<div class="container">
    <h2>All Products & Services</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->count() > 0)
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price (RWF)</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Make Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description ?? '-' }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $item->id }}">
                            Pay Service
                        </button>

                        <!-- Payment Modal -->
                        <div class="modal fade" id="paymentModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('technician.services.pay', $item->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Make Payment - {{ $item->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Payment Method</label>
                                                <select name="payment_method" class="form-select" required>
                                                    <option value="">Select Payment</option>
                                                    <option value="MTN Mobile Money">MTN Mobile Money</option>
                                                    <option value="Airtel Money">Airtel Money</option>
                                                    <option value="Visa/MasterCard">Visa/MasterCard</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label>Enter Payment Details</label>
                                                <input type="text" name="payment_details" class="form-control" placeholder="Phone, Card number, or Bank info" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Amount</label>
                                                <input type="number" name="amount" class="form-control" value="{{ $item->price }}" readonly>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Process Payment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="no-data">No products or services found.</div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')
