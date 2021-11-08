<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        <title>C2-codecamp</title>
    </head>
    <body>
    @php
        use App\Http\Controllers\HomeController;
        echo HomeController::categoryInclude();
    @endphp
        <div class="wrapper">
            <div class="form-container">
                <form action="{{route('page.store')}}" method="POST">
                    @csrf

                    <div class="form-group full-width">
                        <label>Title:</label><br>
                        <input class="form-input" type="text" name="title">
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label>Naam:</label><br>
                            <input class="form-input" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label>Slug:</label><br>
                            <input class="form-input" type="text" name="slug">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label>Categorie:</label><br>
                            <select class="form-input" name="category">
                                @foreach($categories as $categorie):
                                <option value="{{$categorie->id}}">{{$categorie->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Prijs:</label>
                            <input class="form-input" type="number" name="price">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Kleur:</label><br>
                        <input class="form-color" type="color" name="color">
                    </div>
                    <div class="form-group full-width">
                        <label for="contents">Content:</label>
                        <textarea class="editor-data" id="editorMarkdown" name="contents" readonly></textarea>
                        <div class="form-textarea" id="editor"></div>
                    </div>
                    <div class="form-group full-width">
                        <input class="form-btn" type="submit" value="Submit">
                    </div>

                </form>
            </div>

        </div>

        <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
        <script>
            const { Editor } = toastui;
            const editor = new Editor({
                el: document.querySelector('#editor'),
                initialEditType: 'markdown',
                hideModeSwitch: true,
                previewStyle: 'vertical',
                events: {
                    change: function() {
                        document.querySelector("#editorMarkdown").value = editor.getMarkdown();
                    },
                }
            });
        </script>
    </body>
</html>
