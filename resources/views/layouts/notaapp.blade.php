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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }

    @media print {
        body {
            background: white !important;
            padding: 0 !important;
        }
        
        body * {
            visibility: hidden;
        }

        div[style*="max-width: 400px"],
        div[style*="max-width: 400px"] * {
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