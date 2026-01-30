<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>@yield('title', 'Aplikasi Parkir')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            body {
                font-size: 14px;
            }

            .container-lg {
                padding: 15px !important;
            }

            h1 {
                font-size: 24px !important;
            }

            h2 {
                font-size: 20px !important;
            }

            h3 {
                font-size: 18px !important;
            }

            h4 {
                font-size: 16px !important;
            }

            .btn {
                padding: 10px 16px !important;
                font-size: 14px !important;
            }

            .table {
                font-size: 12px;
            }

            .card {
                margin-bottom: 15px;
            }

            .navbar-brand {
                font-size: 18px !important;
            }

            footer {
                padding: 15px !important;
                font-size: 12px !important;
            }
        }

        @media (max-width: 480px) {
            body {
                font-size: 13px;
            }

            .container-lg {
                padding: 10px !important;
            }

            h1 {
                font-size: 20px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            h4 {
                font-size: 14px !important;
            }

            .btn {
                padding: 8px 12px !important;
                font-size: 12px !important;
                width: 100% !important;
                margin-bottom: 8px !important;
            }

            .table {
                font-size: 11px;
            }

            .card-body {
                padding: 12px !important;
            }

            .navbar {
                padding: 10px 0 !important;
            }

            footer {
                padding: 12px !important;
                font-size: 11px !important;
                margin-top: 30px !important;
            }

            .table-modern tbody td {
                padding: 8px !important;
            }

            .navbar-brand {
                font-size: 16px !important;
            }

            .navbar-nav {
                gap: 0.5rem !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    @yield('navbar')

    <!-- Main Content -->
    <div class="container-lg py-4 py-sm-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer style="background: rgba(0, 0, 0, 0.1); color: white; text-align: center; padding: 20px; margin-top: 40px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <p style="margin: 0; font-size: 14px; word-break: break-word;">
            Aplikasi Parkir &copy; 2026 | Created by <a href="https://instagram.com/brxzzyall" target="_blank" style="color: white; text-decoration: none; font-weight: 600; transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'"><strong>Ferdiansyah Wurtami</strong></a>
        </p>
    </footer>

    @yield('scripts')
</body>
</html>
