<x-filament::page>
    <form wire:submit.prevent>
        {{ $this->form }}
    </form>

    <div class="mt-6">
        <iframe
            key="{{ now()->timestamp }}-{{ $empresa }}-{{ $tipo }}-{{ $inicio }}-{{ $fim }}"
            src="{{ $this->getIframeUrl() }}"
            style="width: 100%; height: 90vh; border: none;"
        ></iframe>
    </div>
</x-filament::page>
