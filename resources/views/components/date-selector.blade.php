@props([
    'label' => null,
    'withDay' => true,
])


<div x-data="{
    model: @entangle($attributes->wire('model')),
    day: '',
    month: '',
    year: '',
    // Kirim nilai props PHP ke Alpine JS
    withDay: {{ $withDay ? 'true' : 'false' }},

    init() {
        this.parseDate();
        this.$watch('model', () => this.parseDate());
    },

    parseDate() {
        if (this.model) {
            let parts = this.model.split('-');
            if (parts.length === 3) {
                this.year = parts[0];
                this.month = parts[1];
                // Jika withDay aktif, ambil tanggal dari data. Jika tidak, abaikan.
                if (this.withDay) {
                    this.day = parseInt(parts[2]);
                } else {
                    this.day = 1; 
                }
            }
        }
    },

    updateDate() {
        let isDayValid = this.withDay ? this.day : true;
        
        if (isDayValid && this.month && this.year) {
            // Jika withDay false, paksa tanggal jadi '01'
            let d = this.withDay ? this.day.toString().padStart(2, '0') : '01';
            let m = this.month.toString().padStart(2, '0');
            this.model = `${this.year}-${m}-${d}`;
        }
    }
}" class="w-full">

    @if ($label)
        <label class="block text-xs font-semibold text-gray-600 mb-1">{{ $label }}</label>
    @endif

    {{-- LOGIC GRID: Jika $withDay FALSE, ubah grid jadi 2 kolom --}}
    <div class="grid gap-2 {{ $withDay ? 'grid-cols-3' : 'grid-cols-2' }}">
        
        {{-- BLADE IF: Element ini tidak akan dirender server jika $withDay false --}}
        @if ($withDay)
            <select x-model="day" @change="updateDate()"
                class="w-full px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        @endif

        {{-- Bulan --}}
        <select x-model="month" @change="updateDate()" class="w-full px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            <option value="">Bulan</option>
            @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'] as $index => $mon)
                <option value="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}">{{ $mon }}</option>
            @endforeach
        </select>

        {{-- Tahun --}}
        <select x-model="year" @change="updateDate()" class="w-full px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            <option value="">Thn</option>
            @for ($i = date('Y') + 5; $i >= 1950; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>