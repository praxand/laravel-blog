<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create new blog post') }}
        </h2>
    </header>

    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" required autocomplete="slug" />
            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
        </div>

        <div>
            <x-input-label for="excerpt" :value="__('Excerpt')" />
            <x-textarea-input id="excerpt" name="excerpt" cols="30" rows="5" class="mt-1 block w-full" required />
            <x-input-error class="mt-2" :messages="$errors->get('excerpt')" />
        </div>

        <div>
            <x-input-label for="body" :value="__('Body')" />
            <x-textarea-input id="body" name="body" cols="30" rows="10" class="mt-1 block w-full" required />
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
                <option value="draft">
                    {{ __('Draft') }}
                </option>
                <option value="published">
                    {{ __('Published') }}
                </option>
                <option value="deleted">
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
