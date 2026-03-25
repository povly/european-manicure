@php
    $headerData = [];
    if ($headerSetting ?? null) {
        foreach ($headerSetting as $block) {
            if ($block->getName() === 'header') {
                $headerData = $block->getValues();
                break;
            }
        }
    }
@endphp

@if(!empty($headerData))
    <livewire:blocks.header :data="$headerData" />
@endif
