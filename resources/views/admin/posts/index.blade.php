@extends('layouts.admin')

@section('content')
    <div class="container">

        @if (Session::get('message') != Null)
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
        @endif
    
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>
                    <div class="panel-body">
                        <a href="{{ url('/posts/create') }}" class="btn btn-success btn-sm" title="Add New Post">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                  
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Posted On</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ date('d F Y', strtotime($post->created_at)) }}</td>
                                        <td>
                                            <a title="Read article" href="{{ route('posts.show', ['id'=> $post->id]) }}" class="btn btn-primary"><span class="fa fa-newspaper-o"></span></a>
                                            <a title="Edit article" href="{{ route('posts.edit', ['id'=> $post->id]) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                                            <button title="Delete article" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_article_{{ $post->id  }}"><span class="fa fa-trash-o"></span></button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    @foreach($posts as $post)
        <div class="modal fade" id="delete_article_{{ $post->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <form class="" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-red">
                            <h4 class="modal-title" id="mySmallModalLabel">Delete article</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            Are you sure to delete article: <b>{{ $post->title }} </b>?

                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('/') }}">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            </a>
                            <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
    
@endsection