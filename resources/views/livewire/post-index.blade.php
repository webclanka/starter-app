<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
        <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Create Post
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" id="search" wire:model.live="search" placeholder="Search posts..." 
                       class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" wire:model.live="status" 
                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">All Statuses</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Posts Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        @if($posts->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($posts as $post)
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-medium text-indigo-600 truncate">
                                        {{ $post->title }}
                                    </p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($post->status === 'published') bg-green-100 text-green-800
                                            @elseif($post->status === 'draft') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($post->status) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="text-sm text-gray-500">
                                            {{ Str::limit($post->content, 100) }}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        <p>
                                            By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 flex space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                    Edit
                                </a>
                                @if($post->user_id === auth()->id())
                                    <button wire:click="deletePost({{ $post->id }})" 
                                            wire:confirm="Are you sure you want to delete this post?"
                                            class="text-red-600 hover:text-red-900 text-sm font-medium">
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="px-6 py-3 border-t border-gray-200">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No posts found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if($search || $status)
                        No posts match your current filters.
                    @else
                        Get started by creating your first post.
                    @endif
                </p>
                <div class="mt-6">
                    <a href="{{ route('posts.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Post
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>