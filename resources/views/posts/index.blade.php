<x-app-layout>
    <x-slot name="header">
        <form method="GET" action="{{ route('posts.index') }}">
            <x-input id="search" class="mt-3" type="text" name="q" value="{{request()->input('q')}}" required />
            <x-button class="ml-3">
                    {{ __('Search') }}
            </x-button>
        </form>
    </x-slot>
    @can('create', \App\Models\Post::class)
    <div class="py-6 mx-auto items-center text-center">
        <a href="{{route('posts.create')}}" class="inline-flex items-center px-3 py-2 text-lg font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{__('Create new post')}}
        </a>
    </div>
    @endcan
    @if ($posts->count() === 0 )
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{__('There is no post with selecting filters.')}}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
        @foreach ($posts as $post)
            <x-post-card :post="$post"/>
        @endforeach
        </div>
        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                {{ $posts->links() }}
            </div>
        </div>
    @endif
</x-app-layout>
