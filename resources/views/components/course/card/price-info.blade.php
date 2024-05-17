@props(['incl', 'excl'])

<div class="flex items-center gap-4 ">
  <span>
      <x-icons.check-filled class="block w-5 h-5" />
  </span>
  <div>
      <div class="font-bold text-syntra"> € {{ number_format($incl, 2) }}
      </div>
      <div class="text-xs text-gray-600 dark:text-gray-200"> €
          {{ number_format($excl, 2) }} </div>
  </div>
</div>
