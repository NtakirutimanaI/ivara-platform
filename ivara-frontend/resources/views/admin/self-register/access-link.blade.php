@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Self-Register Link Interface</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.9rem;
    color: #333;
}

.page-container {
    width: 80%;
    max-width: 600px;
    margin: 120px auto 40px auto;
    padding: 15px;
}

.card {
    background: #ffffff;
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.card h2 {
    margin-bottom: 18px;
    color: #924FC2;
    font-size: 1.5rem;
    font-weight: 600;
}

.input-group {
    margin-bottom: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.input-group input {
    flex: 1;
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #924FC2;
    outline: none;
    font-size: 0.9rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.input-group input:focus {
    border-color: #3730a3;
    box-shadow: 0 0 5px rgba(79, 70, 229, 0.3);
}

.input-group button {
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    background-color: #924FC2;
    color: #fff;
    cursor: pointer;
    font-size: 0.85rem;
    transition: background 0.3s ease, transform 0.2s ease;
}

.input-group button:hover {
    background-color: #3730a3;
    transform: scale(1.05);
}

.share-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 18px;
}

.share-buttons button {
    padding: 7px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    color: #fff;
    font-weight: 500;
    font-size: 0.85rem;
    transition: transform 0.2s ease, opacity 0.2s ease;
}

.share-buttons button:hover {
    opacity: 0.9;
    transform: scale(1.05);
}

.share-buttons .whatsapp { background: #25D366; }
.share-buttons .email { background: #D44638; }
.share-buttons .instagram { background: #C13584; }
.share-buttons .copy { background: #924FC2; }

.view-button {
    padding: 8px 18px;
    border-radius: 6px;
    border: none;
    background-color: #924FC2;
    color: #fff;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.3s ease, transform 0.2s ease;
}

.view-button:hover {
    background-color: #3730a3;
    transform: scale(1.03);
}

.alert-success {
    margin-bottom: 15px;
    font-size: 0.85rem;
    padding: 8px 12px;
    border-radius: 6px;
}

/* Responsive adjustments */
@media(max-width:576px){
    .page-container { width: 95%; padding: 12px; margin-top: 180px; }
    .input-group input { font-size: 0.85rem; padding: 6px 8px; }
    .input-group button, .view-button, .share-buttons button { font-size: 0.8rem; padding: 6px 10px; }
    .card { padding: 20px 15px; }
    .card h2 { font-size: 1.3rem; }
}
</style>
</head>
<body>

<div class="page-container">
    <div class="card">
        <h2>Client Self-Register Link</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="input-group">
            <input type="text" id="selfRegisterLink" value="{{ route('self-register.index') }}" readonly>
            <button onclick="copyLink()">Copy</button>
        </div>

        <div class="share-buttons">
            <button class="whatsapp" onclick="shareWhatsApp()">WhatsApp</button>
            <button class="email" onclick="shareEmail()">Email</button>
            <button class="instagram" onclick="shareInstagram()">Instagram</button>
        </div>

        <button class="view-button" onclick="viewForm()">View Form</button>
    </div>
</div>

<script>
function copyLink() {
    var copyText = document.getElementById("selfRegisterLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    alert("Link copied: " + copyText.value);
}

function shareWhatsApp() {
    var url = encodeURIComponent(document.getElementById("selfRegisterLink").value);
    window.open("https://wa.me/?text=" + url, "_blank");
}

function shareEmail() {
    var subject = encodeURIComponent("Register Your Device / Vehicle / Item");
    var body = encodeURIComponent("Hello! Please use the following link to register your item: " + document.getElementById("selfRegisterLink").value);
    window.open("mailto:?subject=" + subject + "&body=" + body, "_blank");
}

function shareInstagram() {
    alert("Instagram does not allow direct URL sharing. Copy the link and share manually.");
}

function viewForm() {
    var url = document.getElementById("selfRegisterLink").value;
    window.open(url, "_blank");
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@include('layouts.footer')
