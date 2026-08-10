<?php

namespace App\Support;

class TranslatableInput
{
    /**
     * Given validated form data shaped like ['name' => ['en' => 'X', 'bn' => ''], ...],
     * drop any locale whose value is blank so it correctly falls back to the
     * base locale instead of spatie treating an empty string as "translated".
     *
     * @param  array<string, mixed>  $data
     * @param  array<int, string>  $translatableKeys
     * @return array<string, mixed>
     */
    public static function pruneEmptyLocales(array $data, array $translatableKeys): array
    {
        foreach ($translatableKeys as $key) {
            if (! isset($data[$key]) || ! is_array($data[$key])) {
                continue;
            }

            foreach ($data[$key] as $locale => $value) {
                if (self::isEmpty($value)) {
                    unset($data[$key][$locale]);
                }
            }
        }

        return $data;
    }

    private static function isEmpty(mixed $value): bool
    {
        if (is_string($value)) {
            return trim($value) === '';
        }

        if (is_array($value)) {
            return collect($value)->every(fn (mixed $v) => self::isEmpty($v));
        }

        return $value === null;
    }
}
