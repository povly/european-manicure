<?php

use Livewire\Livewire;
use Livewire\Component;

new class extends Component {
    public array $data = [];

    public function mount(array $data): void
    {
        $this->data = $data;
    }

    public function isLazy(): bool
    {
        if (Livewire::isLivewireRequest()) {
            return false;
        }

        return (bool) ($this->data['is_lazy'] ?? false);
    }
};
?>

<section class="policy section" id="policy">
    <div class="container">
        @isset($data['title'])
            <h1 class="policy__title">{{ $data['title'] }}</h1>
        @endisset

        @isset($data['content'])
            <div class="policy__content">
                {!! $data['content'] !!}
            </div>
        @endisset
    </div>
</section>
