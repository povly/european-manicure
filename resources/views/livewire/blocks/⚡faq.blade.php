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

<section class="faq section">
    <div class="container">
        @isset($data['title'])
            <h2 class="faq__title section__title">{{ $data['title'] }}</h2>
        @endisset

        @isset($data['subtitle'])
            <p class="faq__subtitle">{{ $data['subtitle'] }}</p>
        @endisset

        @isset($data['questions'])
            <div class="faq__list">
                @foreach($data['questions'] as $index => $question)
                    <div class="faq__item" data-faq-item>
                        <button class="faq__item-header" data-faq-trigger>
                            @isset($question['title'])
                                <span class="faq__item-title">{{ $question['title'] }}</span>
                            @endisset
                            <span class="faq__item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        @isset($question['description'])
                            <div class="faq__item-content" data-faq-content>
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
</section>
