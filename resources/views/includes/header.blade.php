
<div class="header">


    <h2><a href="/">C2-CodeCamp</a></h2>
    <div class="Mydropdown">
        <button onclick="dropdownJS()" class="dropbtn">Categories</button>
        <div class="dropDown-content" id="dropDownContent">
           @foreach($categories as $category)
                <a href="{{ route("category", $category["slug"]) }}" >{{$category["slug"]}}</a>
            @endforeach
        </div>
    </div>
</div>




