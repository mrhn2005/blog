<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" onsubmit="setEditorText()">
            @csrf

            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="editor" :value="__('Content')" />
                <textarea name="content" name="content" style="display:none" id="hiddenArea"></textarea>
                <div id="editor" style="height:500px;" > {!! old('content') !!} </div>
            </div>

            <div class="mt-4">
                <x-label for="image" :value="__('Image')" />
                <x-input id="image" accept="image/png, image/jpeg" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    @include('packages.quill')
</x-app-layout>
