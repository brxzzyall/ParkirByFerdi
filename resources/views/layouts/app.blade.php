@extends('layouts.master')

@section('title', 'Aplikasi Parkir - Inputing')

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
    }
    
    .navbar-gradient {
        background: linear-gradient(90deg, #2d3561 0%, #667eea 100%);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
    }
    
    .card-header-modern {
        border: none;
        padding: 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .card-header-modern h4 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }
    
    .table-modern {
        margin-bottom: 0;
    }
    
    .table-modern thead {
        background: #f8f9fa;
    }
    
    .table-modern thead th {
        border: none;
        border-bottom: 2px solid #e0e0e0;
        font-weight: 600;
        color: #333;
        padding: 12px 16px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table-modern tbody tr {
        border-bottom: 1px solid #e0e0e0;
        transition: background-color 0.2s ease;
    }
    
    .table-modern tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .table-modern tbody td {
        padding: 14px 16px;
        color: #333;
        font-size: 14px;
        vertical-align: middle;
    }
    
    .btn-sm-modern {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-info-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-info-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-warning-modern {
        background: linear-gradient(135deg, #f5af19 0%, #f12711 100%);
        color: white;
    }
    
    .btn-warning-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 175, 25, 0.4);
        color: white;
    }
    
    .btn-secondary-modern {
        background: #e0e0e0;
        color: #333;
    }
    
    .btn-secondary-modern:hover {
        background: #d0d0d0;
        color: #333;
        transform: translateY(-2px);
        text-decoration: none;
    }
    
    .pagination-modern .page-link {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        color: #667eea;
        margin: 0 4px;
    }
    
    .pagination-modern .page-link:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .pagination-modern .page-item.active .page-link {
        background: #667eea;
        border-color: #667eea;
    }
    
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-active {
        background: linear-gradient(135deg, rgba(17, 153, 142, 0.2) 0%, rgba(56, 239, 125, 0.2) 100%);
        color: #0d7a6f;
    }
    
    .status-completed {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
        color: #334499;
    }

    @media (max-width: 768px) {
        .navbar-gradient {
            padding: 10px 0 !important;
        }

        .card-modern {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card-header-modern {
            padding: 16px !important;
            font-size: 16px !important;
        }

        .card-header-modern h4 {
            font-size: 18px !important;
        }

        .table-modern thead th {
            padding: 8px !important;
            font-size: 11px !important;
        }

        .table-modern tbody td {
            padding: 8px !important;
            font-size: 12px !important;
        }

        .btn-sm-modern {
            padding: 4px 8px !important;
            font-size: 11px !important;
        }
    }

    @media (max-width: 480px) {
        .navbar-gradient {
            padding: 8px 0 !important;
        }

        .d-flex {
            flex-direction: column;
            gap: 10px;
        }

        .d-flex.justify-content-between {
            flex-direction: row;
        }

        .card-modern {
            border-radius: 12px;
        }

        .card-header-modern {
            padding: 12px !important;
        }

        .card-header-modern h4 {
            font-size: 16px !important;
        }

        .table-modern {
            font-size: 11px;
        }

        .table-modern thead th {
            padding: 6px !important;
            font-size: 10px !important;
        }

        .table-modern tbody td {
            padding: 6px !important;
            font-size: 11px !important;
        }

        .btn {
            width: 100%;
        }

        .btn-sm-modern {
            padding: 4px 6px !important;
            font-size: 10px !important;
        }

        .pagination-modern {
            flex-wrap: wrap;
            gap: 4px;
        }

        .pagination-modern .page-link {
            padding: 4px 8px;
            font-size: 11px;
            margin: 2px;
        }
    }
</style>
@endsection

@section('navbar')
<!-- Navigation -->
<nav class="navbar-gradient text-white py-3 py-sm-4 sticky-top" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2 gap-sm-3">
                <div style="width: 45px; height: 45px; min-width: 45px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">🅿️</div>
                <a href="/" style="text-decoration: none; color: white;">
                    <h3 style="margin: 0; font-size: 20px; font-weight: 700;">Parkir Manager</h3>
                    <small style="opacity: 0.9; font-size: 11px; display: block;">Sistem Data Parkir</small>
                </a>
            </div>
            <div>
                <a href="/Riwayat" style="color: white; text-decoration: none; padding: 8px 16px; border-radius: 8px; background: rgba(255, 255, 255, 0.15); display: inline-block; transition: all 0.3s ease; font-weight: 600; font-size: 13px;" onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'">
                    Riwayat
                </a>
            </div>
        </div>
    </div>
</nav>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
