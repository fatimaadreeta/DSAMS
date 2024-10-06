var today = new Date();
var datePicker = document.getElementById("startDateTime")
datePicker.min = new Date(today.getFullYear(), today.getMonth() + 1, today.getDay()+4).toJSON().slice(0,19);
datePicker.max = new Date(today.getFullYear(),  today.getMonth()+ 8, 0).toJSON().slice(0,19);
console.log(datePicker.min);
console.log(datePicker.max);
console.log(today.toString());