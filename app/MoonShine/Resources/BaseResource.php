<?php

namespace App\MoonShine\Resources;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Layouts\Casts\LayoutItem;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Enums\PageType;

class BaseResource extends ModelResource
{
    protected ?PageType $redirectAfterSave = PageType::FORM;

    #[AsyncMethod]
    public function removeLayoutImageData(CrudRequestContract $request): void
    {
        $item = $request->getResource()?->getItem();
        $imageIndex = $request->integer('imageIndex');
        $layoutIndex = $request->integer('layoutIndex');
        $jsonField = $request->string('jsonField');
        $jsonIndex = $request->integer('jsonIndex');
        $name = $request->string('name');

        if (is_null($item) || $layoutIndex < 0) {
            return;
        }

        $content = $item->content;
        if (! isset($content[$layoutIndex])) {
            return;
        }

        $values = $content[$layoutIndex] instanceof LayoutItem
            ? $content[$layoutIndex]->getValues()
            : $content[$layoutIndex]['values'];

        if ($jsonField->isNotEmpty()) {
            $this->removeJsonFieldImage($values, (string) $jsonField, $jsonIndex, (string) $name);
        } else {
            $this->removeDirectFieldImage($values, (string) $name, $imageIndex);
        }

        if ($content[$layoutIndex] instanceof LayoutItem) {
            $content[$layoutIndex] = new LayoutItem(
                $content[$layoutIndex]->getName(),
                $content[$layoutIndex]->getKey(),
                $values
            );
        } else {
            $content[$layoutIndex]['values'] = $values;
        }

        $item->content = $content;
        $item->save();
    }

    protected function removeJsonFieldImage(array &$values, string $jsonField, int $jsonIndex, string $name): void
    {
        $jsonItems = data_get($values, $jsonField);

        if (! is_array($jsonItems) || ! isset($jsonItems[$jsonIndex - 1])) {
            return;
        }

        $imagePath = data_get($jsonItems[$jsonIndex - 1], $name);

        if ($imagePath) {
            $this->deleteImageWithConversions($imagePath);
            data_set($jsonItems[$jsonIndex - 1], $name, null);
            data_set($values, $jsonField, $jsonItems);
        }
    }

    protected function removeDirectFieldImage(array &$values, string $name, int $imageIndex): void
    {
        $images = data_get($values, $name);

        if (is_array($images) && isset($images[$imageIndex])) {
            $this->deleteImageWithConversions($images[$imageIndex]);
            Arr::forget($images, $imageIndex);
            data_set($values, $name, array_values($images));
        } elseif (is_string($images)) {
            $this->deleteImageWithConversions($images);
            data_set($values, $name, null);
        }
    }

    protected function deleteImageWithConversions(string $filePath, string $disk = 'public'): void
    {
        if (! Storage::disk($disk)->exists($filePath)) {
            return;
        }
        Storage::disk($disk)->delete($filePath);
        $info = pathinfo($filePath);
        $basePath = $info['dirname'].'/'.$info['filename'];
        foreach (['webp', 'avif'] as $format) {
            $conversionPath = $basePath.'.'.$format;
            if (Storage::disk($disk)->exists($conversionPath)) {
                Storage::disk($disk)->delete($conversionPath);
            }
        }
    }

}
