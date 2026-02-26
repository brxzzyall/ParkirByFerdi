@extends('layouts.master')

@section('title', 'Nota Pembayaran Parkir')

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        min-height: 100vh;
        padding: 20px 0;
        position: relative;
        overflow: hidden;
    }

    body::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(17, 153, 142, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        top: -200px;
        right: -150px;
        animation: float 10s ease-in-out infinite;
    }

    body::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(56, 239, 125, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -150px;
        left: -150px;
        animation: float 12s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(30px); }
    }

    @media print {
        body {
            background: white !important;
            padding: 0 !important;
        }
        
        body::before, body::after {
            display: none;
        }
        
        body * {
            visibility: hidden;
        }

        div[style*="max-width: 420px"],
        div[style*="max-width: 420px"] * {
            visibility: visible;
        }

        button {
            display: none;
        }
    }

    @media (max-width: 768px) {
        body {
            padding: 15px 0;
        }

        .container {
            padding: 0 15px !important;
        }

        .card {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 10px 0;
        }

        .container {
            padding: 0 10px !important;
        }

        h1, h2, h3, h4 {
            font-size: 16px !important;
        }

        .btn {
            width: 100%;
            font-size: 12px !important;
            padding: 8px 12px !important;
        }

        .card {
            border-radius: 12px;
        }

        .card-body {
            padding: 15px !important;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
