// ĐÂY LÀ CODE MẪU ĐỂ LÀM PHẦN CHỌN NHIỀU DỊCH VỤ VÀ TÍNH TỔNG TIỀN
const servicesSelect = document.getElementById("services");
const totalSpan = document.getElementById("total");

servicesSelect.addEventListener("change", () => {
  let total = 0;
  Array.from(servicesSelect.selectedOptions).forEach(option => {
    const price = parseFloat(option.getAttribute("data-price"));
    total += price;
  });
  totalSpan.textContent = total.toLocaleString(); // format số đẹp
});