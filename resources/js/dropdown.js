
function dropdownJS(){
    document.getElementById("dropDownContent").classList.toggle("show");
}

window.onclick = function (event){
    if(!event.target.matches('.dropbtn')){
        var dropdowns = document.getElementsByClassName('dropDown-content');
        var i;

        for(i = 0; i < dropdowns.length; i++){
            var openDropdown = dropdowns[1];
            if (openDropdown.classList.contains('show')){
                openDropdown.classList.remove('show');
            }
        }
    }
}
