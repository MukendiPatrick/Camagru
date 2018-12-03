
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    
    document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function check_notif(myCheck) {
  var checkBox = document.getElementById("myCheck");
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../back_end/notifications.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  if (checkBox.checked == true){
      xhr.send("checked=yes");
  } else {
      xhr.send("checked=no");
  }
  xhr.onreadystatechange = function(event) {
    if (this.readyState === 4) {
      if (this.status === 200) {
        if ((this.responseText))
        {
          var div = document.createElement("div");
          var p = document.createElement("p");
          var text2 = document.createTextNode(JSON.parse(this.responseText).success);
          div.className = "alert alert-success";
          p.className = "p_danger";
          p.appendChild(text2);
          div.appendChild(p);
          var alert = document.getElementById("alert");
          alert.appendChild(div);
          var p_success = document.getElementsByClassName("p_danger");
          if (p_success[0]) {
            setTimeout(function() {
              var div = p_success[0].parentElement;
              div.remove();
            }, 2000);
          }
        }
      }
    }
  };
}