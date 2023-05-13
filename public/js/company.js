//Add requirements as a list

document.getElementById("addreq").onclick = function() {
    var text = document.getElementById("requirements").value; 
    console.log(text);
    var li ="<li>" + '<span id="dot-icon" class="material-symbols-outlined">fiber_manual_record</span>' + text + "</li>";
    //document.getElementById("list").insertAdjacentHTML('beforeend', li);
    let element = document.getElementById("requirements-list");
    element.value += text + "\n";
    document.getElementById("requirements").value = ""; // clear the value
    document.getElementById("list").style.listStyleType = "square";
  }