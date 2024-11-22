

let page2 = document.getElementById('page2');
let page1 = document.getElementById('page1');
page2.style.display = "none";
function displayPage2(){

    page1.style.display = "none";
    page2.style.display = "block";
    console.log("redirecting to page 2");
     
}

function displayPage1(){
    
    page2.style.display = "none";
    page1.style.display = "block";

    console.log("redirecting to page 1")
   

}