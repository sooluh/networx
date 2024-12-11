<x-filament-panels::page>
    {{ $this->table }}

    @if ($this->topResult)
        <x-filament::card class="mt-6">
            <h2 class="text-xl font-bold mb-4">Kesimpulan</h2>

            <ul class="mt-4 list-disc list-inside space-y-2">
                <li>
                    Dari nilai Yi di atas dapat dilihat bahwa <strong>A{{ $this->topResult->id }}</strong> memiliki
                    nilai terbesar,
                    sehingga dapat disimpulkan bahwa alternatif ke-{{ $this->topResult->id }} yang akan dipilih.
                </li>
                <li>
                    Dengan kata lain, <strong>{{ $this->topResult->name }}</strong> akan terpilih menjadi prioritas
                    untuk pembukaan area Wi-Fi Provider MyRepublic di wilayah Purwakarta.
                </li>
            </ul>
        </x-filament::card>
    @endif
</x-filament-panels::page>
