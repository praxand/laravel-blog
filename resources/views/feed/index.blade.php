<?xml version="1.0" encoding="UTF-8" ?>

<rss version="2.0">
    <channel>
        <title>Laravel Blog</title>
        <link>https://127.0.0.1:8000</link>

        @foreach ($posts as $post)
        <item>
            <title>
                <![CDATA[ {{ $post->title }} ]]>
            </title>

            <link rel="alternate" href="{{ route('posts.show', $post->slug) }}" />

            <id>{{ route('posts.show', $post->slug) }}</id>

            <author>
                <name>{{ $post->user->name }}</name>
            </author>

            <summary type="html">
                <![CDATA[ {{ $post->excerpt }} ]]>
            </summary>

            <updated>{{ $post->updated_at->toRssString() }}</updated>
        </item>
        @endforeach
    </channel>
</rss>
