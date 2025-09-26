const iconToggle = document.querySelector('.toggle_icon');
const navbarMenu = document.querySelector('.menu');
const menuLinks = document.querySelectorAll('.menu_link');
const iconClose = document.querySelector('.close_icon');
const portfolioTitle = document.querySelector('.portfolio-title');
const header = document.querySelector('header');
const contactForm = document.getElementById('contact-form');

let lastScrollTop = 0;

iconToggle.addEventListener('click', () => {
    navbarMenu.classList.toggle('active');
});

iconClose.addEventListener('click', () => {
    navbarMenu.classList.remove('active');
});

menuLinks.forEach((menuLink) => {
    menuLink.addEventListener('click', () => {
        navbarMenu.classList.remove('active');
    });
});

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        portfolioTitle.textContent = "Jay Sudani";
    } else {
        portfolioTitle.textContent = "Portfolio";
    }

    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {

        header.style.top = "-100px";
    } else {

        header.style.top = "0";
    }
    lastScrollTop = scrollTop;
});

//scroll section active link
const sections = document.querySelectorAll('section[id]');

function scrollActive() {
    const scrollY = window.pageYOffset;

    sections.forEach(section => {
        const sectionHeight = section.offsetHeight;
        const sectionTop = section.offsetTop - 50;

        let sectionId = section.getAttribute('id');
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            document.querySelector(`.menu a[href*=${sectionId}]`).classList.add('active-link');
        } else {
            document.querySelector(`.menu a[href*=${sectionId}]`).classList.remove('active-link');
        }
    })
}
window.addEventListener('scroll', scrollActive);


contactForm.addEventListener('submit', (e) => {
    e.preventDefault();
    sendMail();
});

function sendMail() {
    // Get the form data
    let params = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        subject: document.getElementById("subject").value,
        message: document.getElementById("message").value,
    };

    // Replace with your actual EmailJS Service ID and Template ID
    const serviceID = "service_vftlf6n";
    const templateID = "template_z108le7";

    emailjs.send(serviceID, templateID, params)
        .then(res => {
            // Clear the form
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("subject").value = "";
            document.getElementById("message").value = "";
            window.location.href = "thank-you.html";
        })
        .catch(err => console.log(err));
}

