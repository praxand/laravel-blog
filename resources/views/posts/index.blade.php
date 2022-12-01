<x-layout>
    <div class="container mx-auto px-5 lg:max-w-screen-sm">
        @foreach ($posts as $post)
        @if ($post->status == 'published')
        <a class="block border w-full mb-10 p-5 rounded" href="{{ $post->slug }}">
            <img src="{{ $post->image_path }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">

            <div class="flex flex-col justify-between flex-1">
                <h2 class="my-6 text-xl font-semibold">{{ $post->title }}</h2>
                <p class="mb-6 leading-loose">{{ $post->excerpt }}</p>

                <div class="flex items-center text-sm">
                    <img src="{{ $post->user->image_path }}" alt="{{ $post->user->name }}"
                        class="w-10 h-10 rounded-full">
                    <span class="ml-2">{{ $post->user->name }}</span>
                    <span class="ml-auto">{{ $post->published_at->toFormattedDateString() }}</span>
                </div>
            </div>
        </a>
        @endif
        @endforeach
    </div>
</x-layout>
