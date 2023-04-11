//Add requirements as a list

document.getElementById("interested").onclick = function() {
    var text = document.getElementById("interests").value; 
    console.log(text);
    var li ="<li>" + '<span id="dot-icon" class="material-symbols-outlined">fiber_manual_record</span>' + text + "</li>";
    //document.getElementById("list").insertAdjacentHTML('beforeend', li);
    let element = document.getElementById("interests-list");

    element.value += "\n" + text + "\n";
    document.getElementById("interests").value = ""; // clear the value
    document.getElementById("list").style.listStyleType = "square";
  }

  document.getElementById("exp").onclick = function() {
    var text = document.getElementById("experience").value; 
    console.log(text);
    var li ="<li>" + '<span id="dot-icon" class="material-symbols-outlined">fiber_manual_record</span>' + text + "</li>";
    //document.getElementById("list").insertAdjacentHTML('beforeend', li);
    let element = document.getElementById("experience-list");
    element.value += "\n" + text + "\n";
    document.getElementById("experience").value = ""; // clear the value
    document.getElementById("list").style.listStyleType = "square";
  }

  document.getElementById("qual").onclick = function() {
    var text = document.getElementById("qualifications").value; 
    console.log(text);
    var li ="<li>" + '<span id="dot-icon" class="material-symbols-outlined">fiber_manual_record</span>' + text + "</li>";
    //document.getElementById("list").insertAdjacentHTML('beforeend', li);
    let element = document.getElementById("qualifications-list");
    element.value += "\n" + text + "\n";
    document.getElementById("qualifications").value = ""; // clear the value
    document.getElementById("list").style.listStyleType = "square";
  }

  document.getElementById("extra").onclick = function() {
    var text = document.getElementById("extracurricular").value; 
    console.log(text);
    var li ="<li>" + '<span id="dot-icon" class="material-symbols-outlined">fiber_manual_record</span>' + text + "</li>";
    //document.getElementById("list").insertAdjacentHTML('beforeend', li);
    let element = document.getElementById("extracurricular-list");
    element.value += "\n" + text + "\n";
    document.getElementById("extracurricular").value = ""; // clear the value
    document.getElementById("list").style.listStyleType = "square";
  }

  //edit profile form validations

