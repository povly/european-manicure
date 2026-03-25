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

<section class="what-apart section">
    <div class="container">
        <div class="what-apart__block">

            <div class="what-apart__content">
                @isset($data['title'])
                    <h2 class="what-apart__title section__title">{!! $data['title'] !!}</h2>
                @endisset

                <div class="what-apart__description">
                    @isset($data['logo_image'])
                        <div class="what-apart__logo">
                            <x-image
                                src="{{ $data['logo_image'] }}"
                                lazy="{{$data['is_lazy']}}"
                                width="89"
                                heigth="46"
                            />
                        </div>
                    @endisset

                    @isset($data['description'])
                        <div class="what-apart__description-p">
                            {!! $data['description'] !!}
                        </div>
                    @endisset
                </div>

                @isset($data['items'])
                    <div class="what-apart__items">
                        @foreach($data['items'] as $item)
                            <div class="what-apart__item">

                                @isset($item['title'])
                                    <h3 class="what-apart__item-title">{{ $item['title'] }}</h3>
                                @endisset

                                @isset($item['image'])
                                    <div class="what-apart__item-image img-full">
                                        <x-image
                                            src="{{ $item['image'] }}"
                                            lazy="{{$data['is_lazy'] ?? false}}"
                                        />
                                    </div>
                                @endisset

                                @isset($item['description'])
                                    <div class="what-apart__item-description">
                                        {{ $item['description'] }}
                                    </div>
                                @endisset
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>

            <div class="what-apart__right">

                @isset($data['main_image'])
                    <div class="what-apart__image img-full">
                        <x-image
                            src="{{ $data['main_image'] }}"
                            lazy="{{$data['is_lazy']}}"
                            width="335"
                            heigth="572"
                        />
                    </div>
                @endisset
            </div>
        </div>
    </div>
</section>
