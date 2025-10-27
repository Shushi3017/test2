<?php
// app/Views/user/landingpage.php
// Simple landing page view (CodeIgniter 4) using Tailwind CDN.
// Usage: return view('user/landingpage', ['title' => 'My App']);
$title = isset($title) ? $title : 'Welcome';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>

    <!-- Tailwind via CDN (for quick prototypes). Replace with compiled CSS in production. -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Small helper to constrain layout when embedding in app shells */
        .max-w-app { max-width: 1100px; margin-left: auto; margin-right: auto; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <header class="bg-white shadow-sm">
        <div class="max-w-app px-6 py-4 flex items-center justify-between">
            <a href="<?= base_url('/') ?>" class="flex items-center gap-3">
                <svg class="w-10 h-10 text-indigo-600" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <rect width="48" height="48" rx="8" fill="#6366F1"/>
                    <path d="M14 24h20" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M14 30h20" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
                <span class="font-semibold text-lg"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></span>
            </a>

            <nav class="hidden md:flex items-center gap-4 text-sm">
                <a href="<?= base_url('/features') ?>" class="text-slate-600 hover:text-slate-900">Features</a>
                <a href="<?= base_url('/pricing') ?>" class="text-slate-600 hover:text-slate-900">Pricing</a>
                <a href="<?= base_url('/docs') ?>" class="text-slate-600 hover:text-slate-900">Docs</a>
                <a href="<?= base_url('/login') ?>" class="px-4 py-2 rounded-md border border-slate-200 hover:bg-slate-50">Sign in</a>
            </nav>
        </div>
    </header>

    <main class="max-w-app px-6 py-16">
        <section class="grid gap-8 md:grid-cols-2 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tight text-slate-900">
                    Simple, fast, and reliable.
                </h1>
                <p class="mt-4 text-lg text-slate-600 max-w-prose">
                    A lightweight starter landing page for your CodeIgniter 4 project. Built with Tailwind for quick customization.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="<?= base_url('/register') ?>" class="inline-flex items-center justify-center px-5 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                        Get started
                    </a>
                    <a href="<?= base_url('/docs') ?>" class="inline-flex items-center justify-center px-5 py-3 border border-slate-200 rounded-md text-slate-700 hover:bg-slate-50">
                        Read docs
                    </a>
                </div>

                <ul class="mt-6 flex flex-wrap gap-4 text-sm text-slate-500">
                    <li>✅ Clean layout</li>
                    <li>✅ Accessible</li>
                    <li>✅ Tailwind-ready</li>
                </ul>
            </div>

            <div>
                <div class="rounded-xl bg-gradient-to-br from-indigo-50 to-white p-6 shadow-md">
                    <img alt="Mockup" src="https://via.placeholder.com/800x480?text=App+Preview" class="w-full rounded-md border border-slate-100" />
                    <p class="mt-3 text-sm text-slate-500">Quick product preview — replace with real screenshots or hero illustrations.</p>
                </div>
            </div>
        </section>

        <section class="mt-14">
            <h2 class="text-2xl font-semibold text-slate-900">Features</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="p-5 bg-white border rounded-lg shadow-sm">
                    <h3 class="font-medium text-slate-800">Modular Views</h3>
                    <p class="mt-2 text-sm text-slate-500">Keep controllers thin and components reusable.</p>
                </div>

                <div class="p-5 bg-white border rounded-lg shadow-sm">
                    <h3 class="font-medium text-slate-800">Service Layer</h3>
                    <p class="mt-2 text-sm text-slate-500">Business logic lives in services, not controllers.</p>
                </div>

                <div class="p-5 bg-white border rounded-lg shadow-sm">
                    <h3 class="font-medium text-slate-800">CI4 Friendly</h3>
                    <p class="mt-2 text-sm text-slate-500">Designed to slot into a CodeIgniter 4 project layout.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t bg-white">
        <div class="max-w-app px-6 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-slate-600">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>. All rights reserved.</p>
            <div class="flex gap-4 mt-3 md:mt-0">
                <a href="<?= base_url('/privacy') ?>" class="hover:underline">Privacy</a>
                <a href="<?= base_url('/terms') ?>" class="hover:underline">Terms</a>
            </div>
        </div>
    </footer>
</body>
</html>