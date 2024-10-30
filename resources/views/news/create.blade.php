@extends('master.main')

@section('main')
<div>
    <div class="card">
        <div class="card-body shadow">
            <h3 class="fw-bold">
                Create News Post
            </h3>
            <hr>
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="hidden" id="status" name="status" value="1">
                </div>
            
                <!-- Translations Add -->
                <div id="translations-container">
                    <div class="translation-group">
                        <label for="translations[0][lang_id]">Language: </label>
                        <input class="form-control" type="text" name="translations[0][lang_id]" >
            
                        <label for="translations[0][title]">Title: </label>
                        <input class="form-control" type="text" name="translations[0][title]" >
            
                        <label for="translations[0][content]">Content: </label>
                        <textarea class="form-control" name="translations[0][content]">{{ old('translations[0][content]') }}</textarea>
                    </div>
                    <button id="add-translation" type="button" class="btn btn-primary mt-2">Add Translation</button>
                </div>
                <hr>
                <div>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-dark">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let translationIndex = 1;
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