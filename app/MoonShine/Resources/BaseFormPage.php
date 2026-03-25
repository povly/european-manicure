<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

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
class BaseFormPage extends FormPage
{
    public function getRemovableLayoutImageAttributes(string $name, ?string $jsonField = null): array
    {
        return [
            'data-async-url' => $this->getRouter()->getEndpoints()->method(
                'removeLayoutImageData',
                params: ['resourceItem' => $this->getResource()->getItemID()]
            ),
            'data-json-field' => $jsonField,
            '@click.prevent' => $jsonField
                ? "removeLayoutJsonImage(\$event, '{$name}', '{$jsonField}')"
                : "removeLayoutImage(\$event, '{$name}')",
        ];
    }
}
