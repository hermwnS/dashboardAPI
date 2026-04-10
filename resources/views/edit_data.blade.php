<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
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
            margin-bottom: 18px;
            font-size: 1.7rem;
            letter-spacing: 0.02em;
        }

        .content-card {
            background-color: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
            max-width: 760px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
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

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background-color: #f8fafc;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-size: 0.95rem;
            color: #1f2937;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            background-color: #ffffff;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 6px;
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

        @media (max-width: 640px) {
            .main-content {
                padding: 16px;
            }

            .content-card {
                padding: 18px;
            }
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
        <section class="content-card">
            <h1 class="page-title">Edit Data</h1>
            <form action="/manajemen_data/update/{{ $data_orang->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ $data_orang->nama }}" placeholder="Masukkan nama" />
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="{{ $data_orang->alamat }}" placeholder="Masukkan alamat" />
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" id="jenis_kelamin" name="jenis_kelamin" value="{{ $data_orang->jenis_kelamin }}" placeholder="Masukkan jenis kelamin" />
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input type="text" id="usia" name="usia" value="{{ $data_orang->usia }}" placeholder="Masukkan usia" />
                    </div>
                    <div class="button-row">
                        <button type="submit">Update</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
    
</body>
</html>