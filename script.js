let login = document.getElementById("login");
let loginPanel = document.getElementById("loginPanel");
let form = document.createElement("form");
let emailInput = document.createElement("input");
let passwordInput = document.createElement("input");
let submitButton = document.createElement("button");
let closeButton = document.createElement("button");

login.onclick = () => {    
    loginPanel.appendChild(form);
    form.className = "loginPanel";
    form.method = 'post';
    //form.action = 'userMain.php';
    form.style.display = "block";
    
    emailInput.type = 'text';
    emailInput.maxLength = 70;
    emailInput.placeholder = 'email';
    emailInput.required = true;
    emailInput.className = 'loginInput col-md-3';

    passwordInput.type = 'password';
    passwordInput.maxLength = 32;
    passwordInput.placeholder = 'hasło';
    passwordInput.required = true;
    passwordInput.className = 'loginInput col-md-3';

    submitButton.innerHTML = "Zaloguj się";
    submitButton.type = "submit";
    submitButton.className = "loginButton col-md-3";

    closeButton.innerHTML = "zamknij";
    closeButton.type = "button";
    closeButton.className = "loginButton col-md-3";

    form.appendChild(emailInput);
    form.appendChild(passwordInput);
    form.appendChild(submitButton);
    form.appendChild(closeButton);
    
};

closeButton.addEventListener('click', () => {
    loginPanel.removeChild(form);
    form.style.display = 'none';
});