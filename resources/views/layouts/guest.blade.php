<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Rekam Medis') }}</title>

        <!-- Modern CDN Resources -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                min-height: 100vh;
                background: #f8fafc;
                background-image: 
                    radial-gradient(at 100% 0%, rgba(59, 130, 246, 0.05) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, rgba(99, 102, 241, 0.05) 0px, transparent 50%);
                background-attachment: fixed;
            }

            .login-card {
                background: rgba(255, 255, 255, 1);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                border: 1px solid rgba(226, 232, 240, 1);
                width: 320px;
            }

            .input-field {
                background: #fff;
                border: 1px solid #e2e8f0;
                transition: all 0.2s ease;
            }

            .input-field:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 1px rgba(59, 130, 246, 0.1);
            }
        </style>
    </head>
    <body>
        <div class="min-h-screen flex flex-col justify-center items-center p-4">
            <div class="login-card p-6 rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
