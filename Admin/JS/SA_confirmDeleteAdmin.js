const db_deleteAdmin = './A_Functions/db_deleteAdmin.php';
async function confirmDelete(id, status) {
    console.log('confirmDelete called with id:', id, 'and status:', status);

    if (confirm("Are you sure you want to delete this data?")) {
        let deleteUrl = db_deleteAdmin + "?id=" + id;
        try {
            const response = await fetch(deleteUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            // Parse the response to JSON
            const data = await response.json();

            // Check the response from the server and show the appropriate alert
            if (data.success) {
                alert('Record Delete successfully');
                // Redirect to the specified URL after successful delete
                window.location.href = data.redirectURL;
            } else {
                alert('Error deleting record: ' + data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        }
    }
}
