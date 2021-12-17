<x-app-layout>
    <x-slot name="header">
        <div class="text-center pt-16 md:pt-32 mt-5">
            <p class="text-sm md:text-base text-green-500 font-bold">{{$post->created_at->diffForHumans()}} <span
                    class="text-gray-900">/</span> {{__('Author')}}: {{$post->user->name}} </p>
            <h1 class="font-bold break-normal text-3xl md:text-5xl">{{$post->title}}</h1>
        </div>
    </x-slot>

    <div class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded"
        style="background-image:url('{{$post->image_full_url}}'); height: 75vh;"></div>

    <div class="container max-w-5xl mx-auto -mt-32">
        <div class="mx-0 sm:mx-6">
            <div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal"
                style="font-family:Georgia,serif;">
                {!! $post->content !!}
            </div>
        </div>
    </div>
</x-app-layout>
