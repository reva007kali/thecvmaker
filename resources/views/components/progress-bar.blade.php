 <div class="mb-8 overflow-x-auto p-2">
     <div class="flex justify-between mb-2">
         @for ($i = 1; $i <= $totalSteps; $i++)
             <div class="flex flex-col items-center flex-1">
                 <div class="flex items-center w-full">
                     @if ($i > 1)
                         <div class="flex-1 h-1 {{ $currentStep >= $i ? 'bg-blue-600' : 'bg-gray-300' }}">
                         </div>
                     @endif

                     <div class="relative">
                         <div wire:click="goToStep({{ $i }})"
                             class="w-10 h-10 rounded-full flex items-center justify-center font-bold cursor-pointer transition-all
                                         {{ $currentStep >= $i ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}
                                         {{ $currentStep == $i ? 'ring-4 ring-blue-200' : '' }}">
                             {{ $i }}
                         </div>
                     </div>

                     @if ($i < $totalSteps)
                         <div class="flex-1 h-1 {{ $currentStep > $i ? 'bg-blue-600' : 'bg-gray-300' }}">
                         </div>
                     @endif
                 </div>
                 <span
                     class="text-xs mt-2 text-center {{ $currentStep >= $i ? 'text-blue-600 font-semibold' : 'text-gray-500' }}">
                     @if ($i == 1)
                         Personal
                     @elseif($i == 2)
                         Education
                     @elseif($i == 3)
                         Skills
                     @elseif($i == 4)
                         Achievements
                     @elseif($i == 5)
                         Sea & Docs
                     @else
                         Review
                     @endif
                 </span>
             </div>
         @endfor
     </div>
 </div>
