const stars = document.querySelectorAll('.star');
const rating = document.querySelector('.rating');
const reviewDescription = document.querySelector('.review-description');
const ratingInput = document.getElementById('rating_input');

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        // rating.setAttribute('data-rating', index + 1);
        const value = star.getAttribute('data-value');
        ratingInput.value = value;
        rating.setAttribute('data-rating', value);
        stars.forEach((s, i) => {
            if (i <= index) {
                s.classList.add('fa-solid');
                s.classList.remove('fa-regular');
            } else {
                s.classList.add('fa-regular');
                s.classList.remove('fa-solid');
            }
        });
    });
});

const dayCheckboxes = document.querySelectorAll('.btn-check-day');
const timeCheckboxes = document.querySelectorAll('.btn-check-time');
const seatCheckboxes = document.querySelectorAll('.btn-check');

dayCheckboxes.forEach((dayCheckbox) => {
  dayCheckbox.addEventListener('change', function () {
    dayCheckboxes.forEach((cb) => {
      if (cb !== dayCheckbox) {
        cb.checked = false;
      }
    });
  });
});

timeCheckboxes.forEach((timeCheckbox) => {
  timeCheckbox.addEventListener('change', function () {
    timeCheckboxes.forEach((cb) => {
      if (cb !== timeCheckbox) {
        cb.checked = false;
      }
    });
  });
});

seatCheckboxes.forEach((seatCheckbox) => {
  seatCheckbox.addEventListener('change', function () {
    seatCheckboxes.forEach((cb) => {
      if (cb !== seatCheckbox) {
        cb.checked = false;
      }
    });
  });
});