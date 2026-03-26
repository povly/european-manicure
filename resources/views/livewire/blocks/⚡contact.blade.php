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

                @if(session('success'))
                    <div class="contact__success">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="contact__form" action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    @if($errors->any())
                        <div class="contact__errors">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @isset($data['form_inputs'])
                        @foreach($data['form_inputs'] as $index => $input)
                            @php
                                $inputType = $input['type'] ?? 'text';
                                $inputName = match($inputType) {
                                    'email' => 'email',
                                    'tel' => 'phone',
                                    default => $index === 0 ? 'name' : 'message'
                                };
                            @endphp
                            <div class="contact__form-field">
                                @isset($input['label'])
                                    <label class="contact__form-label" for="contact_{{ $inputName }}">{{ $input['label'] }}</label>
                                @endisset
                                @if($inputType === 'text' && $index > 1)
                                    <textarea 
                                        name="{{ $inputName }}"
                                        id="contact_{{ $inputName }}"
                                        class="contact__form-input contact__form-textarea"
                                        placeholder="{{ $input['label'] ?? '' }}"
                                        rows="4"
                                    >{{ old($inputName) }}</textarea>
                                @else
                                    <input 
                                        type="{{ $inputType }}" 
                                        name="{{ $inputName }}"
                                        id="contact_{{ $inputName }}"
                                        class="contact__form-input"
                                        placeholder="{{ $input['label'] ?? '' }}"
                                        value="{{ old($inputName) }}"
                                    >
                                @endif
                            </div>
                        @endforeach
                    @endisset

                    @isset($data['button_text'])
                        <button type="submit" class="contact__form-button btn">
                            {{ $data['button_text'] }}
                        </button>
                    @endisset
                </form>
            </div>
        </div>
    </div>
</section>
