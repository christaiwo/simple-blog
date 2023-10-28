@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <div class="form-group">
                <label for="title">Blog Title</label>
                <input type="text" class="form-control mb-3 @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="summary">Summary</label>
                <input type="text" class="form-control mb-3 @error('summary') is-invalid @enderror" id="summary" name="summary" value="{{ old('summary') }}">
                @error('summary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control mb-3 @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}">
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="image">Image</label>
                <div class="custom-file mb-3" style="border: 1px solid #ccc; padding: 5px;">
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <div class="form-group">
                <label for="blogText">Blog Text</label>
                <input name="blogText" id="inp_htmlcode" type="hidden" value="{{ old('blogText') }}" />
                <div id="div_editor1" class="richtexteditor @error('blogText') is-invalid @enderror" style="width: 100%;margin:0 auto;">
                    {!! old('blogText') !!}
                </div>
                {{-- <div id="editor"></div> --}}
                @error('blogText')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </form>
    </div>
    
</div>

@endsection

@section('footer-script')
     <!-- Plugins js -->
     <script src="{{ url('/public/libs/quill/quill.min.js') }}"></script>

     <!-- Init js-->
     <script src="{{ url('/public/js/pages/form-quilljs.init.js') }}"></script>
 
     <script>
         var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
         editor1.attachEvent("change", function () {
             document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
         });
     </script>
@endsection