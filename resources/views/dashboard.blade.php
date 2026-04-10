<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            padding: 0 20px 30px;
            text-align: center;
            border-bottom: 1px solid #34495e;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            padding: 0;
        }

        .sidebar ul li a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .sidebar ul li a.active {
            background-color: #3498db;
            border-left: 4px solid #2980b9;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/manajemen_data">Manajemen Data</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div style="display: flex; gap: 20px;">
            <div style="width: 400px;">
                <h3>Jenis Kelamin</h3>
                <canvas id="genderChart"></canvas>
            </div>
            <div style="width: 400px;">
                <h3>Usia</h3>
                <canvas id="ageChart"></canvas>
            </div>
        </div>
    </div>
    
</body>
</html>