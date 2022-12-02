<x-guest-layout>
    <div class="container mx-auto px-5 lg:max-w-screen-sm">
        <h1 class="mb-5 text-2xl font-semibold">{{ $post->title }}</h1>

        <div class="flex items-center text-sm">
            <span>{{ $post->published_at->toFormattedDateString() }}</span>
            <p>&nbsp; — &nbsp;</p>
            @foreach ($post->categories as $category)
            {{-- {{ route('posts.slugs', $category->slug) }} --}}
            <a href="#" class="mr-1 hover:underline">#{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="mt-5 leading-loose flex flex-col justify-center items-center">
            <p><img src="{{ $post->image_path }}" alt="{{ $post->image_path }}"></p>
            <p class="my-3 font-semibold">{{ $post->excerpt }}</p>
            <p>{{ $post->body }}</p>
        </div>

        <div class="mt-10 lg:flex items-center p-5 border rounded">
            <div class="w-full lg:w-1/6 text-center lg:text-left">
                <img src="{{ $post->user->image_path }}" alt="{{ $post->user->name }}"
                    class="rounded-full w-32 lg:w-full">
            </div>
            <div class="lg:pl-5 leading-loose text-center lg:text-left w-full lg:w-5/6">

                <div class="flex items-center text-sm">
                    <div>
                        By <span class="font-bold">{{ $post->user->name }}</span>
                        <div class="text-sm">
                            <p>{{ $post->likes->count() }} Likes</p>
                        </div>
                    </div>

                    <span class="ml-auto">
                        <a href="#">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Like
                            </button>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t my-8">
        <div class="container mx-auto px-5 lg:max-w-screen-sm mt-14">
            <p>{{$post->comments->count()}} Comments</p>
            @foreach ($post->comments as $comment)
            <div class="my-3">
                <p class="text-md font-semibold">{{ $comment->user->name }}</p>
                <p>{{ $comment->body }}</p>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
