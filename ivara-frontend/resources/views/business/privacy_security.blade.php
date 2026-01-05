@include('layouts.header')
@include('layouts.sidebar')
@include('business.connect')

<div class="privacy-sec-container">
    <h1 class="privacy-sec-title">Privacy & Security</h1>

    <div class="privacy-sec-auth-box">
        <!-- Step 1: Login -->
        <div id="privacy-sec-step1" class="privacy-sec-step privacy-sec-active">
            <h2>Step 1: Login</h2>
            <form id="privacy-sec-loginForm">
                <label>Email/Phone</label>
                <input type="text" id="privacy-sec-username" required placeholder="Enter your email or phone">

                <label>Password</label>
                <input type="password" id="privacy-sec-password" required placeholder="Enter your password">

                <button type="submit" class="privacy-sec-btn">Continue</button>
            </form>
        </div>

        <!-- Step 2: OTP Verification -->
        <div id="privacy-sec-step2" class="privacy-sec-step">
            <h2>Step 2: Two-Factor Authentication</h2>
            <p>Enter the 6-digit code sent to your email/phone.</p>
            <form id="privacy-sec-otpForm">
                <div class="privacy-sec-otp-inputs">
                    @for($i=0;$i<6;$i++)
                        <input type="text" maxlength="1" class="privacy-sec-otp-box" required>
                    @endfor
                </div>
                <button type="submit" class="privacy-sec-btn">Verify Code</button>
                <button type="button" id="privacy-sec-resendBtn" class="privacy-sec-btn" disabled>Resend OTP (30s)</button>
            </form>
        </div>

        <!-- Step 3: Success -->
        <div id="privacy-sec-step3" class="privacy-sec-step">
            <h2>Step 3: Verification Successful ✅</h2>
            <p>You are now logged in securely with Two-Factor Authentication.</p>
        </div>
    </div>
</div>

