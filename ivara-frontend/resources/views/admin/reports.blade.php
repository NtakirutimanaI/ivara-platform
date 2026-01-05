@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

@php
$companyLogo = $companyLogo ?? asset('images/company_logo.png');
$companyName = $companyName ?? 'IVARA';
@endphp


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard Report</title>
<style>

.reports-container {margin-left:250px; margin-right:20px; margin-top:80px; padding:20px; font-family:Arial,sans-serif;}
.kpi-cards {display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:30px;}
.card {background:#f0f4f8; padding:20px; border-radius:12px; box-shadow:0 4px 8px rgba(0,0,0,0.1); text-align:center; border:1px solid #ddd;}
.card h2 {font-size:22px; margin:0; color:#333;}
.card p {font-size:16px; margin-top:10px; color:#555;}
.section {margin-bottom:40px;}
table {width:100%; border-collapse:collapse; margin-top:15px; background:#fff;}
th,td {border:1px solid #ddd; padding:12px; text-align:left;}
th {background:#924FC2; color:#fff; position:sticky; top:0; z-index:2;}
tr:nth-child(even){background:#f9f9f9;}
.actions button {background:crimson; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;}
.actions button:hover {background:darkred;}
.chart-container {margin-top:30px; background:#fff; padding:20px; border-radius:12px; box-shadow:0 4px 8px rgba(0,0,0,0.1);}
#exportPdfBtn,#exportReportBtn {margin-top:15px; padding:10px 20px; color:white; border:none; border-radius:8px; cursor:pointer;}
#exportPdfBtn {background:#924FC2;}
#exportReportBtn {background:#4CAF50;}
#filterControls {margin-bottom:20px;}
#filterControls select, #filterControls input {padding:6px 12px; margin-right:10px; border-radius:6px; border:1px solid #ccc;}
</style>
</head>
<body>

@php
$deviceCost = 50;
$subscriptionCostRate = 0.3;
$defaultInventoryCost = 20;

$devicesCount = $devices->count();
$devicesCost = $devicesCount * $deviceCost;
$deviceRevenuePerUnit = $totalSales ? ($totalRevenue / $totalSales) : 0;
$deviceRevenue = $deviceRevenuePerUnit * $devicesCount;
$deviceProfit = $deviceRevenue - $devicesCost;

$subscriptionsRevenue = 0;
$subscriptionsCost = 0;
foreach($subscriptions as $sub) {
    $price = $sub->price ?? 0;
    $subscriptionsRevenue += $price;
    $subscriptionsCost += $price * $subscriptionCostRate;
}
$subscriptionProfit = $subscriptionsRevenue - $subscriptionsCost;

$inventoryRevenue = 0;
$inventoryCost = 0;
foreach($inventory as $item) {
    $unitCost = $item->cost ?? $defaultInventoryCost;
    $inventoryCost += $item->quantity * $unitCost;
    $itemPrice = $item->price ?? $unitCost * 1.5;
    $inventoryRevenue += $item->quantity * $itemPrice;
}
$inventoryProfit = $inventoryRevenue - $inventoryCost;

$totalCosts = $devicesCost + $subscriptionsCost + $inventoryCost;
$totalProfits = $deviceProfit + $subscriptionProfit + $inventoryProfit;
$totalLosses = max($totalCosts - $totalRevenue, 0);
@endphp

<div class="reports-container">

    {{-- FILTERS --}}
    <div id="filterControls">
        <label for="intervalFilter">Interval:</label>
        <select id="intervalFilter">
            <option value="all">All</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>

        <label for="searchBox">Search:</label>
        <input type="text" id="searchBox" placeholder="Search...">
    </div>

    {{-- KPI CARDS --}}
    <div class="kpi-cards">
        <div class="card"><h2 id="kpiRevenue">FRW {{ number_format($totalRevenue,2) }}</h2><p>Total Revenue</p></div>
        <div class="card"><h2 id="kpiOrders">{{ $totalOrders }}</h2><p>Total Orders</p></div>
        <div class="card"><h2 id="kpiTasks">{{ $tasksCompleted }}</h2><p>Tasks Completed</p></div>
        <div class="card"><h2 id="kpiActiveSubs">{{ $activeSubscriptions }}</h2><p>Active Subscriptions</p></div>
    </div>

    <div class="kpi-cards">
        <div class="card"><h2 id="kpiProfits">FRW {{ number_format($totalProfits,2) }}</h2><p>Total Profits</p></div>
        <div class="card"><h2 id="kpiLosses">FRW {{ number_format($totalLosses,2) }}</h2><p>Total Losses</p></div>
        <div class="card"><h2 id="kpiUnits">{{ $totalSales }}</h2><p>Units Sold</p></div>
    </div>

    {{-- DEVICES --}}
    <div class="section" data-type="devices">
        <h3>Devices Report</h3>
        <table>
            <thead><tr><th>ID</th><th>Client</th><th>Technician</th><th>Created At</th></tr></thead>
            <tbody>
                @foreach($devices as $device)
                <tr>
                    <td>{{ $device->id }}</td>
                    <td>{{ $device->client->name ?? 'N/A' }}</td>
                    <td>{{ $device->technician->name ?? 'N/A' }}</td>
                    <td>{{ $device->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- EMPLOYEES --}}
    <div class="section" data-type="employees">
        <h3>Employees</h3>
        <table>
            <thead><tr><th>ID</th><th>Name</th><th>Email</th></tr></thead>
            <tbody>
                @foreach($employees as $user)
                <tr><td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->email }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- INVENTORY --}}
    <div class="section" data-type="inventory">
        <h3>Inventory</h3>
        <table>
            <thead><tr><th>ID</th><th>Item</th><th>Quantity</th></tr></thead>
            <tbody>
                @foreach($inventory as $item)
                <tr><td>{{ $item->id }}</td><td>{{ $item->name }}</td><td>{{ $item->quantity }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- SUBSCRIPTIONS --}}
    <div class="section" data-type="subscriptions">
        <h3>Subscriptions</h3>
        <table>
            <thead><tr><th>ID</th><th>User</th><th>Status</th><th>Price</th></tr></thead>
            <tbody>
                @foreach($subscriptions as $sub)
                <tr><td>{{ $sub->id }}</td><td>{{ $sub->user->name ?? 'N/A' }}</td><td>{{ $sub->status }}</td><td>FRW {{ $sub->price ?? 0 }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- CHARTS --}}
    <div class="chart-container">
        <h3>Revenue Overview</h3>
        <div style="margin-bottom:15px;">
            <button id="toggleStacked">Stacked Revenue & Profits</button>
            <button id="togglePie">Revenue Contribution Pie</button>
        </div>
        <canvas id="stackedRevenueChart" style="display:block;"></canvas>
        <canvas id="pieRevenueChart" style="display:none;"></canvas>
        <p id="chartSummary">
            <strong>Devices:</strong> Revenue FRW {{ number_format($deviceRevenue,2) }}, Profit FRW {{ number_format($deviceProfit,2) }}, Cost FRW {{ number_format($devicesCost,2) }}<br>
            <strong>Subscriptions:</strong> Revenue FRW {{ number_format($subscriptionsRevenue,2) }}, Profit FRW {{ number_format($subscriptionProfit,2) }}, Cost FRW {{ number_format($subscriptionsCost,2) }}<br>
            <strong>Inventory:</strong> Revenue FRW {{ number_format($inventoryRevenue,2) }}, Profit FRW {{ number_format($inventoryProfit,2) }}, Cost FRW {{ number_format($inventoryCost,2) }}
        </p>

        <button id="exportReportBtn">Export Report (CSV)</button>
        <button id="exportPdfBtn">Export Report (PDF)</button>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
// Update all chart labels to use FRW instead of $
const stackedCanvas = document.getElementById('stackedRevenueChart').getContext('2d');
const pieCanvas = document.getElementById('pieRevenueChart').getContext('2d');
const chartSummary = document.getElementById('chartSummary');

const stackedChart = new Chart(stackedCanvas, {
    type:'bar',
    data:{
        labels:['Devices','Subscriptions','Inventory'],
        datasets:[
            {label:'Cost (FRW)', data:[{{ $devicesCost }}, {{ $subscriptionsCost }}, {{ $inventoryCost }}], backgroundColor:['#E53935','#8E24AA','#FF5722']},
            {label:'Profit (FRW)', data:[{{ $deviceProfit }}, {{ $subscriptionProfit }}, {{ $inventoryProfit }}], backgroundColor:['#4CAF50','#924FC2','#FFC107']}
        ]
    },
    options:{responsive:true, plugins:{legend:{position:'top'}}, scales:{x:{stacked:true},y:{stacked:true,beginAtZero:true}}}
});

const pieChart = new Chart(pieCanvas, {
    type:'pie',
    data:{
        labels:['Devices','Subscriptions','Inventory'],
        datasets:[{data:[{{ $deviceRevenue }}, {{ $subscriptionsRevenue }}, {{ $inventoryRevenue }}], backgroundColor:['#4CAF50','#924FC2','#FFC107']}]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{position:'top'},
            tooltip:{
                callbacks:{
                    label:function(context){
                        let total = {{ ($deviceRevenue + $subscriptionsRevenue + $inventoryRevenue) ?: 1 }};
                        let value = context.raw;
                        let percent = ((value/total)*100).toFixed(1);
                        return context.label+': FRW '+value.toFixed(2)+' ('+percent+'%)';
                    }
                }
            }
        }
    }
});

// Toggle stacked/pie charts update summary
document.getElementById('toggleStacked').addEventListener('click', function(){
    stackedCanvas.canvas.style.display='block';
    pieCanvas.canvas.style.display='none';
    chartSummary.innerHTML = `<strong>Devices:</strong> Revenue FRW {{ number_format($deviceRevenue,2) }}, Profit FRW {{ number_format($deviceProfit,2) }}, Cost FRW {{ number_format($devicesCost,2) }}<br>
        <strong>Subscriptions:</strong> Revenue FRW {{ number_format($subscriptionsRevenue,2) }}, Profit FRW {{ number_format($subscriptionProfit,2) }}, Cost FRW {{ number_format($subscriptionsCost,2) }}<br>
        <strong>Inventory:</strong> Revenue FRW {{ number_format($inventoryRevenue,2) }}, Profit FRW {{ number_format($inventoryProfit,2) }}, Cost FRW {{ number_format($inventoryCost,2) }}`;
});
document.getElementById('togglePie').addEventListener('click', function(){
    stackedCanvas.canvas.style.display='none';
    pieCanvas.canvas.style.display='block';
    chartSummary.innerHTML=`Revenue Contribution Percentages:<br>
        Devices: {{ number_format(($deviceRevenue/($deviceRevenue+$subscriptionsRevenue+$inventoryRevenue ?:1))*100,1) }}%<br>
        Subscriptions: {{ number_format(($subscriptionsRevenue/($deviceRevenue+$subscriptionsRevenue+$inventoryRevenue ?:1))*100,1) }}%<br>
        Inventory: {{ number_format(($inventoryRevenue/($deviceRevenue+$subscriptionsRevenue+$inventoryRevenue ?:1))*100,1) }}%`;
});

// --- Filters & Search ---
const searchBox = document.getElementById('searchBox');
const intervalFilter = document.getElementById('intervalFilter');
const tables = document.querySelectorAll('table tbody');

function filterTables() {
    const query = searchBox.value.toLowerCase();
    tables.forEach(tbody=>{
        Array.from(tbody.rows).forEach(row=>{
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(query)? '' : 'none';
        });
    });
}

searchBox.addEventListener('input', filterTables);
intervalFilter.addEventListener('change', filterTables);

// --- CSV Export ---
document.getElementById('exportReportBtn').addEventListener('click', function(){
    let csv="data:text/csv;charset=utf-8,";
    csv+="Metric,Value\n";
    csv+="Total Revenue,FRW {{ $totalRevenue }}\nTotal Orders,{{ $totalOrders }}\nTasks Completed,{{ $tasksCompleted }}\nActive Subscriptions,{{ $activeSubscriptions }}\nTotal Profits,FRW {{ $totalProfits }}\nTotal Losses,FRW {{ $totalLosses }}\n\n";
    @foreach($devices as $device)
    csv+="{{ $device->id }},{{ $device->client->name ?? 'N/A' }},{{ $device->technician->name ?? 'N/A' }},{{ $device->created_at->format('Y-m-d') }}\n";
    @endforeach
    @foreach($employees as $user)
    csv+="{{ $user->id }},{{ $user->name }},{{ $user->email }}\n";
    @endforeach
    let encodedUri=encodeURI(csv);
    let link=document.createElement('a');
    link.setAttribute('href',encodedUri);
    link.setAttribute('download','dashboard_report.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

// --- PDF Export ---
document.getElementById('exportPdfBtn').addEventListener('click', async function(){
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p','pt','a4');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = pdf.internal.pageSize.getHeight();
    const pageMargin = 20;
    let currentHeight = pageMargin;

    const cloneContainer = document.querySelector('.reports-container').cloneNode(true);
    cloneContainer.querySelectorAll('#exportPdfBtn,#exportReportBtn').forEach(el=>el.remove());
    document.body.appendChild(cloneContainer);

    const sections = Array.from(cloneContainer.children);
    for(let i=0;i<sections.length;i++){
        const section = sections[i];
        const canvas = await html2canvas(section,{scale:2, backgroundColor:'#ffffff'});
        const imgData = canvas.toDataURL('image/png');
        const imgProps = pdf.getImageProperties(imgData);
        const imgWidth = pdfWidth - 2*pageMargin;
        const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

        if(currentHeight + imgHeight > pdfHeight - pageMargin){
            pdf.addPage();
            currentHeight = pageMargin;
        }

        pdf.addImage(imgData,'PNG',pageMargin,currentHeight,imgWidth,imgHeight);

        const pageNumber = pdf.getCurrentPageInfo().pageNumber;
        pdf.setFontSize(10);
        pdf.text(`Page ${pageNumber}`, pdfWidth - 50, pdfHeight - 10);

        currentHeight += imgHeight + 15;
    }

    document.body.removeChild(cloneContainer);
    pdf.save('dashboard_report.pdf');
});
</script>

</body>
</html>
@include('layouts.footer')

