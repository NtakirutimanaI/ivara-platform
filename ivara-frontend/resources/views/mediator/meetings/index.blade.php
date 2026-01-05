@include('layouts.header')
@include('layouts.sidebar')
@include('mediator.connect')
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
.container{margin-left:300px;margin-top:70px;padding:20px;width:70%;font-size:12px; font-family: 'Poppins', sans-serif;}
.step-box{background:#fff;padding:15px;border-radius:10px;margin-bottom:25px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.levels-container{display:flex;flex-wrap:wrap;gap:10px;}
.level-card{flex:1 1 120px;padding:10px;text-align:center;border-radius:8px;background:#f1f5f9;position:relative;}
.level-card h4{margin:5px 0;}
.progress-bar{border-radius:4px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{padding:10px;border-bottom:1px solid #4f46e5;text-align:left;font-size:13px;}
th{background:#f1f1f1;}
.btn{background:#4f46e5;color:#fff;padding:6px 12px;border:none;border-radius:5px;cursor:pointer;margin-top:5px;text-decoration:none;display:inline-block;}
.btn:hover{background:#4338ca;}
#btn_delete{background:yellow;}
#btn_delete:hover{color:green;}
.modal{display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgba(0,0,0,0.6);}
.modal-content{background:#fff;margin:5% auto;padding:20px;border-radius:10px;width:80%;max-width:500px;box-shadow:0 4px 8px rgba(0,0,0,0.3);}
.close{float:right;font-size:22px;font-weight:bold;cursor:pointer;color:#333;}
.close:hover{color:red;}
.highlight{background:#fff4e5;}
input,textarea,select{width:100%;padding:8px;margin:5px 0;border-radius:5px;border:1px solid #ccc;}
.badge{display:inline-block;padding:3px 7px;border-radius:5px;font-size:12px;color:#fff;}
.badge-success{background:#22c55e;}
a.join-btn{background:#4f46e5;color:#fff;padding:5px 10px;border-radius:5px;text-decoration:none;font-size:13px;}
a.join-btn:hover{background:#4338ca;}
</style>

<div class="container">
    <h2 class="step-box">📅 Published Meetings</h2>

    @if($meetings->isEmpty())
        <div class="step-box highlight">No published meetings available.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Link</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meetings as $index => $meeting)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($meeting->time)->format('H:i') }}</td>
                        <td>
                            <a href="{{ $meeting->link }}" target="_blank" class="join-btn">Join Meeting</a>
                        </td>
                        <td>{{ $meeting->description ?? '---' }}</td>
                        <td><span class="badge badge-success">{{ $meeting->status }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($meeting->created_at)->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@include('layouts.footer')