let login = document.getElementById("login");
let loginPanel = document.getElementById("loginPanel");
let form = document.createElement("form");
let emailInput = document.createElement("input");
let passwordInput = document.createElement("input");
let submitButton = document.createElement("button");
let submitLink = document.createElement("a");
let closeButton = document.createElement("button");
let registerLink = document.createElement("a");
let registerButton = document.createElement("button");

    form.method = 'post';
    form.action = 'logowanie.php';

login.onclick = () => {    
    loginPanel.appendChild(form);
    form.className = "loginPanel";
    
    form.style.display = "block";
    
    emailInput.type = 'text';
    emailInput.name = 'email';
    emailInput.maxLength = 70;
    emailInput.placeholder = 'email';
    emailInput.required = true;
    emailInput.className = 'loginInput offset-md-1 col-md-2';

    passwordInput.type = 'password';
    passwordInput.name = 'haslo';
    passwordInput.maxLength = 32;
    passwordInput.placeholder = 'hasło';
    passwordInput.required = true;
    passwordInput.className = 'loginInput col-md-2';

    submitButton.innerHTML = "Zaloguj się";
    submitButton.type = "submit";
    submitButton.className = "loginButton col-md-2";

    submitLink.href = "logowanie.php";
    submitLink.appendChild(submitButton);
    
    registerLink.href = "registerPanel.php";
    registerLink.appendChild(registerButton);

    registerButton.innerHTML = "Zarejestruj się";
    registerButton.type = "button";
    registerButton.className = "loginButton col-md-2";


    closeButton.innerHTML = "zamknij";
    closeButton.type = "button";
    closeButton.className = "loginButton offset-md-1 col-md-2";

    form.appendChild(emailInput);
    form.appendChild(passwordInput);
    form.appendChild(submitLink);
    form.appendChild(registerLink);
    form.appendChild(closeButton);
    
};

closeButton.addEventListener('click', () => {
    loginPanel.removeChild(form);
    form.style.display = 'none';
});