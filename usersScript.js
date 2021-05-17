for(i = 1; i < document.getElementById('usersTable').rows.length; i++){
    document.getElementById('usersTable').rows[i].cells[0].id = 'row' + i;
}

let rowValue = (x) => {
    let row = document.getElementById('row'+x).innerText;
    let form = document.getElementById('formm');

    if(confirm('Czy na pewno chcesz usunąć użytkownika: ' + row)){
        let input = document.createElement('input');
        let sub = document.createElement('button');

        input.value = row;
        input.name = 'row';

        sub.type = 'submit';
        sub.innerHTML = 'tak';
        
        form.appendChild(input);
        form.appendChild(sub);
        form.style.display = 'none';

        form.submit();
    }
}