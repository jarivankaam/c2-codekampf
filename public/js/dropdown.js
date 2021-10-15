document.getElementById("categoryDropdownBtn").addEventListener("click", function() {
    document.getElementById("dropDownContent").classList.toggle("show");
});

window.addEventListener("click", function(event) {
    if(!event.target.matches('.dropbtn') && !event.target.matches('.dropDown-content') && !event.target.matches('.categoryDropdownItemBtn')){
        document.getElementById("dropDownContent").classList.remove("show");
    }
});
