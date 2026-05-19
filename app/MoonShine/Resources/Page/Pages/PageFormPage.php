<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Page\Pages;

use App\MoonShine\Resources\BaseFormPage;
use App\MoonShine\Resources\Page\PageResource;
use MoonShine\CKEditor\Fields\CKEditor;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Layouts\Fields\Layouts;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use YuriZoom\MoonShineMediaManager\Fields\MediaManagerPicker;

/**
 * @extends FormPage<PageResource>
 */
final class PageFormPage extends BaseFormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

                Text::make(__('Title'), 'title')
                    ->required(),

                Slug::make(__('Slug'), 'slug')
                    ->separator('-')
                    ->unique()
                    ->nullable(),

                Layouts::make(__('Content'), 'content')
                    ->searchable()
                    ->addLayout(
                        __('Hero Section'),
                        'hero',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Textarea::make(__('Description (PC)'), 'description'),
                            Textarea::make(__('Description (Mobile)'), 'description_mb'),
                            Text::make(__('Text Left'), 'text_left'),
                            Text::make(__('Text Right'), 'text_right'),
                            Text::make(__('Button Text'), 'button_text'),
                            Text::make(__('Button Link'), 'button_link'),
                            MediaManagerPicker::make(__('Image'), 'image')
                                ->allowedTypes(['image']),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('About Studio'),
                        'content_section',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            MediaManagerPicker::make(__('Image (Mobile)'), 'image_mobile')
                                ->allowedTypes(['image']),
                            MediaManagerPicker::make(__('Image (Desktop)'), 'image_desktop')
                                ->allowedTypes(['image']),
                            CKEditor::make(__('Description (PC)'), 'description'),
                            CKEditor::make(__('Description 1 (Mobile)'), 'description_mb_1'),
                            CKEditor::make(__('Description 2 (Mobile)'), 'description_mb_2'),
                            Text::make(__('Text 1'), 'text_1'),
                            Text::make(__('Text 2'), 'text_2'),
                            Json::make(__('Items'), 'items')
                                ->fields([
                                    Text::make(__('Title'), 'title'),
                                    MediaManagerPicker::make(__('Image'), 'image')
                                        ->allowedTypes(['image']),
                                ])
                                ->removable(),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('Our Services'),
                        'our_services',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Text::make(__('Description'), 'description'),
                            Json::make(__('Services'), 'items')
                                ->fields([
                                    Text::make(__('Title'), 'title')
                                        ->required(),
                                    MediaManagerPicker::make(__('Image'), 'image')
                                        ->allowedTypes(['image']),
                                    Text::make(__('Button Text'), 'button_text'),
                                    Text::make(__('Button Link'), 'button_link'),
                                ])
                                ->removable(),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('What Sets Us Apart'),
                        'what_apart',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            CKEditor::make(__('Description'), 'description'),
                            MediaManagerPicker::make(__('Logo Image'), 'logo_image')
                                ->allowedTypes(['image']),
                            MediaManagerPicker::make(__('Main Image'), 'main_image')
                                ->allowedTypes(['image']),
                            Json::make(__('Items'), 'items')
                                ->fields([
                                    Text::make(__('Title'), 'title')
                                        ->required(),
                                    MediaManagerPicker::make(__('Image'), 'image')
                                        ->allowedTypes(['image']),
                                    Textarea::make(__('Description'), 'description'),
                                ])
                                ->removable(),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('Nail Artists'),
                        'nail_artists',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Json::make(__('Artists'), 'items')
                                ->fields([
                                    MediaManagerPicker::make(__('Image'), 'image')
                                        ->allowedTypes(['image']),
                                    Text::make(__('Name'), 'name')
                                        ->required(),
                                    Text::make(__('Specialist'), 'specialist'),
                                    Text::make(__('Button Text'), 'button_text'),
                                    Text::make(__('Button Link'), 'button_link'),
                                ])
                                ->removable(),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('Reviews'),
                        'reviews',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Json::make(__('Images'), 'images')
                                ->fields([
                                    MediaManagerPicker::make(__('Image'), 'image')
                                        ->allowedTypes(['image']),
                                ])
                                ->removable(),
                            Text::make(__('Trusted Clients Number'), 'trusted_clients_number'),
                            Text::make(__('Trusted Clients Text'), 'trusted_clients_text'),
                            Json::make(__('Reviews'), 'reviews')
                                ->fields([
                                    MediaManagerPicker::make(__('Image'), 'image')
                                        ->allowedTypes(['image']),
                                    MediaManagerPicker::make(__('Platform Icon'), 'platform_icon')
                                        ->allowedTypes(['image']),
                                    Text::make(__('Platform Text'), 'platform_text'),
                                    Textarea::make(__('Description'), 'description'),
                                    Text::make(__('Name'), 'name'),
                                    Text::make(__('Client Type'), 'client_type'),
                                ])
                                ->removable(),
                            Text::make(__('Subtitle'), 'subtitle'),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('FAQ'),
                        'faq',
                        [
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Text::make(__('Subtitle'), 'subtitle'),
                            Json::make(__('Questions'), 'questions')
                                ->fields([
                                    Text::make(__('Title'), 'title')
                                        ->required(),
                                    Textarea::make(__('Description'), 'description'),
                                ])
                                ->removable(),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    )
                    ->addLayout(
                        __('Gallery'),
                        'gallery',
                        [
                            Text::make(__('Text 1'), 'text_1'),
                            Text::make(__('Text 2'), 'text_2'),
                            Text::make(__('Text 3'), 'text_3'),
                            Text::make(__('Text 4'), 'text_4'),
                            MediaManagerPicker::make(__('Images'), 'images')
                                ->multiple()
                                ->allowedTypes(['image']),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ]
                    )
                    ->addLayout(
                        __('Contact'),
                        'contact',
                        [
                            MediaManagerPicker::make(__('Image'), 'image')
                                ->allowedTypes(['image']),
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Textarea::make(__('Description'), 'description'),
                            Text::make(__('Contact Info Title'), 'contact_info_title'),
                            Json::make(__('Contact Info'), 'contact_info')
                                ->fields([
                                    MediaManagerPicker::make(__('Icon'), 'icon')
                                        ->allowedTypes(['image']),
                                    Text::make(__('Text'), 'text'),
                                    CKEditor::make(__('Text'), 'text'),
                                ])
                                ->removable(),
                            Text::make(__('Socials Title'), 'socials_title'),
                            Json::make(__('Socials'), 'socials')
                                ->fields([
                                    MediaManagerPicker::make(__('Icon'), 'icon')
                                        ->allowedTypes(['image']),
                                    Text::make(__('Link'), 'link'),
                                ])
                                ->removable(),
                            Text::make(__('Form Title'), 'form_title'),
                            Text::make(__('Button Text'), 'button_text'),
                            Text::make(__('Success Message'), 'success_message'),
                            Checkbox::make('Lazy load', 'is_lazy'),
                        ],
                        validation: [
                            'title' => 'required',
                        ]
                    ),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => 'required',
            'slug' => ['nullable', 'unique:pages,slug,'.$item->getKey()],
        ];
    }
}
