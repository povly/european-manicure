<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setting\Pages;

use App\MoonShine\Resources\BaseFormPage;
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Layouts\Fields\Layouts;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use YuriZoom\MoonShineMediaManager\Fields\MediaManagerPicker;

/**
 * @extends FormPage<SettingResource>
 */
final class SettingFormPage extends BaseFormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

                Text::make(__('Title'), 'title')
                    ->required(),

                Text::make(__('Slug'), 'slug')
                    ->required()
                    ->hint('header, footer, etc.'),

                Layouts::make(__('Content'), 'content')
                    ->searchable()
                    ->addLayout(
                        __('Header'),
                        'header',
                        [
                            Json::make(__('Links'), 'links')
                                ->fields([
                                    Text::make(__('Text'), 'text')->required(),
                                    Text::make(__('URL'), 'url')->required(),
                                ])
                                ->removable()
                                ->creatable(),

                            MediaManagerPicker::make(__('Logo'), 'logo')
                                ->allowedTypes(['image']),

                            Json::make(__('Info'), 'info')
                                ->fields([
                                    MediaManagerPicker::make(__('Icon'), 'icon')
                                        ->allowedTypes(['image']),
                                    Text::make(__('Text'), 'text'),
                                ]),

                            Json::make(__('Socials'), 'socials')
                                ->fields([
                                    Text::make(__('Name'), 'name'),
                                    Text::make(__('URL'), 'url'),
                                    MediaManagerPicker::make(__('Icon'), 'icon')
                                        ->allowedTypes(['image']),
                                ])
                                ->removable()
                                ->creatable(),

                            Text::make(__('Button Text'), 'button_text'),
                        ]
                    )
                    ->addLayout(
                        __('Footer'),
                        'footer',
                        [
                            MediaManagerPicker::make(__('Logo'), 'logo')
                                ->allowedTypes(['image']),

                            Text::make(__('Name'), 'name'),

                            Text::make(__('Copyright'), 'copyright'),

                            Json::make(__('Links'), 'links')
                                ->fields([
                                    Text::make(__('Text'), 'text')->required(),
                                    Text::make(__('URL'), 'url')->required(),
                                ])
                                ->removable()
                                ->creatable(),
                        ]
                    ),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => 'required',
            'slug' => ['required', 'unique:settings,slug,'.$item->getKey()],
        ];
    }
}
