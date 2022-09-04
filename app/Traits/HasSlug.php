<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {

    }

    public static function initializeHasSlug()
    {
        static::saving(function ($model) {
            $field = $model->name ? 'name' : 'title';
            if ($model->parent_id) {
                $model->slug = self::generateSlugFromParent($model);
            } else if ($model->slug) {
                $model->slug = self::generateSlugFromSlug($model->slug, $model);
            } else {
                $model->slug = self::generateSlug($model->name ?? $model->title, $field);
            }
        });
    }

    public static function generateSlugFromParent($model = null): string
    {
        if ($model) {
            $parentElement = static::where('id', '=', $model->parent_id)->first();
            $field = $model->name ? 'name' : 'title';
            if (!empty($parentElement)) {
                $parentElementName = $parentElement->name ?? $parentElement->title;
                $newElementName = $model->name ?? $model->title;
                $name = Str::slug($parentElementName) . '-' . Str::slug($newElementName);
                if ($model->slug) {
                    return self::generateSlugFromSlug($name, $model);
                }
                return self::generateSlug($name, $field);
            }
        }
    }

    public static function generateSlug($value, $field): string
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $count = static::where($field, $value)->count();
            return $slug . '-' . $count;
        }

        return $slug;
    }

    public static function generateSlugFromSlug($slug, $model = null)
    {
        $count = 0;
        $originalSlug = $slug;
        while (static::whereSlug($slug)->where('id', '!=', $model->id)->exists()) {
            $count++;
            $slug = $originalSlug . '-' . $count;
        }
        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
