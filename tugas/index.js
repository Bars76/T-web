
document.addEventListener("DOMContentLoaded", function () {
  document.body.style.opacity = 0;
  setTimeout(() => {
    document.body.style.transition = "opacity 1s";
    document.body.style.opacity = 1;
  }, 100);
});

const header = document.querySelector("header h1");
if (header) {
  setInterval(() => {
    header.style.color =
      header.style.color === "crimson" ? "black" : "crimson";
  }, 1000);
}

document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".nav-link");
  const currentPage = window.location.pathname.split("/").pop();

  navLinks.forEach((link) => {
    if (link.getAttribute("href") === currentPage) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
});
