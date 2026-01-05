@php
    // make sure facade is accessible in Blade
    use Illuminate\Support\Facades\Storage;
@endphp

<section style="padding: 4rem 1rem; text-align: center; background-color: #f9f9f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <div style="max-width: 1200px; margin: auto;">

    <p style="color:#555; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">
      <u>Coming Soon</u>
    </p>

    <h2 style="font-size: 2rem; color:#071839; font-weight: 700; margin-bottom: 0.5rem;">
      Connect IVARA with your favourite platforms
    </h2>

    <p style="font-size: 0.95rem; color: #444; max-width: 600px; margin: auto; margin-bottom: 2rem;">
      IVARA seamlessly integrates with popular community tools, government systems, and communication platforms.
    </p>

    <div style="display:flex; flex-wrap:wrap; justify-content:center; align-items:center; gap:1rem; margin-bottom:2rem;">

      <!-- Static logos -->
      <img src="{{ asset('images/adds.png') }}" alt="RBC" style="height:40px; object-fit:contain;" />
      <img src="{{ asset('images/in.png') }}" alt="WhatsApp" style="height:40px; object-fit:contain;" />
      <img src="{{ asset('images/mtn2.png') }}" alt="SMS Gateway" style="height:40px; object-fit:contain;" />
      <img src="{{ asset('images/whatsapp.png') }}" alt="Google Maps" style="height:40px; object-fit:contain;" />
      <img src="{{ asset('images/send.png') }}" alt="Airtel Money" style="height:40px; object-fit:contain;" />
      <img src="{{ asset('images/itel.png') }}" alt="MTN MoMo" style="height:40px; object-fit:contain;" />

      <!-- Dynamic images (only if file exists) -->
      @if(isset($updates) && $updates->count() > 0)
          @foreach($updates as $update)
              @if(!empty($update->image) && Storage::disk('public')->exists($update->image))
                  <img
                    src="{{ Storage::disk('public')->url($update->image) }}"
                    alt="{{ $update->event_name ?? 'Update' }}"
                    style="height:40px; object-fit:contain; border:1px solid #eee; border-radius:4px;"
                  />
              @endif
          @endforeach
      @endif

    </div>

    <a href="{{ route('web.updates') }}" style="display:inline-block; background-color:#ffb700; color:#071839; padding:0.75rem 1.5rem; border-radius:2rem; font-weight:bold; text-decoration:none; transition:background 0.3s;">
      Get Coming Updates →
    </a>

  </div>
</section>
