<div>
    <div class="space-y-4">
        <div class="flex space-x-4">
            <div class="flex-1">
                <input type="text" 
                       wire:model.live="search" 
                       placeholder="Start typing to search..."
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <select wire:model="searchType" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="posts">Posts</option>
                <option value="users">Users</option>
            </select>
        </div>
        
        @if($search && strlen($search) >= 2)
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 mb-2">Search Results:</h4>
                @if($results->count() > 0)
                    <div class="space-y-2">
                        @foreach($results as $result)
                            @if($searchType === 'posts')
                                <div class="bg-white p-3 rounded border">
                                    <h5 class="font-medium text-gray-900">{{ $result->title }}</h5>
                                    <p class="text-sm text-gray-600">{{ Str::limit($result->content, 100) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">By {{ $result->user->name }}</p>
                                </div>
                            @else
                                <div class="bg-white p-3 rounded border">
                                    <h5 class="font-medium text-gray-900">{{ $result->name }}</h5>
                                    <p class="text-sm text-gray-600">{{ $result->email }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No results found for "{{ $search }}"</p>
                @endif
            </div>
        @elseif($search && strlen($search) < 2)
            <p class="text-gray-500 text-sm">Type at least 2 characters to search...</p>
        @endif
    </div>
</div>