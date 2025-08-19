<div class="max-w-2xl mx-auto p-6" wire:poll.5s>
    <div class="flex items-center gap-4 mb-6">
        <span class="w-14 h-14 rounded-full bg-gradient-to-br from-accent to-zinc-300 flex items-center justify-center text-zinc-700 dark:text-zinc-200 text-2xl font-bold uppercase shadow">
            {{ mb_substr($user->name ?? 'U', 0, 1) }}
        </span>
        <div>
            <div class="text-xl font-bold">{{ $user->name }}</div>
            <div class="text-zinc-500 text-sm">{{ $user->email }}</div>
        </div>
    </div>
    <div class="flex gap-8 mb-8">
        <div>
            <div class="text-lg font-bold">{{ $postCount }}</div>
            <div class="text-xs text-zinc-500">Beiträge</div>
        </div>
        <div>
            <div class="text-lg font-bold">{{ $likeCount }}</div>
            <div class="text-xs text-zinc-500">Likes erhalten</div>
        </div>
    </div>
    <div class="space-y-4">
        @forelse($posts as $post)
            <div class="rounded-xl border p-4 bg-white dark:bg-zinc-800 shadow-sm flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <div class="mb-1 font-bold text-base truncate" title="{{ $post->title }}">{{ $post->title }}</div>
                    @if(auth()->id() === $user->id)
                        <flux:button color="danger" size="xs" wire:click="deletePost({{ $post->id }})">
                            Löschen
                        </flux:button>
                    @endif
                </div>
                <div class="text-sm text-zinc-700 dark:text-zinc-200 break-words line-clamp-3" title="{{ $post->body }}">
                    {{ $post->body }}
                </div>
                <div class="mt-2 text-xs text-zinc-400">
                    {{ $post->likes->count() }} Likes &middot; {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <div class="text-zinc-400">Keine Beiträge vorhanden.</div>
        @endforelse
    </div>
</div>