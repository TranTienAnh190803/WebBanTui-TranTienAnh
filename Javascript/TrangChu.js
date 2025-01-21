// Slider
const slider = document.querySelectorAll(".slider .slider-full");

setInterval(() => {
    const active = document.querySelector(".slider .active");
    for (var i = 0; i < slider.length; i++)
    {
        if (active == slider[i])
        {
            if (i == slider.length - 1)
            {
                i = -1;
            }
            active.classList.remove('active');
            slider[i + 1].classList.add('active');
            break;
        }
    }
}, 3000)