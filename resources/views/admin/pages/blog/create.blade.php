
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-rss-square"></i>
    Blog
</h4>
  
@stop

@section('content')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
      <div class="col-md-12 col-lg-8">
        <h1 class="h2 mb-4">Submit issue</h1>
        <label>Describe the issue in detail</label>
        <form action="{{route('blog.store')}}">
            <textarea id="editor"></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>


<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script>


@stop