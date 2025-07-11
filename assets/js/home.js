document.getElementById("reviewForm").addEventListener("submit", function (e) {
    e.preventDefault(); // không reload
    this.style.display = "none"; // ẩn form
    document.getElementById("thankYou").style.display = "block"; // hiện cảm ơn
});

