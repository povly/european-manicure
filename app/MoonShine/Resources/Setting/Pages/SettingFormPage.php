<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setting\Pages;

use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Layouts\Fields\Layouts;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use Povly\MoonshineInterventionImage\Fields\InterventionImage;

/**
 * @extends FormPage<SettingResource>
 */
final class SettingFormPage extends FormPage
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

                            InterventionImage::make(__('Logo'), 'logo')
                                ->disk('public')
                                ->dir('settings')
                                ->removable(attributes: $this->getResource()->getRemovableLayoutImageAttributes('logo')),

                            Json::make(__('Info'), 'info')
                                ->fields([
                                    InterventionImage::make(__('Icon'), 'icon')
                                        ->disk('public')
                                        ->dir('settings')
                                        ->removable(attributes: $this->getResource()->getRemovableLayoutImageAttributes('icon', 'info')),
                                    Text::make(__('Text'), 'text'),
                                ]),

                            Json::make(__('Socials'), 'socials')
                                ->fields([
                                    Text::make(__('Name'), 'name'),
                                    Text::make(__('URL'), 'url'),
                                    InterventionImage::make(__('Icon'), 'icon')
                                        ->disk('public')
                                        ->dir('settings')
                                        ->removable(attributes: $this->getResource()->getRemovableLayoutImageAttributes('icon', 'socials')),
                                ])
                                ->removable()
                                ->creatable(),

                            Text::make(__('Button Text'), 'button_text'),
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
