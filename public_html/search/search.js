/**
 * 
 * @param {string} cid ID from button 
 * @param {string} divID ID from div to display
 */
function collapse(cid, divID){
	//Gets the element from button and set class
	var coll = document.getElementById(cid);
	if(coll.classList.contains("active"))
		coll.classList.remove("active");
	else
		coll.classList.add("active");

	//Gets the element from html<div> and display
	var content = document.getElementById(divID);
	if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
}

/**
 * 
 * @param {String} m Modal display element ID
 * @param {String} s exit icon X element ID
 */
function modalDisplay(m, s){
	//Gets both modal and span element
	var modal = document.getElementById(m);
	var span = document.getElementById(s);
	//Display modal
	modal.style.display = "block";
		span.onclick = function(){
			modal.style.display = "none";
		}
		//Activate exit
		window.onclick = function(event) {
			if(event.target === modal) {
				modal.style.display = "none";
			}
		}

}

