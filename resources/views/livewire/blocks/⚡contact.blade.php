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

<section class="contact section">
    <div class="container">
        <div class="contact__grid">
            <div class="contact__left">
                @isset($data['image'])
                    <div class="contact__image img-full">
                        <x-image
                            src="{{ $data['image'] }}"
                            lazy="{{$data['is_lazy'] ?? false}}"
                        />
                    </div>
                @endisset

                @isset($data['title'])
                    <h2 class="contact__title section__title">{{ $data['title'] }}</h2>
                @endisset

                @isset($data['description'])
                    <div class="contact__description">
                        {!! $data['description'] !!}
                    </div>
                @endisset

                @isset($data['contact_info_title'])
                    <h3 class="contact__info-title">{{ $data['contact_info_title'] }}</h3>
                @endisset

                @isset($data['contact_info'])
                    <div class="contact__info-list">
                        @foreach($data['contact_info'] as $item)
                            <div class="contact__info-item">
                                @isset($item['icon'])
                                    <div class="contact__info-icon img-full">
                                        <x-image
                                            src="{{ $item['icon'] }}"
                                            lazy="{{$data['is_lazy'] ?? false}}"
                                        />
                                    </div>
                                @endisset
                                @isset($item['text'])
                                    <span class="contact__info-text">{{ $item['text'] }}</span>
                                @endisset
                            </div>
                        @endforeach
                    </div>
                @endisset

                @isset($data['socials_title'])
                    <h3 class="contact__socials-title">{{ $data['socials_title'] }}</h3>
                @endisset

                @isset($data['socials'])
                    <div class="contact__socials-list">
                        @foreach($data['socials'] as $social)
                            <a href="{{ $social['link'] ?? '#' }}" class="contact__socials-item" target="_blank" rel="noopener noreferrer">
                                @isset($social['icon'])
                                    <div class="contact__socials-icon img-full">
                                        <x-image
                                            src="{{ $social['icon'] }}"
                                            lazy="{{$data['is_lazy'] ?? false}}"
                                        />
                                    </div>
                                @endisset
                            </a>
                        @endforeach
                    </div>
                @endisset
            </div>

            <div class="contact__right">
                @isset($data['form_title'])
                    <h3 class="contact__form-title">{{ $data['form_title'] }}</h3>
                @endisset

                @isset($data['form_inputs'])
                    <form class="contact__form" action="#" method="POST">
                        @csrf
                        @foreach($data['form_inputs'] as $input)
                            <div class="contact__form-field">
                                @isset($input['label'])
                                    <label class="contact__form-label">{{ $input['label'] }}</label>
                                @endisset
                                <input 
                                    type="{{ $input['type'] ?? 'text' }}" 
                                    name="contact_{{ $loop->index }}"
                                    class="contact__form-input"
                                    placeholder="{{ $input['label'] ?? '' }}"
                                >
                            </div>
                        @endforeach

                        @isset($data['button_text'])
                            <button type="submit" class="contact__form-button btn">
                                {{ $data['button_text'] }}
                            </button>
                        @endisset
                    </form>
                @endisset
            </div>
        </div>
    </div>
</section>
