@extends('master.main')

@section('main')
<div>
    <div class="card">
        <div class="card-body shadow">
            <h3 class="fw-bold">
                Edit News Post
            </h3>
            <hr>
            <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <input type="hidden" id="status" name="status" value="1">
                </div>
            
                <!-- Translations Edit -->
                <div id="translations-container">
                    @foreach ($post->translations as $index => $translation)
                        <div class="translation-group">
                            <label for="translations[{{ $index }}][lang_id]">Language: </label>
                            <input class="form-control" type="text" name="translations[{{ $index }}][lang_id]" value="{{ $translation->lang_id }}">
            
                            <label for="translations[{{ $index }}][title]">Title: </label>
                            <input class="form-control" type="text" name="translations[{{ $index }}][title]" value="{{ $translation->title }}">
            
                            <label for="translations[{{ $index }}][content]">Content: </label>
                            <textarea class="form-control" name="translations[{{ $index }}][content]">{{ $translation->content }}</textarea>
                        </div>
                    @endforeach
                    <button id="add-translation" type="button" class="btn btn-primary mt-2">Add Translation</button>
                </div>
                <hr>
                <div>
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-dark">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let translationIndex = {{ count($post->translations) }};
    $('#add-translation').click(function() {
        const newTranslation = `
            <div class="translation-group">
                <label for="translations[${translationIndex}][lang_id]">Language ID</label>
                <input class="form-control" type="text" name="translations[${translationIndex}][lang_id]">

                <label for="translations[${translationIndex}][title]">Title</label>
                <input class="form-control" type="text" name="translations[${translationIndex}][title]">

                <label for="translations[${translationIndex}][content]">Content</label>
                <textarea class="form-control" name="translations[${translationIndex}][content]"></textarea>
            </div>
        `;
        $('#add-translation').before(newTranslation);
        translationIndex++;
    });
</script>
@endsection
