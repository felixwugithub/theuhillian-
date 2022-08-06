
function show(section) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(section).style.display = "block";
    evt.currentTarget.className += " active";



}

function showForm(form){
    document.getElementById(form).style.display = "block";
}


function returnScrollComment(x, section){

    window.scrollTo(0, document.body.scrollHeight);
}


function scrollToBottomWithSection(section){
    show(section);
    setTimeout(function () {
            alert(section);
    },1500);

    setTimeout(function(){
        window.scrollTo(0, 1500);
    },5000)
    

}
