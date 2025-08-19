<div class="p-4">
    <div class="mb-4">
        <flux:radio.group
            wire:model="filter"
            label="Sortieren nach"
            variant="segmented"
            size="sm"
        >
            <flux:radio value="latest" label="Neueste" />
            <flux:radio value="most_liked" label="Trending" />
        </flux:radio.group>
    </div>
    <flux:modal.trigger name="create-post">
        <flux:button color="accent" class="mb-4">
            Beitrag erstellen
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-post">
        <form wire:submit.prevent="create" class="space-y-4">
            <flux:field label="Post erstellen">
                <flux:input
                    type="text"
                    maxlength="60"
                    placeholder="Titel (max. 60 Zeichen)"
                    wire:model.defer="title"
                    class="w-full"
                />
                <flux:textarea
                    maxlength="180"
                    placeholder="Was möchtest du teilen? (max. 180 Zeichen)"
                    wire:model.defer="body"
                    class="w-full mt-2"
                    rows="3"
                />
            </flux:field>
            <div class="flex justify-end gap-2">
                <flux:button type="button" color="neutral" @click="$dispatch('close-modal', { id: 'create-post' })">
                    Abbrechen
                </flux:button>
                <flux:button type="submit" color="accent">
                    Speichern
                </flux:button>
            </div>
        </form>
    </flux:modal>

    <div class="mt-8 space-y-4" wire:poll.5s>
        @foreach($posts as $post)
            <div class="rounded-xl border p-4 bg-white dark:bg-zinc-800 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center gap-3 font-semibold mb-2">
                    <a href="{{ route('profile.public', $post->user) }}">
                        <span class="w-9 h-9 rounded-full bg-gradient-to-br from-accent to-zinc-300 flex items-center justify-center text-zinc-700 dark:text-zinc-200 text-lg font-bold uppercase shadow hover:scale-105 transition-transform duration-150">
                            {{ mb_substr($post->user->name ?? 'U', 0, 1) }}
                        </span>
                    </a>
                    <span>{{ $post->user->name ?? 'Unbekannt' }}</span>
                    <span class="ml-auto text-xs text-zinc-400">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <div class="mb-1 font-bold text-base truncate" title="{{ $post->title }}">{{ $post->title }}</div>
                <div class="text-sm text-zinc-700 dark:text-zinc-200 break-words line-clamp-3" title="{{ $post->body }}">
                    {{ $post->body }}
                </div>
                <div class="mt-3 flex items-center gap-2 text-xs text-zinc-400">
                    <flux:button wire:click="like({{ $post->id }})" color="neutral" size="xs" class="flex items-center px-2 py-1">
                        <svg class="w-4 h-4 mr-1 {{ $post->likes->where('user_id', auth()->id())->count() ? 'text-red-500 fill-red-500' : 'text-zinc-400' }}" fill="{{ $post->likes->where('user_id', auth()->id())->count() ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21C12 21 4 13.5 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 4.01 13.44 5.61C13.97 4.01 15.64 3 17.38 3C20.46 3 22.88 5.42 22.88 8.5C22.88 13.5 15 21 15 21H12Z"/>
                        </svg>
                        <span>{{ $post->likes->count() }}</span>
                    </flux:button>
                </div>
            </div>
        @endforeach

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</div>