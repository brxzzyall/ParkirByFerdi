<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Server Error</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
        }
        .error-code {
            font-size: 120px;
            font-weight: 900;
            color: #ef4444;
            margin: 0;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        .error-title {
            font-size: 32px;
            font-weight: 700;
            margin: 20px 0;
            color: #f8fafc;
        }
        .error-message {
            font-size: 18px;
            margin: 20px 0;
            color: #94a3b8;
        }
        .error-details {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            text-align: left;
            font-family: monospace;
            font-size: 14px;
            color: #64748b;
            overflow-x: auto;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">500</h1>
        <h2 class="error-title">Internal Server Error</h2>
        <p class="error-message">Maaf, terjadi kesalahan internal pada server. Silakan coba lagi nanti.</p>

        @if(config('app.debug'))
            <div class="error-details">
                <strong>Exception:</strong> {{ get_class($exception) }}<br>
                <strong>Message:</strong> {{ $exception->getMessage() }}<br>
                <strong>File:</strong> {{ $exception->getFile() }}:{{ $exception->getLine() }}<br>
                <strong>Status:</strong> {{ $status }}
            </div>
        @endif

        <a href="{{ url('/') }}" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>