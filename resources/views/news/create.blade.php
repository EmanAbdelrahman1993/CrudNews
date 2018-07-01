@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">News</div>
                    <div class="panel-body">
                        <a href="{{url('news')}}" class="btn btn-primary for pull-right">Back</a>
                        </br>
        <form class="form-control" method="post" action="{{url('news')}}" enctype="multipart/form-data">
            @csrf

            {{--{{old('title')}}--}}
            <div class="form-control">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}"/>
            </div>

            <div class="form-control">
                <label>Description</label>
                <input type="text"  class="form-control" name="description" value="{{old('description')}}"/>
            </div>

            <div class="form-control">
                <label>Content</label>
                <textarea name="content" class="form-control" value="{{old('content')}}"></textarea>

            </div>
            <div class="form-control">
                <label>Primary Photo</label>
                <input type="file" class="form-control" name="photo" id="photo">
            </div>

            <div class="form-control">
                <label>Images</label>
                <input type="file" class="form-control" name="images[]" id="images[]" multiple>
            </div>
            <input type="submit" class="btn btn-success form-control" value="Add" />



        </form>

    </div>






@endsection('content')