<div class="max-w-xl mx-auto bg-white p-4">
    <h2 class="text-xl font-bold mb-4">AI About Me Generator</h2>

    <textarea
        wire:model="inputText"
        class="w-full p-3 bg-white border rounded mb-3"
        rows="4"
        placeholder="Tulis sedikit tentang diri kamu di sini..."
    ></textarea>

    <button
    wire:click="generate"
    wire:loading.attr="disabled"
    class="bg-blue-600 text-white px-4 py-2 rounded"
>
    <span wire:loading.remove>Generate About Me</span>
    <span wire:loading>Generating...</span>
</button>

    @if ($resultText)
        <div class="mt-4 p-4 border rounded bg-gray-50">
            <h3 class="font-semibold mb-2">Hasil:</h3>
            <p>{{ $resultText }}</p>
        </div>
    @endif
</div>
