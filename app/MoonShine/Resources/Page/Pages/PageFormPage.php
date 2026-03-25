<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Page\Pages;

use App\MoonShine\Resources\Page\PageResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Layouts\Fields\Layouts;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Povly\MoonshineInterventionImage\Fields\InterventionImage;

/**
 * @extends FormPage<PageResource>
 */
final class PageFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make(array(
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
                        array(
                            Text::make(__('Title'), 'title')
                                ->required(),
                            Textarea::make(__('Description (PC)'), 'description'),
                            Textarea::make(__('Description (Mobile)'), 'description_mb'),
                            Text::make(__('Text Left'), 'text_left'),
                            Text::make(__('Text Right'), 'text_right'),
                            Text::make(__('Button Text'), 'button_text'),
                            Text::make(__('Button Link'), 'button_link'),
                            InterventionImage::make(__('Image'), 'image')
                                ->disk('public')
                                ->dir('pages')
                                ->removable(attributes: $this->getRemovableLayoutImageAttributes('image')),
                            Checkbox::make('Lazy load', 'is_lazy')
                        ),
                        validation: array(
                            'title' => 'required',
                        )
                    ),
            )),
        ];
    }

    public function getRemovableImageAttributes(string $name): array
    {
        return [
            'data-async-url' => $this->getResource()
                ? $this->getRouter()->getEndpoints()->method(
                    'removeImageData',
                    params: ['resourceItem' => $this->getResource()->getItemID()]
                )
                : null,
            '@click.prevent' => "removeImage(\$event, '{$name}')",
        ];
    }
    public function getRemovableLayoutImageAttributes(string $name): array
    {
        return [
            'data-async-url' => $this->getResource()
                ? $this->getRouter()->getEndpoints()->method(
                    'removeLayoutImageData',
                    params: ['resourceItem' => $this->getResource()->getItemID()]
                )
                : null,
            '@click.prevent' => "removeLayoutImage(\$event, '{$name}')",
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
