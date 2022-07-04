
$( window ).load(function() {
    var pinMenuStorage;
    pinMenuStorage=window.localStorage.getItem('pinmenu');
    if (pinMenuStorage=="1"){

        openNav();
        document.getElementById("pinButton").style.display="none"
        document.getElementById("unpinButton").style.display="block"

    }

});




function pinMenu(){

    document.getElementById("pinButton").style.display="none"
    document.getElementById("unpinButton").style.display="block"
    window.localStorage.setItem('pinmenu','1');

}

function unpinMenu(){

    document.getElementById("pinButton").style.display="block"
    document.getElementById("unpinButton").style.display="none"
    localStorage.removeItem('pinmenu');

}


function openNav() {
    document.getElementById("mySidebar").style.width = "200px";
    document.getElementById("onMouseOverSideBar").style.display = "none";
    document.getElementById("onMouseOverSideBar").style.zIndex = "0";
    document.getElementById("onMouseOverSideBar").style.width = "0px";

    setTimeout(function () {

        document.getElementById("panelAdmin").style.display = "block"
    }, 350);



}

function closeNav() {

    var pinMenuStorage;
    pinMenuStorage=window.localStorage.getItem('pinmenu');


    if (pinMenuStorage!=="1") {
        setTimeout(function () {


            document.getElementById("mySidebar").style.width = "0px";
            document.getElementById("panelAdmin").style.display = "none"


            setTimeout(function () {
                document.getElementById("onMouseOverSideBar").style.display = "block";
                document.getElementById("onMouseOverSideBar").style.zIndex = "5";
                document.getElementById("onMouseOverSideBar").style.width = "30px";

            }, 200);
        }, 500);
    }


}



var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
       /* this.classList.toggle("activeSideBar");*/
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

var dropdownaudio = document.getElementsByClassName("dropdown-btn-audio");
var i;

for (i = 0; i < dropdownaudio.length; i++) {
    dropdownaudio[i].addEventListener("click", function() {
        /* this.classList.toggle("activeSideBar");*/
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

