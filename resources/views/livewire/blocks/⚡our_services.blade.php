<?php

use Livewire\Livewire;
use Livewire\Component;

new class extends Component {
    public array $data = [];

    public function mount(array $data): void
    {
        $this->data = $data;
    }

    public function isLazy(): bool
    {
        if (Livewire::isLivewireRequest()) {
            return false;
        }

        return (bool) ($this->data['is_lazy'] ?? false);
    }
};
?>

<section class="our-services section">
    <div class="container">
        <div class="our-services__header">
            @isset($data['title'])
                <h2 class="our-services__title section__title">{{ $data['title'] }}</h2>
            @endisset

            @isset($data['description'])
                <div class="our-services__description">
                    {!! $data['description'] !!}
                </div>
            @endisset
        </div>

        @isset($data['items'])
            <div class="our-services__items">
                @foreach($data['items'] as $item)
                    <div class="our-services__item">
                        @isset($item['image'])
                            <div class="our-services__item-image img-full">
                                <x-image
                                    src="{{ $item['image'] }}"
                                    lazy="{{ $this->isLazy() }}"
                                />
                            </div>
                        @endisset

                        <div class="our-services__item-content">
                            @isset($item['title'])
                                <h3 class="our-services__item-title">{{ $item['title'] }}</h3>
                            @endisset

                            @if(isset($item['button_text']) && isset($item['button_link']))
                                <a href="{{ $item['button_link'] }}" class="our-services__item-button btn">
                                    {{ $item['button_text'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
</section>
