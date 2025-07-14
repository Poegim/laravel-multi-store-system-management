<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Podgląd logów (laravel.log)</h2>

    <div class="mb-4">
        <input
            type="text"
            wire:model.live.debounce.500ms="filter"
            placeholder="Filtruj (np. error, info, exception)"
            class="border rounded px-3 py-2 w-full"
        />
    </div>

    <div class="bg-gray-100 rounded p-4 max-h-[600px] overflow-y-auto text-sm font-mono whitespace-pre-wrap">
        @forelse($logs as $line)
            <div class="mb-1">{{ $line }}</div>
        @empty
            <p>Brak wpisów.</p>
        @endforelse
    </div>
</div>
