<x-layout>

    <header class="py-8 md:py-12 cursor-pointer">
        <h1 class="text-3xl font-bold">Ideas</h1>
        <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        <div x-data=""
        @click="$dispatch('open-modal','create-idea')" is="button" type="button"
            class="mt-10 h-32 text-foregroundborder border-border rounded-lg bg-card p-4 md:text-sm transition-colors hover:bg-accent">
            What's the idea ?

        </div>
    </header>
    <div>
        <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>

        @foreach (App\IdeaStatus::cases() as $status)
            <a href="/ideas?status={{ $status->value }}"
                class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                {{ $status->label() }} <span class="text-xs pl-3">{{ $statusCounts->get($status->value) }}</span>
            </a>
        @endforeach
    </div>
    <div class="mt-10 text-muted-foreground">
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($ideas as $idea)
                <x-card href="/ideas/{{$idea->id}}">
                    <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                    <div class="mt-1">
                        <x-status-label status="{{ $idea->status }}">
                            {{ $idea->status->label() }}
                        </x-status-label>
                    </div>
                    <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                    <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>

                </x-card>
            @empty
                <x-card>
                    <h3>No ideas at this time.</h3>
                </x-card>
            @endforelse
        </div>
    </div>
<!--- create modal ---->
<x-modal title="New Idea" name="create-idea">
    <p>slot content</p>
</x-modal>
</x-layout>