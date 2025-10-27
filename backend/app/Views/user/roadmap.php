<?php
/**
 * app/Views/user/roadmap.php
 *
 * Basic Product Roadmap view (CodeIgniter 4 view).
 *
 * Expected data:
 *  - $milestones: array of [
 *      'title' => string,
 *      'due' => string (YYYY-MM-DD or human),
 *      'status' => 'todo'|'in-progress'|'done',
 *      'description' => string (optional)
 *    ]
 *
 * This view is intentionally simple (presentation-only). Keep business logic in Controllers/Services.
 */

// Fallback sample data if none provided (useful for quick previews)
if (!isset($milestones) || !is_array($milestones) || empty($milestones)) {
    $milestones = [
        [
            'title' => 'User registration & login',
            'due' => '2025-11-01',
            'status' => 'done',
            'description' => 'Implement authentication, validation and sessions.'
        ],
        [
            'title' => 'Profile management',
            'due' => '2025-12-10',
            'status' => 'in-progress',
            'description' => 'Editable profiles, avatars, and basic preferences.'
        ],
        [
            'title' => 'Roadmap public page',
            'due' => '2026-01-15',
            'status' => 'todo',
            'description' => 'Public-facing roadmap with milestones and progress.'
        ],
    ];
}

// Helper: map status to color classes
$statusClasses = [
    'todo' => 'bg-gray-200 text-gray-800',
    'in-progress' => 'bg-yellow-100 text-yellow-800',
    'done' => 'bg-green-100 text-green-800',
];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Roadmap</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!-- Tailwind via CDNJS (project uses Tailwind via CDN as per SOP) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
  <div class="max-w-4xl mx-auto p-6">
    <header class="mb-6">
      <h1 class="text-2xl font-semibold">Product Roadmap</h1>
      <p class="text-sm text-gray-600">High-level milestones and progress overview.</p>
    </header>

    <section class="bg-white shadow rounded-lg p-4">
      <div class="flex items-center justify-between mb-4">
        <div class="text-sm text-gray-700">Milestones (<?= count($milestones) ?>)</div>
        <div class="text-xs text-gray-500">Last updated: <?= date('Y-m-d') ?></div>
      </div>

      <ol class="relative border-l border-gray-200">
        <?php foreach ($milestones as $idx => $m): 
            $title = htmlspecialchars($m['title'] ?? 'Untitled');
            $due = htmlspecialchars($m['due'] ?? '');
            $desc = htmlspecialchars($m['description'] ?? '');
            $status = $m['status'] ?? 'todo';
            $badgeClass = $statusClasses[$status] ?? $statusClasses['todo'];
        ?>
          <li class="mb-8 ml-6">
            <span class="absolute -left-3 flex items-center justify-center w-6 h-6 rounded-full ring-8 ring-white <?= $badgeClass ?>">
              <?php if ($status === 'done'): ?>
                ✓
              <?php elseif ($status === 'in-progress'): ?>
                …
              <?php else: ?>
                •
              <?php endif; ?>
            </span>
            <div class="flex items-start justify-between">
              <div>
                <h3 class="text-lg font-medium"><?= $title ?></h3>
                <?php if ($desc): ?>
                  <p class="text-sm text-gray-600 mt-1"><?= $desc ?></p>
                <?php endif; ?>
              </div>
              <time class="text-xs text-gray-500"><?= $due ?></time>
            </div>
            <div class="mt-3">
              <div class="h-2 w-full bg-gray-100 rounded">
                <?php
                  // Simple visual progress: done => 100, in-progress => 50, todo => 0
                  $percent = $status === 'done' ? 100 : ($status === 'in-progress' ? 50 : 0);
                ?>
                <div class="h-2 rounded <?=
                  $status === 'done' ? 'bg-green-500' : ($status === 'in-progress' ? 'bg-yellow-400' : 'bg-gray-300')
                ?>" style="width: <?= $percent ?>%"></div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ol>

      <?php if (empty($milestones)): ?>
        <div class="text-center text-sm text-gray-500 py-6">No milestones defined yet.</div>
      <?php endif; ?>
    </section>
  </div>
</body>
</html>