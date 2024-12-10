<x-filament-panels::page>
    {{ $this->table }}
    @livewire(\App\Filament\Widgets\NormalizedMatrix::class)
    @livewire(\App\Filament\Widgets\WeightNormalizedMatrix::class)
    @livewire(\App\Filament\Widgets\YiValue::class)
</x-filament-panels::page>
