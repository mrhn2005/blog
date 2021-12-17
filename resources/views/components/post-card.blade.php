<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('posts.show', [ 'post'=> $post->id ]) }}">
        <img class="rounded-t-lg" src="{{asset($post->image_full_url)}}" alt="{{$post->title}}" />
    </a>
    <div class="p-5">
        <a href="{{ route('posts.show', [ 'post'=> $post->id ]) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$post->title}}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$post->excerpt}}</p>
        <a href="{{ route('posts.show', [ 'post'=> $post->id ]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{__('Read more')}}
        </a>
        @can('update', $post)
        <a href="{{ route('posts.edit', [ 'post'=> $post->id ]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
            {{__('Edit')}}
        </a>
        @endcan
        @can('delete', $post)
            <form class="inline-flex" method="POST" action="{{ route('posts.destroy', [ 'post'=> $post->id ]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    {{__('Delete')}}
                </button>
            </form>

        @endcan
    </div>
</div>
