<h1>Dashboard Works!</h1>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Panel de Administración'; ?> - Barbería Elite Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#111827",
                        secondary: "#d97706",
                        accent: "#1f2937",
                        success: "#10b981",
                        danger: "#ef4444",
                        info: "#3b82f6"
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        serif: ['"DM Serif Display"', 'serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=DM+Serif+Display&display=swap');

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar.collapsed .expand-icon {
            transform: rotate(180deg);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tab-button.active {
            border-bottom: 2px solid #d97706;
            color: #d97706;
        }

        .report-content {
            display: none;
        }

        .report-content.active {
            display: block;
        }

        .tab-button {
            padding: 0.5rem 1rem;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .tab-button:hover {
            color: #d97706;
            border-bottom-color: #d97706;
        }

        .tab-button.active {
            color: #d97706;
            border-bottom-color: #d97706;
            background-color: rgba(217, 119, 6, 0.1);
        }

        /* DataTables customization */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3em 0.8em;
            margin-left: 2px;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #d97706;
            color: white !important;
            border: 1px solid #d97706;
        }

        /* Chart animations */
        .chart-container {
            position: relative;
            transition: all 0.3s ease;
        }

        .chart-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Report cards */
        .report-card {
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<div class="p-4 border-t border-gray-700">
    <div class="flex items-center">
        <?php
        $baseURL = "https://via.assets.so/game.jpg?";
        $randomNumber = rand(0, 100000);
        $randomURL = $baseURL . $randomNumber . 'w=200&h=200';
        ?>
        <img src=<?php echo $randomURL ?> alt="Admin profile" class="w-40 h-40 rounded-full">
        <div class="ml-3 sidebar-text">
            <p class="text-white font-medium"><?php echo $admin['nombre'] ?? 'Admin'; ?></p>
            <p class="text-gray-400 text-sm">Administrador</p>
        </div>
        <a href="auth.php?action=logout" class="ml-auto text-gray-400 hover:text-white sidebar-text"
            title="Cerrar sesión">salir
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</div>
</div>