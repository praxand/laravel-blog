<x-guest-layout>
    <div class="py-12 px-6 container mx-auto lg:max-w-screen-sm">
        <h1 class="mb-5 text-2xl font-semibold">{{ $post->title }}</h1>

        <div class="flex items-center text-sm">
            <span>{{ $post->published_at->toFormattedDateString() }}</span>
            {{-- <p>&nbsp; — &nbsp;</p>
            @foreach ($post->categories as $category)
            {{ route('posts.slugs', $category->slug) }}
            <a href="#" class="mr-1 hover:underline">#{{ $category->name }}</a>
            @endforeach --}}

            <span class="ml-auto flex space-x-2">
                @auth
                <a href="#">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Like
                    </button>
                </a>

                @if (Auth::user()->id === $post->user->id || Auth::user()->admin)
                <a href="{{ route('posts.edit', $post->slug) }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </button>
                </a>
                @endif

                @if (Auth::user()->admin)
                <form action="{{ route('posts.delete', $post->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </form>
                @endif
                @endauth
            </span>
        </div>

        <div class="mt-5 leading-loose flex flex-col justify-center items-center">
            <img src="@if ( $post->image_path !== null)
                {{ Storage::url('images/posts/' . $post->image_path) }}
            @else
                {{ Storage::url('images/posts/default.jpg') }}
            @endif" alt="{{ $post->image_path }}" class="w-full h-64 object-cover">
            <p class="my-3 font-semibold">{{ $post->excerpt }}</p>
            <p>{!! nl2br($post->body) !!}</p>
        </div>

        <div class="mt-10 flex items-center p-5 border rounded">
            <div class="w-1/6 text-left">
                <img src="@if(Storage::exists('public/images/profile_pictures/' . $post->user->image_path))
                    {{ Storage::url('images/profile_pictures/' . $post->user->image_path) }}
                    @else
                    {{ Storage::url('images/profile_pictures/default.jpg') }}
                    @endif" alt="{{ $post->user->image_path }}" class="rounded-full shadow-lg w-32">
            </div>

            <div class="pl-5 leading-loose text-left w-5/6">
                <div class="flex items-center text-sm">
                    <div>
                        By <span class="font-bold">
                            <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>
                        </span>
                        <div class="text-sm">
                            <p>{{ $post->likes->count() }} Likes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="border-t my-8">
        <div class="container mx-auto px-5 lg:max-w-screen-sm mt-14">
            <p>{{$post->comments->count()}} Comments</p>
    @foreach ($post->comments as $comment)
    <div class="my-3">
        <p class="text-md font-semibold">{{ $comment->user->name }}</p>
        <p>{{ $comment->body }}</p>
    </div>
    @endforeach
    </div>
    </div> --}}
</x-guest-layout>