<style>
/* Layout and Styles */
.privacy-sec-container { width: 80%; margin-left: 30%; margin-top: 150px; }
.privacy-sec-title { font-size: 2rem; font-weight: 600; margin-bottom: 20px; }
.privacy-sec-auth-box { background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 30px; max-width: 500px; width: 100%; }
h2 { font-size: 1.5rem; margin-bottom: 15px; }
label { display: block; font-weight: 500; margin: 10px 0 5px; }
input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 15px; font-size: 1rem; }
.privacy-sec-btn { width: 100%; padding: 12px; background: #2563eb; color: white; font-size: 1rem; font-weight: bold; border: none; border-radius: 8px; cursor: pointer; transition: background 0.3s ease; margin-top: 10px; }
.privacy-sec-btn:hover:enabled { background: #1e40af; }
.privacy-sec-btn:disabled { background: #9ca3af; cursor: not-allowed; }
.privacy-sec-step { display: none; animation: privacy-sec-fadeIn 0.3s ease-in-out; }
.privacy-sec-step.privacy-sec-active { display: block; }

/* OTP Inputs */
.privacy-sec-otp-inputs { display: flex; justify-content: space-between; margin: 20px 0; }
.privacy-sec-otp-box { width: 45px; height: 50px; font-size: 1.5rem; text-align: center; border: 1px solid #ccc; border-radius: 8px; transition: border-color 0.3s ease; }

/* Animations */
@keyframes privacy-sec-fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
@keyframes privacy-sec-shake { 0%,100% { transform: translateX(0); } 20%,60% { transform: translateX(-8px); } 40%,80% { transform: translateX(8px); } }
@keyframes privacy-sec-glow { 0%,100% { box-shadow: none; } 50% { box-shadow: 0 0 8px 2px #16a34a; } }

.privacy-sec-shake { animation: privacy-sec-shake 0.4s ease; border-color: red !important; }
.privacy-sec-success-glow { animation: privacy-sec-glow 0.5s ease; border-color: #16a34a !important; }

/* Responsive */
@media (max-width:1024px){.privacy-sec-container{width:95%;margin-left:auto;margin-right:auto;} }
@media (max-width:600px){.privacy-sec-auth-box{padding:20px;}.privacy-sec-title{font-size:1.5rem;}.privacy-sec-otp-box{width:40px;height:45px;font-size:1.2rem;} }
</style>

<script>
const step1 = document.getElementById("privacy-sec-step1");
const step2 = document.getElementById("privacy-sec-step2");
const step3 = document.getElementById("privacy-sec-step3");
const otpBoxes = document.querySelectorAll(".privacy-sec-otp-box");
const resendBtn = document.getElementById("privacy-sec-resendBtn");
let resendTimer;

// Step 1: Login
document.getElementById("privacy-sec-loginForm").addEventListener("submit", function(e){
    e.preventDefault();
    let username = document.getElementById("privacy-sec-username").value;
    let password = document.getElementById("privacy-sec-password").value;

    let formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    formData.append('_token', '{{ csrf_token() }}');

    fetch("{{ route('business.privacy.login') }}", {
        method: "POST",
        body: formData,
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {
        if(data.status==="success"){
            step1.classList.remove("privacy-sec-active");
            step2.classList.add("privacy-sec-active");
            startResendTimer();
            alert("📩 OTP sent to your email/phone.");
        } else {
            alert(data.message);
        }
    });
});

// OTP Input Auto-Advance
otpBoxes.forEach((box,index)=>{
    box.addEventListener("input",()=>{ if(box.value && index<otpBoxes.length-1){ otpBoxes[index+1].focus(); } });
    box.addEventListener("keydown",(e)=>{ if(e.key==="Backspace" && !box.value && index>0){ otpBoxes[index-1].focus(); } });
});

// Step 2: Verify OTP
document.getElementById("privacy-sec-otpForm").addEventListener("submit", function(e){
    e.preventDefault();
    const otp = Array.from(otpBoxes).map(box=>box.value).join("");

    let otpFormData = new FormData();
    otpFormData.append('otp', otp);
    otpFormData.append('_token', '{{ csrf_token() }}');

    fetch("{{ route('business.privacy.verifyOtp') }}", {
        method: "POST",
        body: otpFormData,
        credentials: "same-origin"
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status==="success"){
            otpBoxes.forEach(box=>box.classList.add("privacy-sec-success-glow"));
            setTimeout(()=>{
                otpBoxes.forEach(box=>box.classList.remove("privacy-sec-success-glow"));
                step2.classList.remove("privacy-sec-active");
                step3.classList.add("privacy-sec-active");
            },500);
        } else {
            otpBoxes.forEach(box=>{ box.classList.add("privacy-sec-shake"); box.value=""; });
            otpBoxes[0].focus();
            setTimeout(()=>otpBoxes.forEach(box=>box.classList.remove("privacy-sec-shake")),500);
            alert("❌ "+data.message);
        }
    });
});

// Resend OTP
resendBtn.addEventListener("click", ()=>{
    let resendFormData = new FormData();
    resendFormData.append('_token', '{{ csrf_token() }}');

    fetch("{{ route('business.privacy.resendOtp') }}", {
        method: "POST",
        body: resendFormData,
        credentials: "same-origin"
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status==="success"){
            startResendTimer();
            otpBoxes.forEach(box=>box.value="");
            otpBoxes[0].focus();
            alert("📩 "+data.message);
        } else { alert(data.message); }
    });
});

// Resend timer
function startResendTimer(){
    let timeLeft = 30;
    resendBtn.disabled = true;
    resendBtn.textContent = `Resend OTP (${timeLeft}s)`;
    resendTimer = setInterval(()=>{
        timeLeft--;
        resendBtn.textContent = `Resend OTP (${timeLeft}s)`;
        if(timeLeft<=0){
            clearInterval(resendTimer);
            resendBtn.disabled=false;
            resendBtn.textContent="Resend OTP";
        }
    },1000);
}
</script>

@include('layouts.footer')
