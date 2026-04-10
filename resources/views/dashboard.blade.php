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
        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div style="width: 400px;">
                <h3>Jenis Kelamin</h3>
                <canvas id="genderChart"></canvas>
            </div>
            <div style="width: 400px;">
                <h3>Usia</h3>
                <canvas id="ageChart"></canvas>
            </div>
            <div style="width: 820px; margin-top: 20px;">
                <h3>Agregasi Per Tanggal</h3>
                <canvas id="dailyChart"></canvas>
            </div>
        </div>
    </div>
    
    <script>
        async function loadDashboardData() {
            try {
                const response = await fetch('/api/dashboard/data');
                const data = await response.json();
                
                // Gender Pie Chart
                const genderCtx = document.getElementById('genderChart').getContext('2d');
                new Chart(genderCtx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(data.gender),
                        datasets: [{
                            data: Object.values(data.gender),
                            backgroundColor: ['#3498db', '#e74c3c'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }
                });
                
                // Age Pie Chart
                const ageCtx = document.getElementById('ageChart').getContext('2d');
                new Chart(ageCtx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(data.age),
                        datasets: [{
                            data: Object.values(data.age),
                            backgroundColor: [
                                '#1abc9c', '#2ecc71', '#3498db', '#9b59b6'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }
                });

                // Daily Column Chart
                const dailyCtx = document.getElementById('dailyChart').getContext('2d');
                new Chart(dailyCtx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data.daily),
                        datasets: [{
                            label: 'Jumlah Data',
                            data: Object.values(data.daily),
                            backgroundColor: '#3b82f6',
                            borderColor: '#2563eb',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah'
                                },
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error loading dashboard data:', error);
            }
        }
        
        // Load data when page loads
        window.addEventListener('load', loadDashboardData);
    </script>
</body>
</html>