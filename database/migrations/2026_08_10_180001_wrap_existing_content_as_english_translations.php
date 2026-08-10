<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * @var array<string, array<int, string>>
     */
    private array $textColumns = [
        'product_categories' => ['name', 'description'],
        'products' => ['name', 'short_description', 'long_description'],
        'quality_processes' => ['title', 'description'],
        'global_markets' => ['country', 'description'],
        'pages' => ['title'],
        'company_stats' => ['label', 'value'],
        'responsibility_items' => ['title', 'description'],
        'seo_metas' => ['title', 'meta_description', 'og_title', 'og_description'],
    ];

    /**
     * @var array<string, array<int, string>>
     */
    private array $jsonColumns = [
        'products' => ['specifications', 'applications'],
        'pages' => ['sections'],
    ];

    public function up(): void
    {
        foreach ($this->textColumns as $table => $columns) {
            $this->wrapTextColumns($table, $columns);
        }

        foreach ($this->jsonColumns as $table => $columns) {
            $this->wrapJsonColumns($table, $columns);
        }
    }

    public function down(): void
    {
        foreach ($this->textColumns as $table => $columns) {
            $this->unwrapColumns($table, $columns);
        }

        foreach ($this->jsonColumns as $table => $columns) {
            $this->unwrapColumns($table, $columns);
        }
    }

    /**
     * @param  array<int, string>  $columns
     */
    private function wrapTextColumns(string $table, array $columns): void
    {
        foreach (DB::table($table)->get() as $row) {
            $updates = [];

            foreach ($columns as $column) {
                $value = $row->{$column} ?? null;

                if ($value === null || $this->isAlreadyWrapped($value)) {
                    continue;
                }

                $updates[$column] = json_encode(['en' => $value], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }

            if ($updates !== []) {
                DB::table($table)->where('id', $row->id)->update($updates);
            }
        }
    }

    /**
     * @param  array<int, string>  $columns
     */
    private function wrapJsonColumns(string $table, array $columns): void
    {
        foreach (DB::table($table)->get() as $row) {
            $updates = [];

            foreach ($columns as $column) {
                $raw = $row->{$column} ?? null;

                if ($raw === null || $this->isAlreadyWrapped($raw)) {
                    continue;
                }

                $decoded = json_decode((string) $raw, true);
                $updates[$column] = json_encode(['en' => $decoded], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }

            if ($updates !== []) {
                DB::table($table)->where('id', $row->id)->update($updates);
            }
        }
    }

    /**
     * @param  array<int, string>  $columns
     */
    private function unwrapColumns(string $table, array $columns): void
    {
        foreach (DB::table($table)->get() as $row) {
            $updates = [];

            foreach ($columns as $column) {
                $raw = $row->{$column} ?? null;

                if ($raw === null || ! $this->isAlreadyWrapped($raw)) {
                    continue;
                }

                $decoded = json_decode((string) $raw, true);
                $english = $decoded['en'] ?? null;
                $updates[$column] = is_array($english) ? json_encode($english, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $english;
            }

            if ($updates !== []) {
                DB::table($table)->where('id', $row->id)->update($updates);
            }
        }
    }

    /**
     * A value already looks like a spatie translation blob if it decodes to
     * an object/array whose keys are all short locale codes (e.g. "en").
     */
    private function isAlreadyWrapped(mixed $value): bool
    {
        if (! is_string($value) || $value === '') {
            return false;
        }

        $decoded = json_decode($value, true);

        if (! is_array($decoded) || $decoded === [] || array_is_list($decoded)) {
            return false;
        }

        foreach (array_keys($decoded) as $key) {
            if (! is_string($key) || strlen($key) > 5) {
                return false;
            }
        }

        return true;
    }
};
