// Danh mục
const comboBox = document.querySelector(".wrap .add-product form div .combobox");
const discount = document.querySelector(".wrap .add-product form div .discount");

function GiamGia() {
    if (comboBox.value == "Hàng giảm giá")
    {
        discount.setAttribute("required", "true");
        discount.removeAttribute("readonly");
        discount.style.backgroundColor = "white";
    }
    else
    {
        discount.setAttribute("readonly", "true");
        discount.removeAttribute("required");
        discount.style.backgroundColor = "rgba(150, 150, 150, 0.5)";
        discount.value = 0;
    }
    console.log(comboBox.value)
}

window.addEventListener("load", GiamGia());
comboBox.addEventListener("change", () => {
    if (comboBox.value == "Hàng giảm giá")
    {
        discount.setAttribute("required", "true");
        discount.removeAttribute("readonly");
        discount.style.backgroundColor = "white";
    }
    else
    {
        discount.setAttribute("readonly", "true");
        discount.removeAttribute("required");
        discount.style.backgroundColor = "rgba(150, 150, 150, 0.5)";
        discount.value = 0;
    }
});

// Thêm ảnh
const openFile = document.querySelector(".wrap .add-product form div #DangAnh");
const filePath = document.querySelector(".wrap .add-product form div #FilePath");

openFile.addEventListener("change", () => {
    const path = openFile.value;
    const fileName = path.split("\\").pop();
    filePath.value = fileName;
});