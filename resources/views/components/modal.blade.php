@props(['name', 'title'])

<div x-data="{show:true , name : @js($name) }"
    @open-modal.window="if($event.detail === name) show = true;"
    @close-modal = "show =false"
    x-show="show"
    role="dialog" @keydown.escape.window="show = false"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4 -translate-x-4"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 -translate-y-4 -translate-x-4"
    class= "fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs"
    style=" display:none"
    aria-labelledby="modal-{{ $name }}-title" :aria-hidden="!show" tabindex="-1">
    <x-cardi @click.away="show = false" class="shadow-xl max-w-2x1 w-full max-h-[80dvh] max-w-[80dvw] overflow-auto">
        <div class="flex justify-between items-center"  @click="show = false">
            <h2 id="modal-{{$title}}-title" class="text-xl font-bold">{{ $title }}</h2>
            <button aria-label="Close Modal"><x-icons.close /></button>
        </div>
        {{ $slot }}
    </x-cardi>
</div>