// Parallax Scrolling
function checkScroll(e) {
    const banner = document.querySelector(".l-banner");
    return banner.style.top = ((e.pageY/4) * -1) + "px";
}

window.addEventListener("scroll", checkScroll);