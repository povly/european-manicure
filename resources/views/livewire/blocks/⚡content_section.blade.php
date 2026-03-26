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

<section class="content-section section">
    <div class="container">

        <div class="content-section__block">

            @isset($data['image_desktop'])
                <div class="content-section__image img-full content-section__image--pc">
                    <x-image
                        src="{{ $data['image_desktop'] }}"
                        width="335"
                        height="573"
                        lazy="{{ $this->isLazy() }}"
                    />
                </div>
            @endisset

            <div class="content-section__inner">

                <div class="content-section__inner-left">
                    <div class="content-section__top">
                        @isset($data['title'])
                            <h2 class="content-section__title section__title">{{ $data['title'] }}</h2>
                        @endisset
                        <div class="content-section__icon content-section__icon--mb">
                            <x-image src="/images/about/about-flow.png" width="54" height="42" from="public"
                                     lazy="{{ $this->isLazy() }}"/>
                        </div>
                    </div>

                    @isset($data['description'])
                        <div class="content-section__description content-section__description--md">
                            {!! $data['description'] !!}
                        </div>
                    @endisset

                    @if(isset($data['text_1']) || isset($data['text_2']))
                        <div class="content-section__texts">
                            @isset($data['text_1'])
                                <div class="content-section__text">
                                    {{ $data['text_1'] }}
                                </div>
                            @endisset

                            @isset($data['text_2'])
                                <div class="content-section__text">
                                    {{ $data['text_2'] }}
                                </div>
                            @endisset
                        </div>
                    @endif
                </div>

                <div class="content-section__inner-right">
                    @isset($data['description_mb_1'])
                        <div class="content-section__description content-section__description--mb_1">
                            {!! $data['description_mb_1'] !!}
                        </div>
                    @endisset

                    @isset($data['image_mobile'])
                        <div class="content-section__image img-full content-section__image--mobile">
                            <x-image
                                src="{{ $data['image_mobile'] }}"
                                width="329"
                                height="310"
                                lazy="{{ $this->isLazy() }}"
                            />
                        </div>
                    @endisset

                    @isset($data['description_mb_2'])
                        <div class="content-section__description content-section__description--mb_2">
                            {!! $data['description_mb_2'] !!}
                        </div>
                    @endisset

                    @isset($data['items'])
                        <div class="content-section__items">
                            @foreach($data['items'] as $item)
                                <div class="content-section__item">
                                    @isset($item['title'])
                                        <h3 class="content-section__item-title">{{ $item['title'] }}</h3>
                                    @endisset

                                    @isset($item['image'])
                                        <div class="content-section__item-image img-full">
                                            <x-image
                                                src="{{ $item['image'] }}"
                                                lazy="{{ $this->isLazy() }}"
                                                width="100"
                                                heigth="115"
                                            />
                                        </div>
                                    @endisset
                                </div>
                            @endforeach
                        </div>
                    @endisset

                        <div class="content-section__icon content-section__icon--pc">
                            <x-image src="/images/about/about-flow.png" width="72" height="56" from="public"
                                     lazy="{{ $this->isLazy() }}"/>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
