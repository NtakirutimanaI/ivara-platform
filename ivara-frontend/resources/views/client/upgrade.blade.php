@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<div class="container profile-form-container">
    <h2>Upgrade / Downgrade Subscription Plan</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="current-plan mb-5 p-4 bg-light rounded-3 shadow-sm">
        <h4 class="mb-3"><i class="fa fa-star me-2"></i>Current Plan:</h4>
        <p><strong>{{ $currentPlan->name ?? 'No Plan Selected' }}</strong></p>
        <p>Renews on: {{ $currentPlan->renewal_date ?? '-' }}</p>
        <p>Features:</p>
        <ul>
            @if($currentPlan)
                @foreach(explode(',', $currentPlan->features) as $feature)
                    <li><i class="fa fa-check text-success me-1"></i>{{ $feature }}</li>
                @endforeach
            @endif
        </ul>
    </div>

    <div class="available-plans row g-4">
        @foreach($plans as $plan)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h5 class="mb-1">{{ $plan->name }}</h5>
                    <p class="mb-0 fs-6">${{ number_format($plan->price, 2) }}/{{ $plan->duration }}</p>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @foreach(explode(',', $plan->features) as $feature)
                            <li><i class="fa fa-check text-success me-2"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center bg-white border-0">
                    @if($currentPlan && $currentPlan->id === $plan->id)
                        <button class="btn btn-secondary w-100" disabled>
                            <i class="fa fa-star me-1"></i>Current Plan
                        </button>
                    @else
                        <form action="{{ route('subscription.change', $plan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-arrow-up me-1"></i>Select Plan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f0f2f8;
    color: #333;
}
h2 {
    color: #4f46e5;
    text-align: center;
    margin-bottom: 30px;
}
.profile-form-container {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    max-width: 75%;
    margin-top: 100px;
    margin-left: 270px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
@media(max-width:768px){
    .profile-form-container {
        margin: 50px 15px 30px 15px;
        padding: 20px;
    }
}
.card-header h5, .card-header p {
    margin: 0;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')
