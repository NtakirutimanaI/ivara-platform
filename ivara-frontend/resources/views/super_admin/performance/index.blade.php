@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper" style="padding-top: 120px !important;">
    <style>
        .dashboard-page .content .dashboard-wrapper {
            --primary: #4F46E5;
            --secondary: #64748B; 
            padding-top: 120px !important; 
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
        }
        /* Dark Mode */
        body.dark-mode .glass-panel { background: #1f2937 !important; border-color: #374151; }
        body.dark-mode h1, body.dark-mode h3 { color: #fff !important; }
        body.dark-mode p, body.dark-mode th, body.dark-mode td { color: #9ca3af !important; }
        body.dark-mode .table-row:hover { background: #374151 !important; }

        .table-custom { width: 100%; border-collapse: collapse; }
        .table-custom th { text-align: left; padding: 15px; color: #64748b; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
        .table-custom td { padding: 15px 10px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-row:hover { background: #f8fafc; transition: 0.2s; }
        .table-custom th:last-child, .table-custom td:last-child { width: 120px; text-align: center; }
        
        .score-badge {
            padding: 5px 12px; border-radius: 20px; font-weight: 700; font-size: 0.85rem;
        }
        .score-high { background: #dcfce7; color: #166534; }
        .score-med { background: #fef9c3; color: #854d0e; }
        .score-low { background: #fee2e2; color: #991b1b; }

        /* Tabs */
        .tabs-header { display: flex; gap: 20px; margin-bottom: 25px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px; }
        .tab-btn {
            background: none; border: none; font-size: 1rem; font-weight: 600; color: #64748b;
            padding: 10px 20px; cursor: pointer; position: relative;
        }
        .tab-btn.active { color: var(--primary); }
        .tab-btn.active::after {
            content: ''; position: absolute; bottom: -11px; left: 0; width: 100%; height: 3px; background: var(--primary); border-radius: 3px 3px 0 0;
        }
        body.dark-mode .tab-btn { color: #9ca3af; }
        body.dark-mode .tab-btn.active { color: #818cf8; }
        body.dark-mode .tab-btn.active::after { background: #818cf8; }
        body.dark-mode .tabs-header { border-color: #374151; }

        .tab-content { display: none; animation: fadeIn 0.3s ease; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        /* Modal Styles */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px);
            display: flex; justify-content: center; align-items: center; z-index: 1000;
            opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-glass {
            background: rgba(255, 255, 255, 0.95); width: 500px; padding: 30px; border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); transform: scale(0.95); transition: all 0.3s;
        }
        .modal-overlay.active .modal-glass { transform: scale(1); }
        .btn-glass { 
            padding: 6px 14px; 
            border-radius: 10px; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            cursor: pointer; 
            font-weight: 600; 
            font-size: 0.85rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
        }
        .btn-primary { 
            background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%); 
            color: white;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2); 
        }
        .btn-glass:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }
        .btn-glass:active { transform: translateY(0); }
    </style>

    <header class="pro-header" style="margin-bottom: 30px;">
        <div>
            <h1>Performance Matrix</h1>
            <p>Evaluate performance across all administrative levels</p>
        </div>
    </header>

    <div class="glass-panel">
        <div class="tabs-header">
            <button class="tab-btn active" onclick="switchTab('admins')">Admin Performance</button>
            <button class="tab-btn" onclick="switchTab('managers')">Managers Performance</button>
            <button class="tab-btn" onclick="switchTab('supervisors')">Supervisors Performance</button>
        </div>

        @foreach(['admins', 'managers', 'supervisors'] as $roleKey)
            <div id="tab-{{ $roleKey }}" class="tab-content {{ $loop->first ? 'active' : '' }}">
                <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 1.25rem; font-weight: 700; color: #1e293b;">
                    {{ ucfirst(trim($roleKey, 's')) }} Performance Overview
                </h3>
                
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Team Member</th>
                            <th>Role</th>
                            <th>Category</th>
                            <th>Team Controlled</th>
                            <th>Tasks Completed</th>
                            <th>Satisfaction Score</th>
                            <th>Efficiency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $data = $$roleKey ?? [];
                        @endphp
                        @forelse($data as $user)
                        @php
                            // Simulate performance metrics if not present
                            $score = $user['score'] ?? rand(70, 99);
                            $teamSize = match($roleKey) {
                                'admins' => rand(15, 30),
                                'managers' => rand(5, 15),
                                'supervisors' => rand(20, 50), // Field staff
                                default => 0
                            };
                            $tasks = $user['tasks'] ?? rand(50, 200);
                        @endphp
                        <tr class="table-row">
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=random" style="width: 32px; height: 32px; border-radius: 50%;">
                                    <span style="font-weight: 600;">{{ $user['name'] }}</span>
                                </div>
                            </td>
                            <td>{{ $user['role'] }}</td>
                            <td>{{ $user['category'] }}</td>
                            <td>{{ $teamSize }} Members</td>
                            <td style="font-weight: 600;">{{ $tasks }}</td>
                            <td>
                                @php
                                    $colorClass = $score >= 90 ? 'score-high' : ($score >= 75 ? 'score-med' : 'score-low');
                                @endphp
                                <span class="score-badge {{ $colorClass }}">{{ $score }}%</span>
                            </td>
                            <td>
                                <div style="width: 100px; height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden;">
                                    <div style="width: {{ $score }}%; height: 100%; background: {{ $score >= 90 ? '#22c55e' : '#eab308' }};"></div>
                                </div>
                            </td>
                            <td>
                                <button class="btn-glass btn-primary" onclick="openReviewModal('{{ $user['id'] }}', '{{ $user['name'] }}', '{{ $roleKey }}')">
                                    <i class="fas fa-edit"></i> Review
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 20px;">No records found for {{ $roleKey }}.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal-overlay">
    <div class="modal-glass">
        <h3 style="margin-top: 0; color: #1e293b;">Write Performance Review</h3>
        <p style="color: #64748b; margin-bottom: 20px;">Reviewing: <span id="reviewTargetName" style="font-weight: 700;"></span></p>
        
        <form id="reviewForm" onsubmit="submitReview(event)">
            @csrf
            <input type="hidden" name="user_id" id="reviewUserId">
            <input type="hidden" name="role_key" id="reviewRoleKey">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px; color: #4b5563;">Performance Feedback</label>
                <textarea name="review_content" rows="5" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #e5e7eb; background: #f9fafb;" placeholder="Detailed feedback on performance..." required></textarea>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px; color: #4b5563;">Key Rating (1-10)</label>
                <input type="number" name="rating" min="1" max="10" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #e5e7eb; background: #f9fafb;" required>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-glass" style="background: #e5e7eb; color: #374151;" onclick="closeReviewModal()">Cancel</button>
                <button type="submit" class="btn-glass btn-primary">Submit Review</button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');
        const btns = document.querySelectorAll('.tab-btn');
        if(tabId === 'admins') btns[0].classList.add('active');
        if(tabId === 'managers') btns[1].classList.add('active');
        if(tabId === 'supervisors') btns[2].classList.add('active');
    }

    function openReviewModal(id, name, roleKey) {
        document.getElementById('reviewUserId').value = id;
        document.getElementById('reviewTargetName').textContent = name;
        document.getElementById('reviewRoleKey').value = roleKey;
        document.getElementById('reviewModal').classList.add('active');
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.remove('active');
    }

    function submitReview(e) {
        e.preventDefault();
        const form = document.getElementById('reviewForm');
        const formData = new FormData(form);

        fetch("{{ route('super_admin.performance.review.store') }}", {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                toastr.success(data.message);
                closeReviewModal();
                form.reset();
            } else {
                toastr.error('Error submitting review');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Something went wrong');
        });
    }
</script>
@endsection
