<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Panel - Course Management</title>
    <style>
        :root {
            --primary-color: #924FC2;
            --sidebar-width: 240px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            color: #333;
        }

        .layout {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .nav-link {
            margin-bottom: 15px;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            transition: background 0.2s;
        }

        .nav-link a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-link.active {
            background: white;
        }

        .nav-link.active a {
            color: var(--primary-color);
            font-weight: bold;
        }

        .main {
            flex: 1;
            background-color: #f9fafb;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .topbar h1 {
            font-size: 18px;
        }

        .content {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #111827;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .layout {
                flex-direction: column;
            }

            .topbar {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Manager Panel</h2>
            <div class="nav-link active"><a href="#">📚 Courses</a></div>
            <div class="nav-link"><a href="#">📖 Lessons</a></div>
            <div class="nav-link"><a href="#">🧑‍🎓 Enrollments</a></div>
            <div class="nav-link"><a href="#">✅ Completions</a></div>
            <div class="nav-link"><a href="#">📊 Progress</a></div>
        </aside>

        <!-- Main Content -->
        <main class="main">
            <div class="topbar">
                <h1>Welcome, Manager</h1>
            </div>
            <div class="content" id="mainContent">
                <!-- Default content -->
                <div class="card">
                    <h3>📚 Course Management</h3>
                    <p>Here you can create, update, and delete courses.</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
