function getData(datasource, divID, aSearch) // Fetch get function to get data from server
{
    const form = document.getElementById(divID);
    var url = datasource + "?bsearch=" + encodeURIComponent(aSearch);
    
    fetch(url, {
        method: "GET"
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            document.getElementById('message').innerText = data.error;
        } else {
console.log(data);
            displayTable(data);
        }
    })
    .catch(error => console.log("Error: ", error));
}

function displayTable(data) // displays data inside a table
{
    const messageDiv = document.getElementById('message');
    messageDiv.innerHTML = ''; // Clear previous messages or table

    if (data.length === 0) {
        messageDiv.innerText = "There is no match";
        return;
    }

    const table = document.createElement('table');
    const headers = ['Booking reference number', 'Customer name', 'Phone', 'Pickup suburb', 'Destination suburb', 'Pickup date and time', 'Status', 'Assign'];

    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');
    headers.forEach(headerText => {
        const th = document.createElement('th');
        th.innerText = headerText;
        th.style.border = '1px solid black';
        headerRow.appendChild(th);
    });
    thead.appendChild(headerRow);
    table.appendChild(thead);

    const tbody = document.createElement('tbody');
    data.forEach(row => {
        const tr = document.createElement('tr');
        const keys = ['bookingnumber', 'cname', 'phone', 'sbname', 'dsbname', 'datetime', 'status'];
        
        keys.forEach(key => {
            const td = document.createElement('td');
            td.innerText = row[key];
            td.style.border = '1px solid black';
            tr.appendChild(td);
        });

        const assignTd = document.createElement('td');
        assignTd.style.border = '1px solid black';
        const assignButton = document.createElement('button');
        assignButton.innerText = 'Assign';
        assignButton.onclick = () => assignBooking(row.bookingnumber);
        assignTd.appendChild(assignButton);
        tr.appendChild(assignTd);

        tbody.appendChild(tr);
    });
    table.appendChild(tbody);

    messageDiv.appendChild(table);
}
function assignBooking(bookingNumber) // this function to get the assigned button to work
{
    fetch('assigned.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ bookingnumber: bookingNumber })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Booking assigned successfully');
            // Optionally, refresh the table or update the row status
        } else {
            alert('Error assigning booking: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while assigning booking');
    });
}
