<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #F0F9FA; padding: 24px; color: #1e293b; }
        .card { background: #ffffff; border: 1px solid #CCE7E9; border-radius: 12px; padding: 28px; max-width: 560px; margin: 0 auto; }
        .label { font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.05em; color: #0E7490; margin-bottom: 4px; }
        .value { font-size: 15px; margin-bottom: 18px; color: #0F172A; }
        .pesan-box { background: #ecfbfc; border: 1px solid #CCE7E9; border-radius: 8px; padding: 14px; font-size: 14px; line-height: 1.6; white-space: pre-line; }
        h2 { color: #155E75; margin-top: 0; }
    </style>
</head>
<body>
    <div class="card">
        <h2>📩 Pesan Kontak Baru — RelaXin</h2>

        <div class="label">Nama</div>
        <div class="value">{{ $data['nama'] }}</div>

        <div class="label">Email</div>
        <div class="value">{{ $data['email'] }}</div>

        <div class="label">Subjek</div>
        <div class="value">{{ $data['subjek'] }}</div>

        <div class="label">Pesan</div>
        <div class="pesan-box">{{ $data['pesan'] }}</div>
    </div>
</body>
</html>