const iconToggle = document.querySelector('.toggle_icon');
const navbarMenu = document.querySelector('.menu');
const menuLinks = document.querySelectorAll('.menu_link');
const iconClose = document.querySelector('.close_icon');
const portfolioTitle = document.querySelector('.portfolio-title');
const header = document.querySelector('header'); 

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

/*const typed = document.querySelector('.typed')

if (typed) {
  let typed_strings = typed.getAttribute('data-typed-items')
  typed_strings = typed_strings.split(',')
  new typed('.typed', {
    strings: typed_strings,
    loop: true,
    typeSpeed: '100',
    backSpeed: '50',
    backDelay: '2000'
  })
}*/

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
            document.querySelector(`.menu a[href *=${sectionId}]`).classList.add('active-link');
        } else {
            document.querySelector(`.menu a[href *=${sectionId}]`).classList.remove('active-link');
        }
    })
}

function sendMail(){
    let parms = {
        name :document.grtElementId("name").value,
        email :document.grtElementId("email").value,
        subject :document.grtElementId("subject").value,
        message :document.grtElementId("message").value,
    }
    emailjs.send("service_s4anp3b",parms).then(alert("Email sent successfully !!"))
}
window.addEventListener('scroll', scrollActive);
