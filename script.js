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

// View All Projects Toggle
const viewAllBtn = document.getElementById('view-all-projects');
const projectsGrid = document.getElementById('projects-grid');

if (viewAllBtn && projectsGrid) {
    viewAllBtn.addEventListener('click', () => {
        projectsGrid.classList.toggle('show-all');
        if (projectsGrid.classList.contains('show-all')) {
            viewAllBtn.textContent = 'See Less';
        } else {
            viewAllBtn.textContent = 'View All Projects';
        }
    });
}

/*=============== DARK LIGHT THEME ===============*/
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'fa-sun'

// Previously selected topic (if user selected)
const selectedTheme = localStorage.getItem('selected-theme')
const selectedIcon = localStorage.getItem('selected-icon')

// We obtain the current theme that the interface has by validating the dark-theme class
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'fa-moon' : 'fa-sun'

// We validate if the user previously chose a topic
if (selectedTheme) {
    // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
    document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
    themeButton.classList[selectedIcon === 'fa-moon' ? 'add' : 'remove'](iconTheme)
}

// Activate / deactivate the theme manually with the button
themeButton.addEventListener('click', () => {
    // Add or remove the dark / icon theme
    document.body.classList.toggle(darkTheme)
    themeButton.classList.toggle(iconTheme)
    // We save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme', getCurrentTheme())
    localStorage.setItem('selected-icon', getCurrentIcon())
})

function sendMail() {
    // Get the form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value;

    if (!name || !email || !subject || !message) {
        alert("Please fill in all fields.");
        return;
    }

    let params = {
        name: name,
        email: email,
        subject: subject,
        message: message,
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
        .catch(err => {
            console.error("EmailJS Error:", err);
            alert("Oops! Something went wrong while sending your message. Please check your EmailJS configuration.");
        });
}
