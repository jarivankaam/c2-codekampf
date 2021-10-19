const timeEl = document.getElementById("time-el");
(function setTime(){
    let today  = new Date();
    timeEl.textContent = today.toLocaleString('nl-NL');
    setTimeout(setTime, 1000);
})();

