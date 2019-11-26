var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
      comment.value = "";
      modal.style.display = "none";
      var div = document.querySelectorAll("[data-img='" + imagePath + "']")[0];
      var span = document.createElement('span');
      span.innerHTML = xhr.responseText + ": " + escapeHtml(com);
      span.setAttribute("class","comment");
      div.appendChild(span);
    }
  };
  xhr.open("POST", "./forms/comment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("img=" + imagePath + "&comment=" + com);
}