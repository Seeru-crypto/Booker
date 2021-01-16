$(document).ready(function () { 
    // Use the given data to create  
    // the table and display it 
    $('table').bootstrapTable({ 
      data: mydata 
    }); 
  }); 
  // Parse the imported data as JSON 
  // and store it 
  var mydata = JSON.parse(data) 