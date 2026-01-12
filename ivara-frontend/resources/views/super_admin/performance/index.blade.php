@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper" style="padding-top: 40px !important;">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338ca;
            --secondary: #64748B;
            --bg-glass: rgba(255, 255, 255, 0.9);
            --border-glass: rgba(255, 255, 255, 0.5);
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        [data-theme="dark"] {
            --bg-glass: #1f2937;
            --border-glass: #374151;
            --text-dark: #f8fafc;
            --text-muted: #9ca3af;
        }

        .dashboard-wrapper { padding-top: 40px !important; }
        
        .glass-panel {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--premium-shadow);
            padding: 18px 22px;
            overflow-x: auto;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 6px; }
        .table-custom th { text-align: left; padding: 10px 12px; color: var(--text-muted); font-weight: 800; font-size: 0.7rem; text-transform: uppercase; border-bottom: 1px solid var(--border-glass); letter-spacing: 0.5px; }
        .table-custom td { padding: 10px 12px; color: var(--text-dark); background: transparent; vertical-align: middle; border-bottom: 1px solid var(--border-glass); font-size: 0.85rem; font-weight: 500; }
        .table-row { transition: all 0.2s; }
        .table-row:hover { background: rgba(79, 70, 229, 0.04); transform: scale(1.002); }
        [data-theme="dark"] .table-row:hover { background: rgba(79, 70, 229, 0.1); }
        
        .score-badge {
            padding: 6px 14px; border-radius: 50px; font-weight: 700; font-size: 0.8rem;
            display: inline-block;
        }
        .score-high { background: #dcfce7; color: #166534; }
        .score-med { background: #fef9c3; color: #854d0e; }
        .score-low { background: #fee2e2; color: #991b1b; }

        [data-theme="dark"] .score-high { background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        [data-theme="dark"] .score-med { background: rgba(234, 179, 8, 0.2); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.3); }
        [data-theme="dark"] .score-low { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }

        /* Tabs */
        .tabs-header { display: flex; gap: 24px; margin-bottom: 30px; border-bottom: 1px solid var(--border-glass); padding-bottom: 5px; }
        .tab-btn {
            background: none; border: none; font-size: 0.95rem; font-weight: 700; color: var(--text-muted);
            padding: 12px 10px; cursor: pointer; position: relative; transition: 0.3s;
        }
        .tab-btn:hover { color: var(--primary); }
        .tab-btn.active { color: var(--primary); }
        .tab-btn.active::after {
            content: ''; position: absolute; bottom: -6px; left: 0; width: 100%; height: 3px; background: var(--primary); border-radius: 3px 3px 0 0;
        }

        .tab-content { display: none; animation: fadeIn 0.4s ease; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Progress Track */
        .efficiency-track { width: 100px; height: 8px; background: #e2e8f0; border-radius: 10px; overflow: hidden; }
        [data-theme="dark"] .efficiency-track { background: #374151; }

        /* Modal Styles */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(8px);
            display: flex; justify-content: center; align-items: center; z-index: 1000;
            opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-glass {
            background: var(--bg-glass); width: 100%; max-width: 500px; padding: 32px; border-radius: 24px;
            border: 1px solid var(--border-glass);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); transform: scale(0.95); transition: all 0.3s;
        }
        .modal-overlay.active .modal-glass { transform: scale(1); }
        
        .btn-glass { 
            padding: 7px 15px; 
            border-radius: 10px; 
            border: 1px solid transparent; 
            cursor: pointer; 
            font-weight: 800; 
            font-size: 0.75rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }
        .btn-primary { 
            background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%); 
            color: white !important;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25); 
        }
        .btn-glass:hover { transform: translateY(-2px) scale(1.05); filter: brightness(1.1); box-shadow: 0 8px 15px rgba(79, 70, 229, 0.3); }
        .btn-glass:active { transform: translateY(0) scale(0.98); }

        .form-control-custom {
            width: 100%; padding: 12px; border-radius: 12px; 
            border: 1px solid var(--border-glass); 
            background: rgba(255, 255, 255, 0.5);
            color: var(--text-dark);
            transition: 0.3s;
        }
        [data-theme="dark"] .form-control-custom { background: rgba(0, 0, 0, 0.2); }
        .form-control-custom:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
    </style>

    <header class="pro-header" style="margin-bottom: 30px;">
        <div>
            <h1 style="color: var(--text-dark);">Performance Matrix</h1>
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
                <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 1.25rem; font-weight: 700; color: var(--text-dark);">
                    {{ ucfirst(trim($roleKey, 's')) }} Performance Overview
                </h3>
                
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Team Member</th>
                            <th>Role</th>
                            <th>Category</th>
                            <th class="text-nowrap">Controlled</th>
                            <th class="text-nowrap">Tasks</th>
                            <th>Score</th>
                            <th>Efficiency</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $flatKey = $roleKey . '_flat';
                            $data = $$flatKey ?? [];
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
                                <div class="efficiency-track">
                                    <div style="width: {{ $score }}%; height: 100%; background: {{ $score >= 90 ? '#22c55e' : '#eab308' }};"></div>
                                </div>
                            </td>
                             <td style="text-align: right;">
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
        <h3 style="margin-top: 0; color: var(--text-dark);">Write Performance Review</h3>
        <p style="color: var(--text-muted); margin-bottom: 20px;">Reviewing: <span id="reviewTargetName" style="font-weight: 700; color: var(--primary);"></span></p>
        
        <form id="reviewForm" onsubmit="submitReview(event)">
            @csrf
            <input type="hidden" name="user_id" id="reviewUserId">
            <input type="hidden" name="role_key" id="reviewRoleKey">
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">Performance Feedback</label>
                <textarea name="review_content" rows="5" class="form-control-custom" placeholder="Detailed feedback on performance..." required></textarea>
            </div>
            
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">Key Rating (1-10)</label>
                <input type="number" name="rating" min="1" max="10" class="form-control-custom" required>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" class="btn-glass" style="background: var(--border-glass); color: var(--text-dark);" onclick="closeReviewModal()">Cancel</button>
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
                showNotify(data.message);
                closeReviewModal();
                form.reset();
            } else {
                showNotify('Error submitting review', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotify('Something went wrong', 'error');
        });
    }
</script>
@endsection
