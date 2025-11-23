<div class="relative w-full max-w-[794px] mx-auto aspect-[794/1123] shadow-lg bg-white">
    <div class="flex">
        <div class="w-[240px] bg-amber-600 h-[1123px] p-8">
            <img src="{{ Storage::url($existingPhoto) }}" class="aspect-square object-top object-cover rounded-full mb-4">

            <h1 x-text="first_name" class="text-xl font-bold mb-2"></h1>
            <h1 x-text="last_name" class="text-xl font-bold mb-2"></h1>
            <h1 x-text="email" class="text-xl font-bold mb-2"></h1>
            <h1 x-text="phone" class="text-xl font-bold mb-2"></h1>
            <template x-for="(exp, index) in experiences" :key="index">
                <div class="mb-2">
                    <input type="text" x-model="exp.company" placeholder="Company">
                    <input type="text" x-model="exp.job_title" placeholder="Job Title">
                </div>
            </template>

            <!-- Konten lainnya -->
        </div>
    </div>
</div>
