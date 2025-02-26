<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold">Daftar Buku</h2>
        {{ $this->bukuTable }}

        <h2 class="text-lg font-bold mt-4">Daftar Penerbit</h2>
        {{ $this->penerbitTable }}
    </x-filament::card>
</x-filament::widget>