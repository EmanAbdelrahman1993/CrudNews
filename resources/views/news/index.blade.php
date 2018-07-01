@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class=" card-header">News Index  <center><a href="{{url('news/create')}}" class="btn btn-primary">Add News</a></center></div>

                    <table class="table table-bordered table-responsive-sm table-hover">

                        <thead>
                        <tr>
                            <td>Title</td>
                            <td>Add By</td>
                            <td>photo</td>
                            <td>description</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_news as $news)
                            <tr>
                                <td>{{$news->title}}</td>
                                <td>{{$news->addBy->name}}</td>
                                <td><img src="{{url('storage/app/'.$news->photo)}}" style="width: 50px; height: 50px;"/></td>
                                <td>{{$news->description}}</td>
                                <td>
                                    <a href="{{url('news/'.$news->id.'/edit')}}" class="btn btn-primary">Edit</a>
                                    <form method="post" action="{{url('news/'.$news->id)}}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="submit" value="delete" class="btn btn-danger"/>
                                    </form>
                                    {{--<a href="{{url('news/destroy/'.$news->id)}}" class="btn btn-danger" role="button">Delete</a>--}}
                                {{----}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <center>
                    {{$all_news->links()}}
                </center>
            </div>
        </div>
    </div>







@endsection('content')