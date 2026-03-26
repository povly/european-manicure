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

<section class="faq section" x-data="{ activeIndex: null }">
    <div class="container">
        <div class="faq__block">
            <div class="faq__left">
                @isset($data['title'])
                    <h2 class="faq__title section__title">{{ $data['title'] }}</h2>
                @endisset

                @isset($data['subtitle'])
                    <p class="faq__subtitle">{!! $data['subtitle'] !!}</p>
                @endisset
            </div>

            <div class="faq__right">
                @isset($data['questions'])
                    <div class="faq__list">
                        @foreach($data['questions'] as $index => $question)
                            <div class="faq__item" :class="{ 'active': activeIndex === {{ $index }} }">
                                <button
                                    class="faq__item-header"
                                    @click="activeIndex = activeIndex === {{ $index }} ? null : {{ $index }}"
                                >
                                    @isset($question['title'])
                                        <span class="faq__item-title">{{ $question['title'] }}</span>
                                    @endisset
                                    <span class="faq__item-icon">
                                        <svg class="faq__item-icon-bg" width="42" height="42" viewBox="0 0 42 42" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <rect x="0.75" y="0.75" width="40.5" height="40.5" rx="20.25" stroke="black" stroke-width="1.5"/>
                                          <rect x="0.75" y="0.75" width="40.5" height="40.5" rx="20.25" stroke="url(#paint0_linear_32_722)" stroke-width="1.5"/>
                                          <defs>
                                            <linearGradient id="paint0_linear_32_722" x1="0" y1="21" x2="42" y2="21" gradientUnits="userSpaceOnUse">
                                              <stop stop-color="#807971"/>
                                              <stop offset="1" stop-color="#67615A"/>
                                            </linearGradient>
                                          </defs>
                                        </svg>
                                        <svg class="faq__item-icon-line" width="35" height="35" viewBox="0 0 35 35" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <rect x="0.5" y="17.5" width="34" height="1" rx="0.5" fill="white"
                                                stroke="url(#paint0_linear_2016_21{{$index}})"/>
                                          <rect x="17.5" y="34.5" width="34" height="1" rx="0.5"
                                                transform="rotate(-90 17.5 34.5)" fill="white"
                                                stroke="url(#paint1_linear_2016_21{{$index}})"/>
                                          <defs>
                                            <linearGradient id="paint0_linear_2016_21{{$index}}" x1="0" y1="18" x2="35"
                                                            y2="18" gradientUnits="userSpaceOnUse">
                                              <stop stop-color="#807971"/>
                                              <stop offset="1" stop-color="#67615A"/>
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_2016_21{{$index}}" x1="17" y1="36" x2="52"
                                                            y2="36" gradientUnits="userSpaceOnUse">
                                              <stop stop-color="#807971"/>
                                              <stop offset="1" stop-color="#67615A"/>
                                            </linearGradient>
                                          </defs>
                                        </svg>
                                    </span>
                                </button>
                                @isset($question['description'])
                                    <div
                                        class="faq__item-content"
                                        x-ref="content{{ $index }}"
                                        x-bind:style="activeIndex === {{ $index }} ? 'height: ' + $refs.content{{ $index }}.scrollHeight + 'px' : 'height: 0'"
                                    >
                                        <div class="faq__item-description">
                                            {!! $question['description'] !!}
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </div>
</section>
