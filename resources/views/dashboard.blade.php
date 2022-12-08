<x-app-layout>
    <div class="py-12 px-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg h-48">
                    <div class="p-6 text-gray-900">
                        Registered Users: {{ $users->count() }}
                        <p>
                            @foreach ($users as $user)
                            <a href="{{ route('users.show', $user->id) }}" class="hover:underline">{{ $user->name }}
                                {{ $user->admin ? '(Admin)' : '' }}</a>@if(!$loop->last),@endif
                            @endforeach
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg h-48">
                    <div class="p-6 text-gray-900">
                        Categories: {{ $categories->count() }}
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg h-48">
                    <div class="p-6 text-gray-900">
                        Comments: {{ $comments->count() }}
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg h-48">
                    <div class="p-6 text-gray-900">
                        Posts: {{ $posts->count() }}
                        <p>
                            @foreach ($posts as $post)
                            <a href="{{ $post->slug }}"
                                class="hover:underline">{{ $post->title }}</a>@if(!$loop->last),@endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
