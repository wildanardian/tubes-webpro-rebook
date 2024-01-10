let menu = document.getElementById("subMenu");

function toggleMenu(e) {
    const element = e.target;

    // Jika yang diklik berada di dalam dropdown menu, jangan menutup menu
    if (element.closest(".sub-menu")) {
        return;
    }

    // Jika yang diklik adalah gambar profil (user-pict), toggle menu
    if (element.classList.contains("user-pict")) {
        if (!menu.classList.contains("open-menu")) {
            menu.classList.add("open-menu");
        } else {
            menu.classList.remove("open-menu");
        }
    } else {
        // Jika yang diklik di luar dropdown menu atau bukan gambar profil, tutup menu
        menu.classList.remove("open-menu");
    }
}

document.addEventListener("click", toggleMenu);


let notif = document.getElementById("notifMenu");

function toggleNotif(e) {
    const element = e.target;

    if (element.closest(".notif-menu")) {
        return;
    }

    if (element.classList.contains("notif-pict")) {
        if (!notif.classList.contains("open-notif")) {
            notif.classList.add("open-notif");
        } else {
            notif.classList.remove("open-notif");
        }
    } else {
        notif.classList.remove("open-notif");
    }
}

document.addEventListener("click", toggleNotif);

const cards = document.querySelectorAll(".cardz");
cards.forEach((card) => {
    card.addEventListener("click", () => {
        window.location.href = "detail.html";
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4.5,
        slidesPerGroup: 4.5,
        spaceBetween: 50,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
                slidesPerGroup: 1,
            },
            520: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            },
            1000: {
                slidesPerView: 3,
                slidesPerGroup: 3,
            },
            1280: {
                slidesPerView: 4.5,
            }
        }
    });
});

const userIcon = document.querySelector('.user-pict');
const notifIcon = document.querySelector('.notif-pict');

userIcon.addEventListener('click', toggleUserMenu);
notifIcon.addEventListener('click', toggleNotificationMenu);


document.addEventListener('click', (event) => {
    const subMenu = document.getElementById('subMenu');
    const notifMenu = document.getElementById('notifMenu');

    if (subMenu.classList.contains('open-menu') && !event.target.closest('#subMenu') && event.target !== userIcon) {
        subMenu.classList.remove('open-menu');
    }

    if (notifMenu.classList.contains('open-notif') && !event.target.closest('#notifMenu') && event.target !== notifIcon) {
        notifMenu.classList.remove('open-notif');
    }
});
function toggleCardInfo(cardId) {
    const card = document.querySelector(`[data-toggle="${cardId}"]`);
    const details = card.querySelector('.details');
    details.classList.toggle('open-details');
}

const restaurantItems = document.querySelector(".cardz");

restaurantItems.addEventListener("click", function () {
    window.location.href = "detail.html";
});