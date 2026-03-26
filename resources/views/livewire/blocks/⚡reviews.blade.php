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

<section class="reviews section">
    <div class="container">
        <div class="reviews__top">
            @isset($data['title'])
                <h2 class="reviews__title section__title">{{ $data['title'] }}</h2>
            @endisset

            @isset($data['subtitle'])
                <div class="reviews__subtitle reviews__subtitle--mb">{{ $data['subtitle'] }}</div>
            @endisset

            <div class="reviews__top-right">
                @isset($data['images'])
                    <div class="reviews__images">
                        @foreach($data['images'] as $image)
                            @isset($image['image'])
                                <div class="reviews__images-item img-full">
                                    <x-image
                                        src="{{ $image['image'] }}"
                                        lazy="{{$data['is_lazy'] ?? false}}"
                                        width="40"
                                        height="40"
                                    />
                                </div>
                            @endisset
                        @endforeach
                    </div>
                @endisset

                @if(isset($data['trusted_clients_number']) || isset($data['trusted_clients_text']))
                    <div class="reviews__trusted">
                        @isset($data['trusted_clients_number'])
                            <span class="reviews__trusted-number">{{ $data['trusted_clients_number'] }}</span>
                        @endisset
                        @isset($data['trusted_clients_text'])
                            <span class="reviews__trusted-text">{{ $data['trusted_clients_text'] }}</span>
                        @endisset
                    </div>
                @endif
            </div>
        </div>
    </div>

    @isset($data['reviews'])
        <div class="reviews__splide" data-slider>
            <ul class="reviews__list" data-slider-track>
                @foreach($data['reviews'] as $review)
                    <li class="reviews__slide" data-slider-slide>

                        <div class="reviews__slide-top">
                            @isset($review['image'])
                                <div class="reviews__slide-image img-full">
                                    <x-image
                                        src="{{ $review['image'] }}"
                                        lazy="{{$data['is_lazy'] ?? false}}"
                                        width="52"
                                        height="52"
                                    />
                                </div>

                                @if(isset($review['platform_icon']) || isset($review['platform_text']))
                                    <div class="reviews__slide-platform">
                                        @isset($review['platform_icon'])
                                            <div class="reviews__slide-platform-icon">
                                                <x-image
                                                    src="{{ $review['platform_icon'] }}"
                                                    lazy="{{$data['is_lazy'] ?? false}}"
                                                    width="14"
                                                    height="14"
                                                />
                                            </div>
                                        @endisset
                                        @isset($review['platform_text'])
                                            <span
                                                class="reviews__slide-platform-text">{{ $review['platform_text'] }}</span>
                                        @endisset
                                    </div>
                                @endif
                            @endisset
                        </div>

                        @isset($review['description'])
                            <div class="reviews__slide-description">
                                <div class="reviews__slide-description-before">“</div>
                                <div class="reviews__slide-description-text">
                                    {!! $review['description'] !!}
                                </div>
                            </div>
                        @endisset

                        <div class="reviews__slide-bottom">
                            @isset($review['name'])
                                <div class="reviews__slide-name">{{ $review['name'] }}</div>
                            @endisset

                            @isset($review['client_type'])
                                <div class="reviews__slide-client-type">{{ $review['client_type'] }}</div>
                            @endisset
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endisset

    <div class="container">
        <div class="reviews__bottom">
            @isset($data['subtitle'])
                <div class="reviews__subtitle reviews__subtitle--pc">{{ $data['subtitle'] }}</div>
            @endisset

            <div class="reviews__controls p-arrows" data-slider-controls>
                <button
                    class="reviews__arrow p-arrow p-arrow--prev"
                    data-slider-prev
                    aria-label="Previous"
                >
                    <svg width="81" height="81" viewBox="0 0 81 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="79" height="79" rx="39.5" stroke="black" stroke-width="2"/>
                        <rect x="1" y="1" width="79" height="79" rx="39.5" stroke="url(#paint0_linear_rev_1)"
                              stroke-width="2"/>
                        <defs>
                            <linearGradient id="paint0_linear_rev_1" x1="0" y1="40.5" x2="81" y2="40.5"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#807971"/>
                                <stop offset="1" stop-color="#67615A"/>
                            </linearGradient>
                        </defs>
                    </svg>

                    <svg width="28" height="15" viewBox="0 0 28 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M27 8.36426C27.5523 8.36426 28 7.91654 28 7.36426C28 6.81197 27.5523 6.36426 27 6.36426L27 7.36426L27 8.36426ZM0.292892 6.65715C-0.0976315 7.04768 -0.0976314 7.68084 0.292893 8.07137L6.65686 14.4353C7.04738 14.8259 7.68054 14.8259 8.07107 14.4353C8.46159 14.0448 8.46159 13.4116 8.07107 13.0211L2.41421 7.36426L8.07107 1.70741C8.46159 1.31688 8.46159 0.683716 8.07107 0.293192C7.68054 -0.0973327 7.04738 -0.0973326 6.65685 0.293192L0.292892 6.65715ZM27 7.36426L27 6.36426L1 6.36426L1 7.36426L1 8.36426L27 8.36426L27 7.36426Z"
                            fill="#67615A"/>
                    </svg>
                </button>

                <button
                    class="reviews__arrow p-arrow p-arrow--next"
                    data-slider-next
                    aria-label="Next"
                >
                    <svg width="81" height="81" viewBox="0 0 81 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="79" height="79" rx="39.5" stroke="black" stroke-width="2"/>
                        <rect x="1" y="1" width="79" height="79" rx="39.5" stroke="url(#paint0_linear_rev_2)"
                              stroke-width="2"/>
                        <defs>
                            <linearGradient id="paint0_linear_rev_2" x1="0" y1="40.5" x2="81" y2="40.5"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#807971"/>
                                <stop offset="1" stop-color="#67615A"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <svg width="28" height="15" viewBox="0 0 28 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 6.36426C0.447715 6.36426 0 6.81197 0 7.36426C0 7.91654 0.447715 8.36426 1 8.36426L1 7.36426L1 6.36426ZM27.7071 8.07136C28.0976 7.68084 28.0976 7.04768 27.7071 6.65715L21.3431 0.29319C20.9526 -0.0973344 20.3195 -0.0973344 19.9289 0.29319C19.5384 0.683714 19.5384 1.31688 19.9289 1.7074L25.5858 7.36426L19.9289 13.0211C19.5384 13.4116 19.5384 14.0448 19.9289 14.4353C20.3195 14.8259 20.9526 14.8259 21.3431 14.4353L27.7071 8.07136ZM1 7.36426L1 8.36426L27 8.36426V7.36426V6.36426L1 6.36426L1 7.36426Z"
                            fill="#68625A"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>
