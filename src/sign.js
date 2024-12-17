const main = document.querySelector('.main');
const loginBtn = document.querySelectorAll('#signUp .btns button')[1];
const signUpBtn = document.querySelectorAll('#login .btns button')[0];
const login = document.querySelector('#signUp .others span');
const signUp = document.querySelector('#login .others span');

let currentPage = 'signUp';
//page load
window.addEventListener('load', () => {
    //adding active class to signUp button when page load
    document.querySelector('#signUp .btns button').classList.add('active');
    //adding unactive class to login button when page load
    document.querySelectorAll('#signUp .btns button')[1].classList.add('unactive');
});


const form = () => {
    if (currentPage == 'signUp') {
        main.style.transform = 'rotateY(180deg) rotateX(40deg)';

        setTimeout(() => {
            main.style.transform = 'rotateY(180deg) rotateX(0deg)';
        }, 1000);
        currentPage = 'login';


        //Adding classes And removing classes
        document.querySelector('#signUp .btns button').classList.remove('active');
        document.querySelector('#signUp .btns button').classList.add('unactive');

        document.querySelectorAll('#signUp .btns button')[1].classList.remove('unactive');
        document.querySelectorAll('#signUp .btns button')[1].classList.add('active')


        document.querySelectorAll('#login .btns button')[1].classList.remove('unactive');
        document.querySelectorAll('#login .btns button')[1].classList.add('active');


        document.querySelector('#login .btns button').classList.remove('active');
        document.querySelector('#login .btns button').classList.add('unactive');


    } else {

        main.style.transform = 'rotateY(0deg)';
        currentPage = 'signUp';

        //Adding classes And removing classes
        document.querySelectorAll('#login .btns button')[1].classList.remove('active');
        document.querySelectorAll('#login .btns button')[1].classList.add('unactive');

        document.querySelector('#login .btns button').classList.remove('unactive');
        document.querySelector('#login .btns button').classList.add('active');


        document.querySelectorAll('#signUp .btns button')[1].classList.remove('active');
        document.querySelectorAll('#signUp .btns button')[1].classList.add('unactive');


        document.querySelector('#signUp .btns button').classList.remove('unactive');
        document.querySelector('#signUp .btns button').classList.add('active');

    };
};

//listener
loginBtn.addEventListener('click', form);
signUpBtn.addEventListener('click', form);
login.addEventListener('click', form);
signUp.addEventListener('click', form);