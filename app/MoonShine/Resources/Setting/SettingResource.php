<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setting;

use App\Models\Setting;
use App\MoonShine\Resources\BaseResource;
use App\MoonShine\Resources\Setting\Pages\SettingFormPage;
use App\MoonShine\Resources\Setting\Pages\SettingIndexPage;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Action;
use MoonShine\Support\Enums\PageType;
use MoonShine\Support\ListOf;

#[Icon('cog-6-tooth')]
#[Group('moonshine::ui.resource.system', 'cog-6-tooth', translatable: true)]
class SettingResource extends BaseResource
{
    protected string $model = Setting::class;

    protected string $column = 'title';


    public function getTitle(): string
    {
        return __('Settings');
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::VIEW);
    }

    protected function pages(): array
    {
        return [
            SettingIndexPage::class,
            SettingFormPage::class,
        ];
    }

    protected function search(): array
    {
        return [
            'id',
            'title',
            'slug',
        ];
    }
}
