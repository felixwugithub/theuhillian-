

function show(evt, section) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(section).style.display = "block";
    evt.currentTarget.className += " active";
}



function showForm(form){
    document.getElementById(form).style.display = "block";
}

function showFormScroll(form){
    showForm(form);
    setTimeout(function(){
        scrollToBottomWithSection(form);
    },0);

}

function returnScrollComment(x, section){
    window.scrollTo(0, document.body.scrollHeight);
}

function getOffset(el) {
    const rect = el.getBoundingClientRect();
    return {
        left: rect.left + window.scrollX,
        top: rect.top + window.scrollY
    };
}


function scrollToBottomWithSection(sectionIndex){
    setTimeout(function(){
        window.scrollTo(0, getOffset(sectionIndex).top);
    },0);
}


function showFormAndScroll(section, sectionIndex){
    showForm(section);
    scrollToBottomWithSection(sectionIndex);
}
