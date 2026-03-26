<?php

use Livewire\Component;
use App\Models\Setting;

new class extends Component
{
    public array $data = [];

    public function mount(): void
    {
        $setting = Setting::getBySlug('header');
        if ($setting?->content) {
            foreach ($setting->content as $block) {
                if ($block->getName() === 'header') {
                    $this->data = $block->getValues();
                    break;
                }
            }
        }
    }
};
?>

<header class="header">
    <div class="container">
        <div class="header__inner">
            
            <nav class="header__list">
                <ul>
                    @foreach($data['links'] ?? [] as $link)
                        <li>
                            <a href="{{ $link['url'] ?? '#' }}">{{ $link['text'] ?? '' }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            
            <a href="{{ route('home') }}" class="header__logo">
                @isset($data['logo'])
                    <x-image
                        src="{{ $data['logo'] }}"
                        width="100"
                        height="51"
                        lazy="0"
                    />
                @endisset
            </a>

            <div class="header__right">
                @isset($data['info'])
                    <div class="header__infos">
                        @foreach($data['info'] as $infoItem)
                            <div class="header__info">
                                @isset($infoItem['icon'])
                                    <x-image
                                        src="{{ $infoItem['icon'] }}"
                                        alt=""
                                        width="13"
                                        height="13"
                                        lazy="0"
                                    />
                                @endisset
                                @isset($infoItem['text'])
                                    <span>{{ $infoItem['text'] }}</span>
                                @endisset
                            </div>
                        @endforeach
                    </div>
                @endisset

                @isset($data['socials'])
                    <div class="header__socials">
                        @foreach($data['socials'] as $social)
                            <a href="{{ $social['url'] ?? '#' }}" class="header__social" target="_blank" rel="noopener">
                                <x-image
                                    src="{{ $social['icon'] ?? '' }}"
                                    alt="{{ $social['name'] ?? '' }}"
                                    width="20"
                                    height="20"
                                    lazy="0"
                                />
                            </a>
                        @endforeach
                    </div>
                @endisset

                @isset($data['button_text'])
                    <a href="{{ $data['button_link'] ?? '#' }}" class="btn header__btn">
                        {{ $data['button_text'] }}
                    </a>
                @endisset

                <button class="header__burger" type="button" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>
