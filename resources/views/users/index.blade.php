<x-guest-layout>
    <div class="py-12 px-6 container mx-auto lg:max-w-screen-sm">
        <div class="flex flex-col items-center">
            <img src="@if(Storage::exists('public/images/profile_pictures/' . Auth::user()->image_path))
            {{ Storage::url('images/profile_pictures/' . Auth::user()->image_path) }}
            @else
            {{ Storage::url('images/profile_pictures/default.jpg') }}
            @endif" alt="Profile Picture" class="rounded-full object-cover shadow-2xl h-48 w-48">

            <h1 class="text-3xl font-bold mt-4">{{ $user->name }} {{ $user->admin ? '(Admin)' : '' }}</h1>
        </div>
    </div>
</x-guest-layout>
