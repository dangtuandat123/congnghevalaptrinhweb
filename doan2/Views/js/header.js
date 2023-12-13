function toggle(element,style) {
    var x = document.querySelector(element);
    if (x.style.display === "none") {
      x.style.display = style;
    } else {
      x.style.display = "none";
    }
    event.stopPropagation();
}