//GALLERY SCRIPT
//selecting all required elements
/*

const filterItem = document.querySelector(".items");
const filterImg = document.querySelectorAll(".gallery .box-card");
    window.onload = ()=>{ //after window loaded
        filterItem.onclick = (selectedItem)=>{ //if user click on filterItem div
            if(selectedItem.target.classList.contains("item")){ //if user selected item has .item class
            filterItem.querySelector(".active").classList.remove("active"); //remove the active class which is in first item
            selectedItem.target.classList.add("active"); //add that active class on user selected item
            let filterName = selectedItem.target.getAttribute("data-name"); //getting data-name value of user selected item and store in a filtername variable
            filterImg.forEach((image) => {
                let filterImges = image.getAttribute("data-name"); //getting image data-name value
                //if user selected item data-name value is equal to images data-name value
                //or user selected item data-name value is equal to "all"
                if((filterImges == filterName) || (filterName == "all")){
                    image.classList.remove("hide"); //first remove the hide class from the image
                    image.classList.add("show"); //add show class in image
                }else{
                    image.classList.add("hide"); //add hide class in image
                    image.classList.remove("show"); //remove show class from the image

                }
            });
            }
        }

        for(let index = 0; index < filterImg.length; index++){
            filterImg[index].setAttribute("onclick", "preview(this)"); //adding onclick in images
        }
    }

//selecting all required elements
    const previewBox = document.querySelector(".preview-box"),
    previewImg = previewBox.querySelector("img"),
    categoryName = previewBox.querySelector(".title p"),
    closeIcon = previewBox.querySelector(".icon"),
    shadow = document.querySelector(".shadow");

//function to fullscreen
function preview(element){
    document.querySelector("body").style.overflow = "hidden"; //once click on any image remove the scrollbar of the body
    let selectedPrevImg = element.querySelector(".box-card").src;//getting user clicked to open book
    let selectedImgCategory = element.getAttribute("data-name");//getting data-name value
    categoryName.textContent = selectedImgCategory; //passing the data-name value to variable category
    previewImg.src = selectedPrevImg; //passing the user clicked image source in the preview source
    previewBox.classList.add("show"); //show book
    shadow.classList.add("show"); //show light grey bg
    closeIcon.onclick = () =>{ //user click in close icon in the book
        previewBox.classList.remove("show"); //closed book
        shadow.classList.remove("show"); //remove light grey bg
        document.querySelector("body").style.overflow = "scroll"; //show the scrollbar in the body
    }
}
*/

const btnBurguer = document.querySelector('[data-anime="hamburguer"]')
//function open and closed menu burguer
$('nav ul li.btn span').click(function(){
    $('nav ul div.items-nav').toggleClass("show-navmenu")
    $('nav ul li.btn span').toggleClass("show-navmenu")
});

btnBurguer.addEventListener('click', openMenu)

//END GALLERY SCRIPT
