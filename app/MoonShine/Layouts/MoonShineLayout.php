<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\AssetManager\InlineJs;
use MoonShine\ColorManager\ColorManager;
use MoonShine\ColorManager\Palettes\GrayPalette;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuItem;

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
            InlineJs::make(<<<'JS'
                window.removeImage = function(event, name) {
                    let button = event.currentTarget;
                    let imageIndex = button.closest('.dropzone-item')?.dataset.id;
                    if (imageIndex === undefined) {
                        return;
                    }
                    fetch(`${button.dataset.asyncUrl}&imageIndex=${imageIndex}&name=${name}`)
                        .then(() => button.closest('.x-removeable')?.remove());
                };
                window.removeLayoutImage = function(event, name) {
                    let button = event.currentTarget;
                    let accordion = button.closest('.accordion');
                    let layoutIndex = parseInt(accordion.querySelector('[data-r-index]')?.dataset.rIndex ?? 0);
                    let imageIndex = button.closest('.dropzone-item')?.dataset.id ?? 0;
                    
                    fetch(`${button.dataset.asyncUrl}&imageIndex=${imageIndex}&layoutIndex=${layoutIndex}&name=${name}`)
                        .then(() => button.closest('.x-removeable')?.remove());
                };
                window.removeLayoutJsonImage = function(event, name, jsonField) {
                    let button = event.currentTarget;
                    let accordion = button.closest('.accordion');
                    let layoutIndex = parseInt(accordion.querySelector('[data-r-index]')?.dataset.rIndex ?? 0);
                    
                    let jsonRow = button.closest('tr');
                    let jsonIndex = parseInt(jsonRow?.querySelector('[data-r-index]')?.dataset.rIndex ?? 0);
                    if (jsonIndex === 0 && jsonRow) {
                        let hiddenInput = jsonRow.querySelector('input[name*="[' + jsonField + ']"][name*="[hidden_"]');
                        if (hiddenInput) {
                            let match = hiddenInput.name.match(new RegExp('\\[' + jsonField + '\\]\\[(\\d+)\\]'));
                            if (match) {
                                jsonIndex = parseInt(match[1]);
                            }
                        }
                    }
                    
                    let imageIndex = button.closest('.dropzone-item')?.dataset.id ?? 0;
                    
                    fetch(`${button.dataset.asyncUrl}&imageIndex=${imageIndex}&layoutIndex=${layoutIndex}&jsonField=${jsonField}&jsonIndex=${jsonIndex}&name=${name}`)
                        .then(() => button.closest('.x-removeable')?.remove());
                };
            JS),
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
}
