<x-layout>
    <div class="py-8 max-w-4xl mx-auto px-4 flex flex-col">
        {{-- Navigation & Actions Row --}}
        <div class="flex flex-row justify-between gap-y-4 mb-8">
            <a href="{{ route('idea.index') }}"
                class="flex items-center gap-x-2 text-sm font-medium text-muted-foreground hover:text-foreground transition-colors">
                <x-icons.arrow-back />
                Back to Ideas
            </a>


            <div class="flex gap-4">
                <a href="#" class="btn btn-outlined">
                    <x-icons.external />
                    Edit Idea
                </a>

                <form action="{{ route('idea.destroy', $idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outlined border-red-500/50 text-red-500 hover:bg-red-50">
                        Delete
                    </button>
                </form>
            </div>


        </div>

        {{-- Content --}}
        <div class="mt-10 ">
            @if ($idea->image_path)
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $idea->image_path)}}" alt="" class="w-full h-auto object-cover">
                </div>
            @endif
            <h1 class="font-bold text-4xl ">{{ $idea->title }}</h1>
            <div class="mt-2 flex gap-x-3 items-center mb-10">
                <x-status-label :status="$idea->status->value">{{ $idea->status->label() }}</x-status-label>

                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>

            <div
                class="mt-10 text-foreground curser-pointer border border-border rounded-lg bg-card p-4 md:text-sm transition-colors hover:bg-accent">
                {{ $idea->description }}
            </div>
            @if ($idea->steps->count())
                <h3 class="font-bold text-xl mt-6">Actionable Steps</h3>
                <div class="mt-10 text-foreground curser-pointer rounded-lg md:text-sm transition-colors hover:bg-accent">

                    @forelse($idea->steps as $step)
                        <x-cardi class=" font-meduim flex gap-3 items-center my-2">
                            <form method="POST" action="/steps/{{ $step->id }}">
                                @csrf
                                @method("PATCH")
                                <div class="flex items-center gap-3 ">
                                    <button type="submit" role="checkbox" class="size-5 flex items-center justify-center rounded-lg text-primary-foreground {{ $step->completed ? 'bg-primary' : 'border border-primary' }} "><x-icons.check></x-icons.check></button>
                                    <span class="{{ $step->completed ? 'line-through text-muted-foreground' : '' }}">{{ $step['description'] }} </span>
                                </div>
                            </form>
                        </x-cardi>
                    @empty

                    @endforelse
                </div>

            @endif

            @if ($idea->links->count())
                <h3 class="font-bold text-xl mt-6">Links</h3>
                <div
                    class="mt-10 text-foreground curser-pointer border border-border rounded-lg bg-card p-4 md:text-sm transition-colors hover:bg-accent">

                    @forelse($idea->links as $link)
                        <a href="#"><span class="flex items-center gap-3 my-2 py-2"><x-icons.external />{{ $link }}</span></a>
                    @empty

                    @endforelse
                </div>
            @endif
        </div>

    </div>
</x-layout>