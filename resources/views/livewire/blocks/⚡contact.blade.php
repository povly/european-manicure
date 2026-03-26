<?php

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

new class extends Component {
    public array $data = [];
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public bool $success = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/^[\d\s\+\-\(\)]+$/'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => __('Please enter your full name'),
            'name.max' => __('Name is too long'),
            'phone.required' => __('Please enter your phone number'),
            'phone.regex' => __('Please enter a valid phone number'),
            'email.required' => __('Please enter your email address'),
            'email.email' => __('Please enter a valid email address'),
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
            ]));

        $this->reset(['name', 'phone', 'email']);
        $this->success = true;
    }
};
?>

<section class="contact section">
    <div class="container">

        @isset($data['title'])
            <h2 class="contact__title contact__title--md section__title">{{ $data['title'] }}</h2>
        @endisset

        @isset($data['description'])
            <div class="contact__description contact__description--md">
                {!! $data['description'] !!}
            </div>
        @endisset

        <div class="contact__grid">
            <div class="contact__left">
                @isset($data['image'])
                    <div class="contact__image contact__image--md img-full">
                        <x-image
                            src="{{ $data['image'] }}"
                            lazy="{{$data['is_lazy'] ?? false}}"
                            width="329"
                            heigth="617"
                        />
                    </div>
                @endisset
            </div>

            <div class="contact__right">

                <div class="contact__right-top">
                    @isset($data['title'])
                        <h2 class="contact__title contact__title--pc section__title">{{ $data['title'] }}</h2>
                    @endisset

                    @isset($data['description'])
                        <div class="contact__description contact__description--pc">
                            {!! $data['description'] !!}
                        </div>
                    @endisset
                </div>

                <div class="contact__right-block">
                    <div class="contact__right-text">

                        @isset($data['contact_info_title'])
                            <h3 class="contact__info-title">{{ $data['contact_info_title'] }}</h3>
                        @endisset

                        @isset($data['contact_info'])
                            <div class="contact__info-list">
                                @foreach($data['contact_info'] as $item)
                                    <div class="contact__info-item">
                                        @isset($item['icon'])
                                            <div class="contact__info-icon">
                                                <x-image
                                                    src="{{ $item['icon'] }}"
                                                    lazy="{{$data['is_lazy'] ?? false}}"
                                                    width="30"
                                                    height="30"
                                                />
                                            </div>
                                        @endisset
                                        @isset($item['text'])
                                            <span class="contact__info-text">{!! $item['text'] !!}</span>
                                        @endisset
                                    </div>
                                @endforeach
                            </div>
                        @endisset

                        @if($data['socials'] && $data['socials_title'])
                            <div class="contact__socials">
                                @isset($data['socials_title'])
                                    <h3 class="contact__socials-title">{{ $data['socials_title'] }}</h3>
                                @endisset

                                @isset($data['socials'])
                                    <div class="contact__socials-list">
                                        @foreach($data['socials'] as $social)
                                            <a href="{{ $social['link'] ?? '#' }}" class="contact__socials-item"
                                               target="_blank"
                                               rel="noopener noreferrer">
                                                @isset($social['icon'])
                                                    <div class="contact__socials-icon">
                                                        <x-image
                                                            src="{{ $social['icon'] }}"
                                                            lazy="{{$data['is_lazy'] ?? false}}"
                                                            width="30"
                                                            height="30"
                                                        />
                                                    </div>
                                                @endisset
                                            </a>
                                        @endforeach
                                    </div>
                                @endisset
                            </div>
                        @endif

                    </div>
                    <div class="contact__right-form">

                        @isset($data['image'])
                            <div class="contact__image contact__image--mb img-full">
                                <x-image
                                    src="{{ $data['image'] }}"
                                    lazy="{{$data['is_lazy'] ?? false}}"
                                    width="329"
                                    heigth="495"
                                />
                            </div>
                        @endisset

                        @isset($data['description'])
                            <div class="contact__description contact__description--mb">
                                {!! $data['description'] !!}
                            </div>
                        @endisset

                        @isset($data['form_title'])
                            <h3 class="contact__form-title">{{ $data['form_title'] }}</h3>
                        @endisset

                        @if($success)
                            <div class="contact__success">
                                {{ $data['success_message'] ?? __('Your message has been sent successfully!') }}
                            </div>
                        @endif

                        <form class="contact__form" wire:submit="send">
                            <div class="contact__form-field">
                                <input
                                    type="text"
                                    wire:model="name"
                                    class="contact__form-input @error('name') is-invalid @enderror"
                                    placeholder="{{ __('Full Name') }}"
                                >
                                @error('name')
                                <span class="contact__form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="contact__form-field">
                                <input
                                    type="tel"
                                    wire:model="phone"
                                    class="contact__form-input @error('phone') is-invalid @enderror"
                                    placeholder="{{ __('Phone Number') }}"
                                >
                                @error('phone')
                                <span class="contact__form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="contact__form-field">
                                <input
                                    type="email"
                                    wire:model="email"
                                    class="contact__form-input @error('email') is-invalid @enderror"
                                    placeholder="{{ __('Email') }}"
                                >
                                @error('email')
                                <span class="contact__form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            @isset($data['button_text'])
                                <button type="submit" class="contact__form-button btn" wire:loading.attr="disabled">
                                    {{ $data['button_text'] }}
                                </button>
                            @endisset
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
