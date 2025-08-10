<div>
    @if($posts->count() > 0)
        <div class="space-y-4">
            @foreach($posts as $post)
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <h4 class="font-semibold text-gray-900">{{ $post->title }}</h4>
                    <p class="text-sm text-gray-600">{{ Str::limit($post->content, 100) }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <div class="text-xs text-gray-500">
                            By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($post->status === 'published') bg-green-100 text-green-800
                            @elseif($post->status === 'draft') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View all posts →
            </a>
        </div>
    @else
        <div class="text-center py-8">
            <div class="text-gray-500 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <p class="text-gray-500 mb-4">No posts yet. Create your first post!</p>
            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Post
            </a>
        </div>
    @endif
</div>