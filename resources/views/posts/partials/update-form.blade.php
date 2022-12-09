<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update blog post') }}
        </h2>
    </header>

    <form method="post" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data"
        class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                :value="old('title', $post->title)" required autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $post->slug)"
                required autocomplete="slug" />
            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
        </div>

        <div>
            <x-input-label for="excerpt" :value="__('Excerpt')" />
            <x-textarea-input id="excerpt" name="excerpt" cols="30" rows="5" class="mt-1 block w-full" required>
                {{ old('excerpt', $post->excerpt) }}
            </x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('excerpt')" />
        </div>

        <div>
            <x-input-label for="body" :value="__('Body')" />
            <x-textarea-input id="body" name="body" cols="30" rows="10" class="mt-1 block w-full" required>
                {{ old('body', $post->body) }}
            </x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('body')" />
        </div>

        <div>
            <x-input-label for="image_path" :value="__('Image')" />
            <x-file-input id="image_path" name="image_path" type="file" class="mt-1 block" />
            <x-input-error class="mt-2" :messages="$errors->get('image_path')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-dropdown-input id="status" name="status" class="mt-1 block w-full" required>
                <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>
                    {{ __('Draft') }}
                </option>
                <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>
                    {{ __('Published') }}
                </option>
                <option value="deleted" {{ old('status', $post->status) === 'deleted' ? 'selected' : '' }}>
                    {{ __('Deleted') }}
                </option>
            </x-dropdown-input>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
