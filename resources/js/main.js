
(function setTime(){
    let today  = new Date();
    $('#time-el').html(today.toLocaleString('nl-NL'));
    setTimeout(setTime, 1);
})();

