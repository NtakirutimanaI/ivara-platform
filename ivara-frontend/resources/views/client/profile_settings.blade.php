@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
body { font-family:'Segoe UI', sans-serif; background:#f0f2f8; color:#333; }
h2 { color:#4f46e5; text-align:center; margin-bottom:20px; }
.profile-form-container { background:#fff; padding:30px; border-radius:12px; max-width:1000px; margin-left:290px; margin-top:120px; box-shadow:0 6px 20px rgba(0,0,0,0.08);}
#profilePreview { border:2px solid #ddd; width:150px; height:150px; object-fit:cover; }
@media(max-width:768px){ #profilePreview { width:120px; height:120px; } }
.nav-tabs .nav-link.active { background:#4f46e5; color:#fff; font-weight:600; }
</style>

<div class="container profile-form-container">
    <h2>Profile Settings</h2>
    <div id="alert-container"></div>

    <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile">Profile Info</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#security">Security</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#subscription">Subscription & Billing</button></li>
    </ul>

    <form id="profileForm" enctype="multipart/form-data">@csrf
        <div class="tab-content">
            <!-- Profile Tab -->
            <div class="tab-pane fade show active" id="profile">
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <img id="profilePreview" src="{{ $user->profile?->profile_photo ? asset('storage/'.$user->profile->profile_photo) : asset('images/default-avatar.png') }}" class="rounded-circle mb-2">
                        <input type="file" name="profile_photo" id="profile_photo" class="d-none" accept="image/*">
                        <label for="profile_photo" class="btn btn-primary btn-sm">Change Photo</label>
                        <div class="text-muted small mt-2">Account created on: {{ $user->created_at->format('F d, Y') }}</div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6"><label>Name</label><input type="text" name="name" value="{{ $user->name }}" class="form-control"></div>
                            <div class="col-md-6"><label>Email</label><input type="email" name="email" value="{{ $user->email }}" class="form-control"></div>
                            <div class="col-md-6"><label>Phone</label><input type="text" name="phone" value="{{ $user->profile?->phone ?? '' }}" class="form-control"></div>
                            <div class="col-md-6"><label>Address</label><input type="text" name="address" value="{{ $user->profile?->address ?? '' }}" class="form-control"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Tab -->
            <div class="tab-pane fade" id="security">
                <div class="row g-3">
                    <div class="col-md-4"><label>New Password</label><input type="password" name="password" class="form-control"></div>
                    <div class="col-md-4"><label>Confirm Password</label><input type="password" name="password_confirmation" class="form-control"></div>
                </div>
            </div>

            <!-- Subscription Tab -->
            <div class="tab-pane fade" id="subscription">
                <p>Current Plan: <strong>{{ $user->profile?->subscription_plan ?? 'Free' }}</strong></p>
                <p>Next Billing: <strong>{{ $user->profile?->next_billing_date ?? 'N/A' }}</strong></p>
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#upgradePlanModal">Upgrade Plan</button>
            </div>
        </div>

        <div class="text-end mt-3"><button type="submit" class="btn btn-primary">Save Changes</button></div>
    </form>
</div>

<!-- Upgrade Plan Modal -->
<div class="modal fade" id="upgradePlanModal" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header"><h5>Upgrade Subscription Plan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <form id="upgradePlanForm">@csrf
          <div class="mb-3">
            <label>Select Plan</label>
            <select name="plan" class="form-select" required>
              <option value="">Choose</option>
              <option value="basic">Basic - $10</option>
              <option value="pro">Pro - $25</option>
              <option value="enterprise">Enterprise - $50</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-select" required>
              <option value="">Select</option>
              <option value="card">Card</option>
              <option value="paypal">PayPal</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">Upgrade</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$('#profile_photo').on('change', function(){
    const file = this.files[0];
    if(file){ const reader = new FileReader();
        reader.onload = function(e){ $('#profilePreview').attr('src', e.target.result); }
        reader.readAsDataURL(file);
    }
});

$('#profileForm').on('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: "{{ route('client.profile.update') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(res){ $('#alert-container').html('<div class="alert alert-success">'+res.message+'</div>'); if(res.profile_photo){ $('#profilePreview').attr('src', res.profile_photo); } },
        error: function(xhr){ $('#alert-container').html('<div class="alert alert-danger">Please fix the errors</div>'); }
    });
});

$('#upgradePlanForm').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ route('client.subscription.upgrade') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function(res){
            $('#upgradePlanModal').modal('hide');
            $('#alert-container').html('<div class="alert alert-success">'+res.message+'</div>');
            $('p:contains("Current Plan") strong').text(res.new_plan);
        },
        error: function(){ $('#alert-container').html('<div class="alert alert-danger">Failed to upgrade</div>'); }
    });
});
</script>
