<?php

use Livewire\Component;

new class extends Component {
    public array $data = [];

    public function mount(array $data): void
    {
        $this->data = $data;
    }
};
?>

<section class="content-section">
    <div class="container">
        @isset($data['title'])
            <h2 class="content-section__title">{{ $data['title'] }}</h2>
        @endisset

        <div class="content-section__images">
            @isset($data['image_mobile'])
                <div class="content-section__image content-section__image--mobile">
                    <x-image
                        src="{{ $data['image_mobile'] }}"
                        class="content-section__img"
                        lazy="true"
                    />
                </div>
            @endisset

            @isset($data['image_desktop'])
                <div class="content-section__image content-section__image--desktop">
                    <x-image
                        src="{{ $data['image_desktop'] }}"
                        class="content-section__img"
                        lazy="true"
                    />
                </div>
            @endisset
        </div>

        @isset($data['description'])
            <div class="content-section__description">
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

        @isset($data['items'])
            <div class="content-section__items">
                @foreach($data['items'] as $item)
                    <div class="content-section__item">
                        @isset($item['image'])
                            <div class="content-section__item-image">
                                <x-image
                                    src="{{ $item['image'] }}"
                                    class="content-section__item-img"
                                    lazy="true"
                                />
                            </div>
                        @endisset

                        @isset($item['title'])
                            <h3 class="content-section__item-title">{{ $item['title'] }}</h3>
                        @endisset
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
</section>
