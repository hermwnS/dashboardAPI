<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #eef2f7;
            color: #2f3a4a;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            padding: 0 20px 30px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.25s ease;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #34495e;
        }

        .sidebar ul li a.active {
            border-left: 4px solid #1abc9c;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
        }

        .page-title {
            margin-bottom: 20px;
            font-size: 1.7rem;
            letter-spacing: 0.02em;
        }

        .content-card {
            background-color: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
            margin-bottom: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 24px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            color: #4b5563;
            font-size: 0.94rem;
            font-weight: 600;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background-color: #f8fafc;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-size: 0.95rem;
            color: #1f2937;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            background-color: #ffffff;
        }

        .button-row {
            grid-column: span 2;
            display: flex;
            justify-content: flex-end;
        }

        button[type="submit"] {
            padding: 12px 24px;
            border: none;
            border-radius: 999px;
            background-color: #1d4ed8;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        button[type="submit"]:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            min-width: 680px;
        }

        .data-table thead tr {
            background-color: #f1f5f9;
        }

        .data-table th,
        .data-table td {
            padding: 16px 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
            color: #334155;
        }

        .data-table th {
            color: #0f172a;
            font-weight: 700;
        }

        .data-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .data-table td:last-child {
            display: flex;
            gap: 10px;
        }

        .data-table a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .data-table a:hover {
            text-decoration: underline;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .sync-button {
            padding: 10px 20px;
            border: none;
            border-radius: 999px;
            background-color: #10b981;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
            font-size: 0.9rem;
        }

        .sync-button:hover {
            background-color: #059669;
            transform: translateY(-1px);
        }

        .search-form {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            align-items: center;
        }

        .search-container {
            position: relative;
            flex: 1;
        }

        .search-form input[type="text"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background-color: #f8fafc;
            font-size: 0.95rem;
            transition: border-color 0.2s ease;
        }

        .search-form input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #d1d5db;
            border-top: none;
            border-radius: 0 0 12px 12px;
            max-height: 400px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .search-results.active {
            display: block;
        }

        .search-result-item {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .search-result-item:hover {
            background-color: #f1f5f9;
        }

        .search-result-item strong {
            color: #1f2937;
            display: block;
        }

        .search-result-item small {
            color: #6b7280;
            font-size: 0.85rem;
        }

        .no-results {
            padding: 20px;
            text-align: center;
            color: #9ca3af;
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .button-row {
                justify-content: stretch;
            }

            .button-row button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/manajemen_data">Manajemen Data</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Manajemen Data</h1>
            <button class="sync-button">Sync Data</button>
        </div>

        <section class="content-card">
            <form action="/manajemen_data/store" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama" />
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat" />
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input type="text" id="usia" name="usia" placeholder="Masukkan usia" />
                    </div>
                    <div class="button-row">
                        <button type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </section>

        <section class="content-card">
            <form method="GET" action="/manajemen_data" class="search-form">
                <div class="search-container">
                    <input type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama atau alamat..." value="{{ $search ?? '' }}" autocomplete="off">
                    <div class="search-results" id="searchResults"></div>
                </div>
            </form>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_orang as $orang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $orang->nama }}</td>
                        <td>{{ $orang->alamat }}</td>
                        <td>{{ $orang->jenis_kelamin }}</td>
                        <td>{{ $orang->usia }}</td>
                        <td>
                            <a href="/manajemen_data/edit/{{ $orang->id }}">Edit</a>
                            <a href="/manajemen_data/delete/{{ $orang->id }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        // Live search functionality
        searchInput.addEventListener('input', async function() {
            const keyword = this.value.trim();

            if (keyword.length < 1) {
                searchResults.classList.remove('active');
                return;
            }

            try {
                const response = await fetch(`/manajemen_data/search-ajax?q=${encodeURIComponent(keyword)}`);
                const data = await response.json();

                if (data.length > 0) {
                    let html = '';
                    data.forEach((item) => {
                        html += `
                            <div class="search-result-item" onclick="selectResult('${item.nama}')">
                                <strong>${item.nama}</strong>
                                <small>${item.alamat}</small>
                            </div>
                        `;
                    });
                    searchResults.innerHTML = html;
                    searchResults.classList.add('active');
                } else {
                    searchResults.innerHTML = '<div class="no-results">Tidak ada hasil ditemukan</div>';
                    searchResults.classList.add('active');
                }
            } catch (error) {
                console.error('Error fetching search results:', error);
            }
        });

        // Select result
        function selectResult(nama) {
            searchInput.value = nama;
            searchResults.classList.remove('active');
        }

        // Close search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.search-container')) {
                searchResults.classList.remove('active');
            }
        });
    </script>
</body>
</html>