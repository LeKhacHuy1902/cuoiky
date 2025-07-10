
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("profile-btn");
  const dropdown = document.getElementById("profile-dropdown");

  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  });

  document.addEventListener("click", () => {
    dropdown.style.display = "none";
  });
});

