<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <a href="{{ route('home') }}" class="footer__logo">
                @isset($footerData['logo'])
                    <x-image
                        src="{{ $footerData['logo'] }}"
                        lazy="0"
                    />
                @endisset
            </a>

            @isset($footerData['name'])
                <span class="footer__name">{{ $footerData['name'] }}</span>
            @endisset

            @isset($footerData['links'])
                <nav class="footer__links">
                    @foreach($footerData['links'] as $link)
                        <a href="{{ $link['url'] ?? '#' }}" class="footer__link">
                            {{ $link['text'] ?? '' }}
                        </a>
                    @endforeach
                </nav>
            @endisset

            @isset($footerData['copyright'])
                <span class="footer__copyright">{{ $footerData['copyright'] }}</span>
            @endisset
        </div>
    </div>
</footer>
