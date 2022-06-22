@csrf
<div class="form-group">
    <label for="title">Title</label>
    <input id="title" class="form-control" type="text" name="title" value="{{old('title', optional($post ?? null)->title)}}">
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" id="content" name="content"  cols="30" rows="10">{{old('content', optional($post ?? null)->content)}}</textarea>
</div>

@errors @enderrors

