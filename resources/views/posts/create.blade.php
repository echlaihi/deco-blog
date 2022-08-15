@extends('layouts.auth')

@section('content')

    <div class="left-content">

        <section id="form-section">

            <form action="{{ route('post.store') }}"  method="POST" enctype="multipart/form-data" id="createForm">
                @csrf

                <h1>Create A post: </h1>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="text" name="title" @if (old('title'))
                        value="{{ old('title') }}"
                @else
                        placeholder="Enter the title ..."
                @endif>


                @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea cols="30" rows="10" name="body" @if(!old('body')) placeholder="Enter the body ..." >@else>{{ old('body') }}@endif</textarea>

                @error('img')
                    <div class="alert alert-danger">{{ $message }}</div>    
                @enderror

                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
                
                <select name="category_id">
                   @foreach($categories as $c)
                        <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                   @endforeach
                </select>

                <input type="file" name="img">
                <input type="submit" value="Save">

            </form>

        </section>


    </div>

    @include('includes.authAside')
@endsection