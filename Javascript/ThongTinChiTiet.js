const minus = document.querySelector(".content .detail .product-info .number .minus");
const plus = document.querySelector(".content .detail .product-info .number .plus");
const input = document.querySelector(".content .detail .product-info .number input");

minus.addEventListener('click', () => {
    var num = parseInt(input.value);
    if (num == 1)
        input.value = 1;
    else
        input.value = num - 1;
})

plus.addEventListener('click', () => {
    var num = parseInt(input.value);
    input.value = num + 1;
})

