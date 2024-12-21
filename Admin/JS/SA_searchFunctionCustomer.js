function searchFunction() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
  
    for (i = 2; i < tr.length; i++) { // Start from index 1 to skip the table header row
      var matchFound = false;
      for (j = 0; j <= 8; j++) { // Iterate through the desired columns (0, 2, 3, 4, 5)
        td = tr[i].getElementsByTagName("td")[j];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            matchFound = true;
            break; // Exit the loop if a match is found in any of the columns
          }
  
        }
      }
  
      if (matchFound) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }