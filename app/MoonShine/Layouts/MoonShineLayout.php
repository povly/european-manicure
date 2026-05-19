<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\ColorManager\ColorManager;
use MoonShine\ColorManager\Palettes\GrayPalette;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\FlexibleRender;
use Povly\MoonShineImageEditor\Support\ImageEditorRenderer;
use YuriZoom\MoonShineMediaManager\Components\MediaManagerOffCanvas;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = GrayPalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),

            Css::make('/vendor/image-editor/image-editor.css'),
            Js::make('/vendor/image-editor/filerobot-image-editor.min.js'),
            Js::make('/vendor/image-editor/image-editor.js'),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),

            MenuItem::make(PageResource::class, __('Pages')),
            MenuItem::make(SettingResource::class, __('Settings')),
        ];
    }

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    protected function getContentComponents(): array
    {
        return [
            ...parent::getContentComponents(),
            MediaManagerOffCanvas::make(),

            FlexibleRender::make(
                app(ImageEditorRenderer::class)->renderModal(),
            ),
        ];
    }
}
