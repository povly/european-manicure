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

<header class="header" x-data="{ menuOpen: false }" @menu-open.window="menuOpen = true" @menu-close.window="menuOpen = false">
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

                <button class="header__burger" type="button" aria-label="Menu" @click="menuOpen = true">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>

    <div class="modal header__modal" :class="{ 'active': menuOpen }" @click.self="menuOpen = false">
        <div class="modal__table">
            <div class="modal__ceil">
                <div class="header__modal-content" @click.stop>
                    <div class="header__modal-head">
                        <a href="{{ route('home') }}" class="header__modal-logo">
                            @isset($data['logo'])
                                <x-image
                                    src="{{ $data['logo'] }}"
                                    width="99"
                                    height="51"
                                    lazy="0"
                                />
                            @endisset
                        </a>
                        <button class="header__modal-close" type="button" aria-label="Close" @click="menuOpen = false">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.100586" y="18.4853" width="26" height="2" rx="1" transform="rotate(-45 0.100586 18.4853)" fill="#6E6760" />
                                <rect x="1.41406" width="26" height="2" rx="1" transform="rotate(45 1.41406 0)" fill="#6E6760" />
                            </svg>
                        </button>
                    </div>

                    @isset($data['title'])
                        <div class="header__modal-title">{{ $data['title'] }}</div>
                    @endisset

                    @isset($data['links'])
                        <nav class="header__modal-nav">
                            <ul>
                                @foreach($data['links'] as $link)
                                    <li>
                                        <a href="{{ $link['url'] ?? '#' }}" @click="menuOpen = false">{{ $link['text'] ?? '' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    @endisset

                    @isset($data['socials'])
                        <div class="header__modal-socials">
                            @foreach($data['socials'] as $social)
                                <a href="{{ $social['url'] ?? '#' }}" class="header__modal-social" target="_blank" rel="noopener">
                                    <x-image
                                        src="{{ $social['icon'] ?? '' }}"
                                        alt="{{ $social['name'] ?? '' }}"
                                        width="30"
                                        height="30"
                                        lazy="0"
                                    />
                                </a>
                            @endforeach
                        </div>
                    @endisset

                    @isset($data['description'])
                        <div class="header__modal-desc">{{ $data['description'] }}</div>
                    @endisset

                    @isset($data['info'])
                        <div class="header__modal-infos">
                            @foreach($data['info'] as $infoItem)
                                <div class="header__modal-info">
                                    @isset($infoItem['icon'])
                                        <x-image
                                            src="{{ $infoItem['icon'] }}"
                                            alt=""
                                            width="20"
                                            height="20"
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

                    @isset($data['button_text'])
                        <a href="{{ $data['button_link'] ?? '#' }}" class="btn header__modal-btn" @click="menuOpen = false">
                            {{ $data['button_text'] }}
                        </a>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</header>
