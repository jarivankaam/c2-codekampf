
(function setTime(){
    let today  = new Date();
    $('#time-el').html(today.toLocaleString('nl-NL'));
    setTimeout(setTime, 1);
})();


$('#open-chatbox').click( function(){
    $('.chatbox-container').css("visibility", "visible");
    $('#open-chatbox').css("visibility", "hidden");
});
$('#close-chatbox').click(function (){
    $('.chatbox-container').css("visibility", "hidden");
    $('#open-chatbox').css("visibility", "visible");
});

