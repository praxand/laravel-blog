<x-guest-layout>
    <div class="py-12 px-6 container mx-auto lg:max-w-screen-sm">
        <div class="flex flex-col items-center">
            <img src="@if(Storage::exists('public/images/profile_pictures/' . $user->image_path))
            {{ Storage::url('images/profile_pictures/' . $user->image_path) }}
            @else
            {{ Storage::url('images/profile_pictures/default.jpg') }}
            @endif" alt="Profile Picture" class="rounded-full object-cover shadow-2xl h-48 w-48">

            <h1 class="text-3xl font-bold mt-4">{{ $user->name }} {{ $user->admin ? '(Admin)' : '' }}</h1>
        </div>

        @auth
        @if (Auth::user()->id === $user->id)
        <h1 class="text-2xl font-bold mt-4">Drafts:</h1>

        @foreach ($draftedPosts as $post)
        <a class="bg-white block border w-full mb-10 p-5 rounded" href="{{ route('posts.show', $post->slug) }}">
            <img src="@if ( $post->image_path !== null)
                {{ Storage::url('images/posts/' . $post->image_path) }}
            @else
                {{ Storage::url('images/posts/default.jpg') }}
            @endif" alt="{{ $post->image_path }}" class="w-full h-64 object-cover">

            <div class="flex flex-col justify-between flex-1">
                <h2 class="my-6 text-xl font-semibold">{{ $post->title }}</h2>
                <p class="mb-6 leading-loose">{{ $post->excerpt }}</p>

                <div class="flex items-center text-sm">
                    <img src="@if(Storage::exists('public/images/profile_pictures/' . $post->user->image_path))
                        {{ Storage::url('images/profile_pictures/' . $post->user->image_path) }}
                        @else
                        {{ Storage::url('images/profile_pictures/default.jpg') }}
                        @endif" alt="{{ $post->user->image_path }}" class="rounded-full shadow-lg w-10 h-10">
                    <span class="ml-2">{{ $post->user->name }}</span>
                    <span class="ml-auto">{{ $post->published_at->toFormattedDateString() }}</span>
                </div>
            </div>
        </a>
        @endforeach
        {{ $draftedPosts->onEachSide(0)->links() }}
        @endif
        @endauth
    </div>
</x-guest-layout>
