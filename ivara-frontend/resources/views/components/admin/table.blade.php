@props(['headers'])

<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light text-muted text-uppercase small ls-1">
            <tr>
                @foreach($headers as $header)
                    <th class="border-0 py-3 ps-4 fw-bold" style="font-size: 0.75rem;">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white">
            {{ $slot }}
        </tbody>
    </table>
</div>
