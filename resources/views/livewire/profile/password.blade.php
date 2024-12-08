<x-filament::section>
    <x-slot name="heading">
        Kata Sandi
    </x-slot>

    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <div class="text-left">
            <x-filament::button type="submit">
                Simpan
            </x-filament::button>
        </div>
    </x-filament-panels::form>
</x-filament::section>
