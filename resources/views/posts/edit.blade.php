@extends('layouts.auth')

@section('content')

    <div class="left-content">

        <section id="form-section">

            <form action="{{ route('post.store') }}"  method="POST" enctype="multipart/form-data" id="createForm">
                @csrf

                <h1>Edit A post: </h1>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

               
                <input type="text" name="title" 
                        value="{{ old('title') ? old('title') : $post->title }}"
               
                        placeholder="Enter the title ..."
                >


                @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea cols="30" rows="10" name="body">{{ (old('body')) ? old('body') : $post->body  }}</textarea>

                @error('img')
                    <div class="alert alert-danger">{{ $message }}</div>    
                @enderror

                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
                
                <select name="category_id" id="">
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>

                <input type="file" name="img">
                @if($post->img != 'null')
                <img src="{{asset('storage') . '/' . $post->img}}"/>
                @endif
                <input type="submit" value="Save">

            </form>

        </section>


    </div>

    @include('includes.authAside')
@endsection