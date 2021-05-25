let table = document.getElementById('ticketTable');
for(i = 1; i < table.rows.length; i++){
    table.rows[i].cells[0].id = 'hall' + i;
    table.rows[i].cells[1].id = 'title' + i;
    table.rows[i].cells[3].id = 'date' + i;
    table.rows[i].cells[4].id = 'hour' + i;
}



let buy = (x) => {
    let form = document.getElementById('ticketForm');
    
    let hall = document.getElementById('hall'+x).innerText;
    let title = document.getElementById('title'+x).innerText;
    let date = document.getElementById('date'+x).innerText;
    let hour = document.getElementById('hour'+x).innerText;

    let hallInput = document.createElement('input');
    hallInput.name = 'hall';
    hallInput.value = hall;
    let titleInput = document.createElement('input');
    titleInput.name = 'title';
    titleInput.value = title;
    let dateInput = document.createElement('input');
    dateInput.name = 'date';
    dateInput.value = date;
    let hourInput = document.createElement('input');
    hourInput.name = 'hour';
    hourInput.value = hour;

    let sub = document.createElement('button');
    sub.type = 'submit';

    form.appendChild(hallInput);
    form.appendChild(titleInput);
    form.appendChild(dateInput);
    form.appendChild(hourInput);
    form.appendChild(sub);
    
    form.style.display = 'none';

    form.submit();
}