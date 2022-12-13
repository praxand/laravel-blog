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
                <form action="{{ route('posts.like', $post->slug) }}" method="post">
                    @csrf

                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        @if ($post->likes->contains('user_id', Auth::user()->id))
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path
                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        @endif
                    </button>
                </form>

                @if (Auth::user()->id === $post->user->id || Auth::user()->admin)
                <a href="{{ route('posts.edit', $post->slug) }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </button>
                </a>

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
