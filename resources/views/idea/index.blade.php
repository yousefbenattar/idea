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
    <div class="mt-4 text-muted-foreground">
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($ideas as $idea)
          
                <x-card href="/ideas/{{$idea->id}}">
                      @if ($idea->image_path)
                <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $idea->image_path)}}" alt="" class="w-full h-48 object-cover">
                </div>
            @endif
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
        <form x-data="{
        status : 'pending',
        newLink : '',
        links : [],
        newStep : '',
        steps : [] }" action="/idea/store" method="Post" enctype="multipart/form-data">
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
                <div class="space-w-2">
                    <label for="image" class="label  pb-2">Featuerd Image</label>
                    <input type="file" name="image" accepte="image/*">
                    <x-form.error name="image" />
                </div>
            </div>
            <div class="mt-4">
                <fieldset class="space-y-3">
                    <legend class="label">Actionable Steps</legend>
                    <template x-for="(step,index) in steps" class="flex flex-col">
                        <div class="flex gap-x-2 items-center">
                            <input type="input" name="steps[]" x-model="step" class="input flex-1">
                            <button aria-label="remove Link" type="button" class="form-muted-icon "
                                @click="steps.splice(index)">
                                <x-icons.trash></x-icons.trash>
                            </button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input x-model="newStep" id="new-Step" data-test="new-Step" placeholder="What needs to be done"
                            class="input flex-1 input flex-1" spellcheck="false" />
                        <button aria-label="add a new link" :disabled="newStep.trim().length === 0" type="button"
                            class="form-muted-icon" @click="steps.push(newStep.trim()); newStep = '';">
                            <x-icons.add></x-icons.add>
                        </button>
                    </div>
                    <!-- <pre x-text="JSON.stringify(links)"> </pre>-->
                </fieldset>
            </div>
            <div class="mt-4">
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>
                    <template x-for="(link,index) in links" class="flex flex-col">
                        <div class="flex gap-x-2 items-center">
                            <input type="input" name="links[]" x-model="link" class="input flex-1">
                            <button aria-label="remove Likn" type="button" class="form-muted-icon "
                                @click="links.splice(index)">
                                <x-icons.trash></x-icons.trash>
                            </button>
                        </div>
                    </template>
                    <div class="flex gap-x-2 items-center">
                        <input x-model="newLink" type="url" id="newLink" placeholder="http://example.com"
                            autocomplete="url" class="input flex-1" spellcheck="false" />
                        <button aria-label="add a new link" :disabled="newLink.trim().length === 0" type="button"
                            class="form-muted-icon" @click="links.push(newLink.trim()); newLink = '';">
                            <x-icons.add></x-icons.add>
                        </button>
                    </div>
                    <!-- <pre x-text="JSON.stringify(links)"> </pre>-->

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