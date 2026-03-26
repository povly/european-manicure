<?php

use Livewire\Component;
use App\Models\Setting;

new class extends Component
{
    public array $data = [];

    public function mount(): void
    {
        $setting = Setting::getBySlug('footer');
        if ($setting?->content) {
            foreach ($setting->content as $block) {
                if ($block->getName() === 'footer') {
                    $this->data = $block->getValues();
                    break;
                }
            }
        }
    }
};
?>

<footer class="footer">
    <div class="container">
        <a href="{{ route('home') }}" class="footer__logo">
            @isset($data['logo'])
                <x-image
                    src="{{ $data['logo'] }}"
                    lazy="1"
                    width="50"
                    heigth="42"
                />
            @endisset
        </a>

        @isset($data['name'])
            <span class="footer__name">{{ $data['name'] }}</span>
        @endisset

        <div class="footer__inner">
            @isset($data['copyright'])
                <span class="footer__copyright">{{ $data['copyright'] }}</span>
            @endisset

            @isset($data['links'])
                <nav class="footer__links">
                    @foreach($data['links'] as $link)
                        <a href="{{ $link['url'] ?? '#' }}" class="footer__link">
                            {{ $link['text'] ?? '' }}
                        </a>
                    @endforeach
                </nav>
            @endisset

            <div class="footer__site">
                Created by
                <a href="#!">Pavlo Klymash</a>
            </div>
        </div>
    </div>
</footer>
