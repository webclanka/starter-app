<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                            <div class="flex items-center mt-2 space-x-4">
                                <span class="text-sm text-gray-500">By {{ $post->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $post->created_at->format('M j, Y') }}</span>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($post->status === 'published') bg-green-100 text-green-800
                                    @elseif($post->status === 'draft') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>
                        </div>
                        
                        @if($post->user_id === auth()->id())
                            <div class="space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Edit
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <div class="prose max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                    
                    <div class="mt-8 pt-6 border-t">
                        <a href="{{ route('posts.index') }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            ← Back to posts
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>