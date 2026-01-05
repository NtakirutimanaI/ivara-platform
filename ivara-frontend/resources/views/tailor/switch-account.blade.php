@include('layouts.header')
@include('layouts.sidebar')

<div class="switch-container">
    <div class="switch-card">
        <h2>Switch Account</h2>
        <p>
            You are currently logged in as 
            <strong>{{ $role ?? ucfirst(auth()->user()->role) }}</strong>.
        </p>
        <p>
            Would you like to switch to your <strong>Mediator</strong> account?
        </p>

        <form action="{{ route('switch-account.to-mediator') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mt-3">
                Yes, Switch to Mediator
            </button>
        </form>

        <a href="{{ route('tailor.dashboard') }}" class="btn btn-secondary mt-3">
            Cancel
        </a>
    </div>
</div>

<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #f4f6f8;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Center content vertically & horizontally */
.switch-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

.switch-card {
    width: 100%;
    max-width: 400px;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    box-sizing: border-box;
}

h2 {
    font-size: 1.8rem;
    color: #333333;
    margin-bottom: 20px;
}

p {
    font-size: 1rem;
    color: #555555;
    margin-bottom: 30px;
}

p strong {
    color: #000000;
}

.btn {
    display: inline-block;
    font-size: 1rem;
    font-weight: 600;
    padding: 12px 25px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-primary {
    background-color: #924FC2;
    color: #ffffff;
}

.btn-primary:hover {
    background-color: #924FC2;
}

.btn-secondary {
    background-color: #6c757d;
    color: #ffffff;
    text-decoration: none;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .switch-card {
        padding: 25px;
        max-width: 90%;
    }

    h2 {
        font-size: 1.6rem;
    }

    p {
        font-size: 0.95rem;
    }

    .btn {
        width: 100%;
        margin-top: 10px;
    }
}

@media (max-width: 480px) {
    .switch-card {
        padding: 20px;
    }

    h2 {
        font-size: 1.4rem;
    }

    p {
        font-size: 0.9rem;
    }
}
</style>

@include('layouts.footer')
