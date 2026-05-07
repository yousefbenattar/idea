<x-layout>

    <header class="py-8 md:py-12 cursor-pointer">
        <h1 class="text-3xl font-bold">Ideas</h1>
        <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        <div x-data="" @click="$dispatch('open-modal','create-idea')" is="button" type="button"
            class="mt-10 h-32 text-foregroundborder border-border rounded-lg bg-card p-4 md:text-sm transition-colors hover:bg-accent">
            What's the idea ?

        </div>
    </header>
    <div>
        <a href="/" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>

        @foreach (App\IdeaStatus::cases() as $status)
            <a href="/?status={{ $status->value }}"
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
        <form x-data="{status : 'pending'  ,newLink : '', links : [] }" action="/idea/store" method="Post">
            @csrf
            <div class="space-y-6">
                <x-form.field label="Title" name="title" placeholder="Enter an idea for your title" autofocus
                    required />
                <div class="space-y-2">
                    <label class="label" for="status">Status</label>
                    <div class="flex gap-x-3">
                        @foreach (App\IdeaStatus::cases() as $status)
                            <button type="button" @click="status = @js($status->value)" class="btn flex-1 h-10"
                                :class="status === @js($status->value) ? '' : 'btn-outlined'">
                                {{ $status->label()}}
                            </button>

                        @endforeach
                        <input type="hidden" class="input" :value="status" name="status">
                    </div>
                    <x-form.error name="status">
                    </x-form.error>
                </div>
                <x-form.field label="Description" name="description" type="textarea"
                    placeholder="Describe your idea..." />
            </div>
            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>
                    <template x-for="(link,index) in links" class="flex flex-col">
                        <div class="flex gap-x-2 items-center">
                            <input type="input" name="links[]" x-model="link">
                            <button aria-label="remove Likn" type="button" class="form-muted-icon"
                                @click="links.splice(index)">
                                <x-icons.trash></x-icons.trash>
                            </button>
                        </div>
                    </template>
                    <div class="flex gap-x-2 items-center">
                        <input x-model="newLink" type="url" id="newLink" placeholder="http://example.com"
                            autocomplete="url" class="input flex-1"   spellcheck="false" />
                        <button aria-label="add a new link" :disabled="newLink.trim().length === 0" type="button"
                            class="form-muted-icon" @click="links.push(newLink.trim()); newLink = '';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg>
                        </button>
                    </div>
                    <!-- <pre x-text="JSON.stringify(links)"> -->

                    </pre>
                </fieldset>
            </div>
            <div class="flex justify-end gap-x-5 mt-4 pr-4">
                <button type="button" @click="$dispatch('close-modal')"
                    class="btn btn-outlined font-bold hover:text-red-500/70 hover:font-extrabold">
                    Cancel
                </button>
                <button type="submit" class="btn">Create</button>
            </div>


        </form>
    </x-modal>
</x-layout>