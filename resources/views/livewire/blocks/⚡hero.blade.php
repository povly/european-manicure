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

        return (bool) ($this->data['is_lazy'] ?? true);
    }
};
?>

<section class="hero">
    <div class="container">

        <h1 class="hero__title">{{ $data['title'] ?? '' }}</h1>

        <div class="hero__inner">
            @isset($data['image'])
                <div class="hero__image-wrapper">
                    <div class="hero__image-el">
                        <x-image
                            src="{{ $data['image'] }}"
                            class="hero__image"
                            width="359"
                            height="372"
                            lazy="{{ $this->isLazy() }}"
                        />
                    </div>
                    <div class="hero__image-bg img-full">
                        <x-image
                            src="/images/first/bg.png"
                            from="public"
                            width="329"
                            height="262"
                            lazy="{{ $this->isLazy() }}"
                        />
                    </div>
                    @if(isset($data['text_left']) || isset($data['text_right']))
                        @isset($data['text_left'])
                            <span class="hero__decor hero__decor--left">
                                {!! $data['text_left'] !!}
                            </span>
                        @endisset
                        @isset($data['text_right'])
                            <span class="hero__decor hero__decor--right">
                                {!! $data['text_right'] !!}
                            </span>
                        @endisset
                    @endif
                </div>
            @endisset

            @isset($data['description_mb'])
                <p class="hero__subtitle hero__subtitle--mb">{{ $data['description_mb'] }}</p>
            @endisset

            @isset($data['description'])
                <p class="hero__subtitle hero__subtitle--pc">{{ $data['description'] }}</p>
            @endisset

            @isset($data['button_text'])
                <a href="{{ $data['button_link'] ?? '#' }}" class="btn hero__btn">
                    <span>{{ $data['button_text'] }}</span>
                </a>
            @endisset
        </div>
    </div>
</section>
