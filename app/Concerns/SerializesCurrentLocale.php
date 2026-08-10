<?php

namespace App\Concerns;

/**
 * spatie/laravel-translatable resolves the current-locale value transparently
 * for normal property access ($model->name), but array/JSON serialization
 * (Model::toArray(), used by Inertia to send props to the frontend) bypasses
 * that accessor and returns the raw {"en": ..., "bn": ...} translations map
 * instead. This trait re-resolves each translatable attribute to a plain
 * current-locale value when the model is serialized.
 */
trait SerializesCurrentLocale
{
    /**
     * @return array<string, mixed>
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        foreach ($this->getTranslatableAttributes() as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = $this->getTranslation($key, $this->getLocale(), $this->useFallbackLocale());
            }
        }

        return $attributes;
    }
}
