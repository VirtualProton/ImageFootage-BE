<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$db = DB::connection();

// Get ALL migration files from 2023 and 2024 to skip old migrations
$patterns = [
    __DIR__ . '/database/migrations/2023_*.php',
    __DIR__ . '/database/migrations/2024_*.php',
];

$allMigrations = [];
foreach ($patterns as $pattern) {
    $allMigrations = array_merge($allMigrations, glob($pattern));
}

$marked = 0;
$skipped = 0;

foreach ($allMigrations as $file) {
    $migrationName = str_replace('.php', '', basename($file));
    
    // Check if already in migrations table
    $exists = $db->table('migrations')->where('migration', $migrationName)->exists();
    
    if (!$exists) {
        $db->table('migrations')->insert([
            'migration' => $migrationName,
            'batch' => 1
        ]);
        echo "✓ Marked as migrated: $migrationName\n";
        $marked++;
    } else {
        $skipped++;
    }
}

echo "\n========================================\n";
echo "Summary:\n";
echo "  Marked: $marked migrations\n";
echo "  Already migrated: $skipped migrations\n";
echo "========================================\n";
echo "\nDone! Now run: php artisan migrate\n";