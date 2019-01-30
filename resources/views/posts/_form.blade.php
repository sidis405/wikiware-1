<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}">
</div>
<div class="form-group">
    <label>Preview</label>
    <textarea name="preview" id="" cols="30" rows="3" class="form-control">{{ old('preview', $post->preview) }}</textarea>
</div>

<div class="form-group">
    <label>Body</label>
    <textarea name="body" id="" cols="30" rows="7" class="form-control">{{ old('body', $post->body) }}</textarea>
</div>

<div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control">
        <option></option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @if($category->id == old('category_id', $post->category_id)) selected="" @endif >{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Tags</label>
    <select name="tags[]" class="form-control" multiple="">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}"
                @if(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())))
                    selected=""
                @endif
                >{{ $tag->name }}</option>
        @endforeach
    </select>
</div>
