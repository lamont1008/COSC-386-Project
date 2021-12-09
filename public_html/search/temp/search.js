/*Collapsible function*/
/*Gets all elements that are classed collapsible*/
var coll = document.getElementsByClassName("collapsible");

/*Loop upto number of collapsible elements in code*/
for (i = 0; i < coll.length; i++) {
	/*Checking for a click event and run the function*/
  coll[i].addEventListener("click", function() {
	  /*Toggle active which just changes color*/
	  if(this.classList.contains("active"))
		  this.classList.remove("active");
	  else
		  this.classList.add("active");
	/*Check the next html element after collapsible class*/
    var content = this.nextElementSibling;
	/*Display content or undisplay*/
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}

function modalDisplay(m, s){
	var modal = document.getElementById(m);
	var span = document.getElementById(s);
	modal.style.display = "block";
		span.onclick = function(){
			modal.style.display = "none";
		}
		window.onclick = function(event) {
			if(event.target === modal) {
				modal.style.display = "none";
			}
		}

}