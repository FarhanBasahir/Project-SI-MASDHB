<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{-- Ini akan merender semua field form yang Anda definisikan di kelas Pengaturan --}}
        {{ $this->form }}

        {{-- Ini akan merender tombol 'Simpan Pengaturan' --}}
        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>
