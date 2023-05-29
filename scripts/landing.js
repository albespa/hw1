//ANIMAZIONI

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});


//CHECK LOGIN

function completionCheck(event) {
    if (login.l_username.value.length == 0 || login.l_password.value.length == 0) {
        event.preventDefault();
        document.querySelector('.login_error').classList.remove("hidden");
    }
}

const login = document.forms['login_form'];
login.addEventListener('submit', completionCheck);


//CHECK REGISTRAZIONE

function checkName(event) {

    if (event.currentTarget.value.length > 0 && event.currentTarget.value.length < 16) {
        document.querySelector('#err_name').classList.add("hidden");
        if (event.currentTarget == document.querySelector('input[name="firstname')) finalCheck.first = true;
        else finalCheck.last = true;
    }
    else {
        document.querySelector('#err_name').classList.remove("hidden");
        if (event.currentTarget == document.querySelector('input[name="firstname')) finalCheck.first = false;
        else finalCheck.last = false;
    }
}

function jsonCheckUsername(json) {
    if (!json.exists) {
        document.querySelector('#err_user').textContent = "Username non valido (Massimo 16 caratteri).";
        document.querySelector('#err_user').classList.add('hidden');
        finalCheck.user = true;
    } else {
        document.querySelector('#err_user').textContent = "This username is already taken";
        document.querySelector('#err_user').classList.remove('hidden');
        finalCheck.user = false;
    }
}

function jsonCheckEmail(json) {
    if (!json.exists) {
        document.querySelector('#err_email').textContent = "Email non valida.";
        document.querySelector('#err_email').classList.add('hidden');
        finalCheck.email = true;
    } else {
        document.querySelector('#err_email').textContent = "Email già in uso!";
        document.querySelector('#err_email').classList.remove('hidden');
        finalCheck.email = false;
    }
}

function fetchResponse(response) {
    return (response.ok ? response.json() : null);
}

function checkUsername(event) {
    const user = document.querySelector('input[name="s_username"]');

    if (!/^[a-zA-Z0-9_]{1,16}$/.test(user.value)) {
        document.querySelector('#err_user').classList.remove("hidden");
        finalCheck.user = false;
    } else {
        fetch("check.php?u=" + encodeURIComponent(user.value)).then(fetchResponse).then(jsonCheckUsername);
    }
}

function checkEmail(event) {
    const addr = document.querySelector('input[type="email"]');

    if (!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(addr.value).toLowerCase())) {
        document.querySelector('#err_email').classList.remove("hidden");
        finalCheck.email = false;
    } else {
        fetch("check.php?e=" + encodeURIComponent(String(addr.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const pass = document.querySelector('input[name="s_password"]');
    if (pass.value.length >= 8) {
        document.querySelector('#err_pass').classList.add('hidden');
        finalCheck.pass = true;
    } else {
        document.querySelector('#err_pass').classList.remove('hidden');
        finalCheck.pass = false;
    }
}

function checkMatch(event) {
    const match = document.querySelector('input[name="s_confirm_password"]');
    if (match.value === document.querySelector('input[name="s_password"]').value) {
        document.querySelector('#err_match').classList.add('hidden');
        finalCheck.pMatch = true;
    } else {
        document.querySelector('#err_match').classList.remove('hidden');
        finalCheck.pMatch = false;
    }
}

let finalCheck = {
    first: false,
    last: false,
    email: false,
    user: false,
    pass: false,
    pMatch: false
};

function finalSubmitCheck(event) {
    let fCheck = 0;
    for (const f in finalCheck) {
        if (finalCheck[f] == false) fCheck++;
    }

    if (fCheck) {
        event.preventDefault();
        document.querySelector('#err_final').classList.remove('hidden');
    }
}

document.querySelectorAll('#fullname input').forEach(n => n.addEventListener('blur', checkName));
document.querySelector('input[type="email"]').addEventListener('blur', checkEmail);
document.querySelector('input[name="s_username"]').addEventListener('blur', checkUsername);
document.querySelector('input[name="s_password"]').addEventListener('blur', checkPassword);
document.querySelector('input[name="s_confirm_password"]').addEventListener('blur', checkMatch);
document.forms['signup_form'].addEventListener('submit', finalSubmitCheck);