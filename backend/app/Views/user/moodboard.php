<?php
// File: app/Views/user/moodboard.php
// Minimal Moodboard view using Tailwind (CDN) — keep presentation-only, no business logic.
// Usage: pass $boards = [ ['title'=>'', 'image'=>'', 'tags'=>[], 'desc'=>''] , ... ]

$sample = [
    ['title' => 'Summer Vibes', 'image' => 'https://picsum.photos/600/400?random=1', 'tags' => ['warm','outdoor'], 'desc' => 'Bright colors and warm textures.'],
    ['title' => 'Minimal Mono', 'image' => 'https://picsum.photos/600/400?random=2', 'tags' => ['minimal','mono'], 'desc' => 'Clean lines and monochrome palette.'],
    ['title' => 'Cozy Corner', 'image' => 'https://picsum.photos/600/400?random=3', 'tags' => ['cozy','interior'], 'desc' => 'Soft materials and warm lighting.'],
];

if (!isset($boards) || !is_array($boards) || count($boards) === 0) {
    $boards = $sample;
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Moodboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
  <main class="max-w-7xl mx-auto p-6">
    <header class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold">Moodboard</h1>
      <div class="flex items-center space-x-3">
        <input id="search" type="search" placeholder="Search..." class="px-3 py-2 border rounded-md text-sm" />
        <a href="#" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">New Board</a>
      </div>
    </header>

    <section aria-label="moodboard-grid">
      <div id="grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <?php foreach ($boards as $i => $b): ?>
          <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition" tabindex="0">
            <button
              data-index="<?= $i ?>"
              class="w-full h-44 bg-cover bg-center relative focus:outline-none preview-btn"
              style="background-image: url('<?= h($b['image'] ?? '') ?>')"
              aria-label="Preview <?= h($b['title'] ?? 'board') ?>"
            >
              <span class="absolute inset-0 bg-black bg-opacity-25"></span>
              <div class="absolute bottom-0 left-0 right-0 p-3">
                <h2 class="text-white text-sm font-medium"><?= h($b['title'] ?? 'Untitled') ?></h2>
                <?php if (!empty($b['tags']) && is_array($b['tags'])): ?>
                  <div class="mt-1 flex flex-wrap gap-2">
                    <?php foreach ($b['tags'] as $t): ?>
                      <span class="text-xs bg-white bg-opacity-80 text-gray-800 px-2 py-1 rounded"><?= h($t) ?></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </button>
            <div class="p-3 text-sm text-gray-600">
              <p class="truncate"><?= h($b['desc'] ?? '') ?></p>
              <div class="mt-3 flex items-center justify-between">
                <div class="text-xs text-gray-500"><?= date('M j, Y') ?></div>
                <div class="flex items-center space-x-2">
                  <a href="#" class="text-indigo-600 text-xs">Edit</a>
                  <a href="#" class="text-red-500 text-xs">Delete</a>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <!-- Modal Preview (minimal, accessible) -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50" role="dialog" aria-modal="true">
    <div class="bg-white rounded-lg overflow-hidden max-w-3xl w-full mx-4">
      <div class="flex justify-between items-start p-3 border-b">
        <h3 id="modal-title" class="text-lg font-medium"></h3>
        <button id="modal-close" aria-label="Close" class="text-gray-600 hover:text-gray-800">&times;</button>
      </div>
      <div class="p-4">
        <img id="modal-image" src="" alt="" class="w-full h-auto rounded mb-3" />
        <p id="modal-desc" class="text-sm text-gray-700"></p>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const boards = <?= json_encode($boards, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>;
      const modal = document.getElementById('modal');
      const modalImage = document.getElementById('modal-image');
      const modalTitle = document.getElementById('modal-title');
      const modalDesc = document.getElementById('modal-desc');
      const closeBtn = document.getElementById('modal-close');

      document.querySelectorAll('.preview-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const i = Number(btn.getAttribute('data-index'));
          const b = boards[i];
          modalImage.src = b.image || '';
          modalImage.alt = b.title || 'Preview image';
          modalTitle.textContent = b.title || 'Untitled';
          modalDesc.textContent = b.desc || '';
          modal.classList.remove('hidden');
          modal.focus();
        });
      });

      closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
      modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });
      document.addEventListener('keydown', (e) => { if (e.key === 'Escape') modal.classList.add('hidden'); });
    })();
  </script>
</body>
</html>