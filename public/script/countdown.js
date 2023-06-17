storage = window.sessionStorage;
// if (!storage.getItem('time')) {
    storage.setItem('time', 7200);
    // storage.setItem('time', 10);
// }

var total_seconds = parseInt(storage.getItem('time'));
var c_hour = parseInt(total_seconds / 3600),
    c_minutes = parseInt(total_seconds / 60 % 60 ),
    c_second = parseInt(total_seconds % 60);

function countdown(){
    document.getElementById("countdown").innerHTML = total_seconds;
    $("#countdown").html(total_seconds);
    $("#countdown").html(c_hour + " : " + c_minutes + " : " + c_second);
    if (total_seconds <= 0) {
        var examForm = document.getElementById("examForm");
        var finishedField = document.createElement('input');
        finishedField.setAttribute('type', 'hidden');                    
        finishedField.setAttribute('name', 'submit');                    
        finishedField.setAttribute('value', 'finished');
        examForm.appendChild(finishedField);
        
        document.getElementById("examForm").submit();
        storage.removeItem('time');
    } else {
        total_seconds -= 1;
        c_hour = parseInt(total_seconds / 3600),
        c_second = parseInt(total_seconds % 60),
        c_minutes = parseInt(total_seconds / 60 % 60 );
    }
    storage.setItem('time', total_seconds);
}
setInterval(countdown, 1000);

function preventBack() {
    window.history.forward(); 
}
setTimeout("preventBack()", 0);

window.onunload = function () { null };