function checkdate(input) // this function changes the date format to dd/mm/yyyy
{
    var datepart = input.match(/\d+/g)
    var day = datepart[2]
    var month = datepart[1]
    var year = datepart[0]
    return day + "/" + month + "/" + year
}
function setCurrentDateandTime() // this function displays current date and time in html form
{
var currentDate = new Date();      
var year = currentDate.getFullYear();     
var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Adding 1 because getMonth() returns zero-based month    
var day = ('0' + currentDate.getDate()).slice(-2);
var formattedDate = year + '-' + month + '-' + day; // Format: YYYY-MM-DD
var hours = ('0' + currentDate.getHours()).slice(-2);
var minutes = ('0' + currentDate.getMinutes()).slice(-2);
var formattedTime = hours +":" + minutes;
document.getElementById('date').value = formattedDate;
document.getElementById('date').min = formattedDate;
document.getElementById('time').value = formattedTime;
document.getElementById('time').min = formattedTime;
}

function checktime() // this function checks time in console
{
console.log(document.getElementById('time').value)
}

var form=document.getElementById("formrequest");
function submitForm(event) // using fetch post function to send data to server and pass message to html from server
{
console.log('text');
   //Preventing page refresh
   event.preventDefault();
const formData = new FormData(form);
    let currentDateValue = formData.get('date');
    formData.set('date', checkdate(currentDateValue));
fetch('data.php', {
       method: 'POST',
       body: formData
})
.then(response => response.text())
.then(text => {
document.getElementById('target').innerText = text;
})
.catch(error => console.log('Error:', error));
}

//Calling a function during form submission.
form.addEventListener('submit', submitForm);