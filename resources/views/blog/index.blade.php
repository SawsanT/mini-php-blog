@extends('layouts.app')

@section('content')


<div class="background-image grid grid-cols-1 m-auto">
    <div class="flex text-pink-100 pt-10">
        <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
            <h1 class="sm:text-white text-5xl uppercase font-bold
            text-shadow-md pb-14"> Blog posts</h1>

        </div>
    </div>
</div>

@if (session()->has('message'))
<div class="alert success">
    <span class="closebtn">&times;</span>
    <p>
        {{ session()->get('message') }}
    </p>
</div>
@endif

@if (Auth::check())
<div class="pt-15 w-4/5 m-auto">
    <a href="/blog/create"
        class="bg-pink-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
        Create post
    </a>
</div>
@endif
@foreach ($post as $post)
<div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
    <div>
        <img src="{{ asset('images/' . $post->image_path)}}" alt="">
    </div>
    <div>
        <h2 class="text-gray-700 font-bold text-5xl pb-4">
            {{$post->title}}
        </h2>
        <span class="text-gray-500">
            By <span class="font-bold italic text-gray-800">
                {{$post->user->name}}
            </span>, Created on {{date('jS M Y', strtotime($post->updated_at))}}
        </span>

        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
            {{ $post->description }}
        </p>

        <a href="/blog/{{$post->slug}}" class=" bg-pink-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Keep reading</a>

        @if(isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
        <span class="float-right">
            <a href="/blog/{{$post->slug}}/edit" class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2"> Edit
            </a>

        </span>

        <span class="float-right">
            <form action="/blog/{{$post->slug}}" method="POST">
                @csrf
                @method('delete')

                <button class="text-red-500 pr-3" type="submit">
                    Delete
                </button>
            </form>
        </span>
        @endif
    </div>


</div>
</div>
@endforeach

@endsection