<?php

namespace App\Models\Concerns;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Translatable
{
    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function translated(string $field, ?string $locale = null): mixed
    {
        $locale ??= app()->getLocale();

        if ($locale === 'id') {
            return $this->getAttribute($field);
        }

        $translation = $this->translations
            ->first(fn (Translation $translation): bool => $translation->locale === $locale && $translation->field === $field);

        return $translation?->value ?? $this->getAttribute($field);
    }

    public function saveTranslation(string $field, ?string $value, string $locale = 'en'): void
    {
        if (blank($value)) {
            $this->translations()
                ->where('locale', $locale)
                ->where('field', $field)
                ->delete();

            return;
        }

        $this->translations()->updateOrCreate(
            ['locale' => $locale, 'field' => $field],
            ['value' => $value],
        );
    }
}
