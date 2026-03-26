<?php

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

new class extends Component {
    public array $data = [];
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';
    public bool $success = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function mount(array $data): void
    {
        $this->data = $data;
    }

    public function send(): void
    {
        $this->validate();

        Mail::to(config('mail.from.address'))
            ->send(new ContactMail([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'message' => $this->message,
            ]));

        $this->reset(['name', 'email', 'phone', 'message']);
        $this->success = true;
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

                @if($success)
                    <div class="contact__success" x-data x-show="true" x-init="setTimeout(() => $el.classList.add('show'), 100)">
                        {{ __('Your message has been sent successfully!') }}
                    </div>
                @endif

                <form class="contact__form" wire:submit="send">
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
                                        wire:model="{{ $inputName }}"
                                        id="contact_{{ $inputName }}"
                                        class="contact__form-input contact__form-textarea @error($inputName) is-invalid @enderror"
                                        placeholder="{{ $input['label'] ?? '' }}"
                                        rows="4"
                                    ></textarea>
                                @else
                                    <input 
                                        type="{{ $inputType }}" 
                                        wire:model="{{ $inputName }}"
                                        id="contact_{{ $inputName }}"
                                        class="contact__form-input @error($inputName) is-invalid @enderror"
                                        placeholder="{{ $input['label'] ?? '' }}"
                                    >
                                @endif
                                @error($inputName)
                                    <span class="contact__form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    @endisset

                    @isset($data['button_text'])
                        <button type="submit" class="contact__form-button btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>{{ $data['button_text'] }}</span>
                            <span wire:loading>{{ __('Sending...') }}</span>
                        </button>
                    @endisset
                </form>
            </div>
        </div>
    </div>
</section>
