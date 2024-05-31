let menu = document.querySelector(".header .nav .menu");

document.querySelector("#menu-btn").onclick = () => {
  menu.classList.toggle("active");
};

window.onscroll = () => {
  menu.classList.remove("active");
};

document.querySelectorAll('input[type="number"]').forEach((inputNumber) => {
  inputNumber.oninput = () => {
    if (inputNumber.value.length > inputNumber.maxlength)
      inputNumber.value = inputNumber.value.slice(0, inputNumber.maxlength);
  };
});

document.querySelectorAll('input[type="number"]').forEach((inputnumber) => {
  inputnumber.oninput = () => {
    if (inputnumber.value.length > inputnumber.maxlength)
      inputnumber.value = inputnumber.value.slice(0, inputnumber.maxlength);
  };
});

let filter = document.querySelector('.filter-search');

document.querySelector("#open-filter").onclick = () => {
  filter.classList.add('active');
};