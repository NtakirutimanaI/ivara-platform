@extends('layouts.app')

@section('title', 'Support Desk')

@section('content')
<div class="technician-page-container">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-primary">Technical Support Hub</h1>
                <p class="text-muted">Get assistance with complex repairs or administrative issues.</p>
            </div>
            <button class="btn btn-danger rounded-pill px-4">
                <i class="fas fa-life-ring me-2"></i> Raise Priority Ticket
            </button>
        </div>

        <div class="row g-4">
            <!-- Knowledge Base -->
            <div class="col-md-7">
                <div class="glass-card p-4">
                    <h5 class="fw-bold mb-4">Common Technical Solutions</h5>
                    <div class="accordion accordion-flush" id="faqAccordion">
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                                    How to resolve "Mainboard Authentication" error?
                                </button>
                            </h2>
                            <div id="q1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Ensure you have updated the serial number in the Ivara Cloud portal before powering on the device. Sync takes 5-10 minutes.
                                </div>
                            </div>
                        </div>
                         <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                                    What to do if a client refuses a repair quote?
                                </button>
                            </h2>
                            <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Mark the job as "Voided by Client". You may still charge the diagnostic fee as per the company's terms of service.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Direct Contact -->
            <div class="col-md-5">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold mb-4">Direct Contact Channels</h5>
                    <div class="d-grid gap-3">
                        <div class="contact-pill p-3 border rounded-4 d-flex align-items-center gap-3">
                            <div class="icon-circle bg-success text-white"><i class="fab fa-whatsapp"></i></div>
                            <div>
                                <h6 class="fw-bold mb-0">Supervisor WhatsApp</h6>
                                <p class="small text-muted mb-0">Response: < 10 mins</p>
                            </div>
                        </div>
                         <div class="contact-pill p-3 border rounded-4 d-flex align-items-center gap-3">
                            <div class="icon-circle bg-primary text-white"><i class="fas fa-headset"></i></div>
                            <div>
                                <h6 class="fw-bold mb-0">Live Admin Chat</h6>
                                <p class="small text-muted mb-0">Available 8AM - 10PM</p>
                            </div>
                        </div>
                        <div class="contact-pill p-3 border rounded-4 d-flex align-items-center gap-3">
                            <div class="icon-circle bg-secondary text-white"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h6 class="fw-bold mb-0">Email Tech Support</h6>
                                <p class="small text-muted mb-0">tech-support@ivara.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .technician-page-container { width: 96%; margin-left: 15px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .icon-circle { width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
</style>
@endsection
