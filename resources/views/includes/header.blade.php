
<div class="header">
    <h2><a href="/">C2-CodeCamp</a></h2>
    <div class="categoryDropdown">
        <button class="dropbtn" id="categoryDropdownBtn">Categories</button>
        <div class="dropDown-content" id="dropDownContent">
           @foreach($categories as $category)
                <a class="categoryDropdownItemBtn" href="{{ $category->getFullPath() }}" >{{ $category["title"] }}</a>
            @endforeach
        </div>
    </div>
</div>




