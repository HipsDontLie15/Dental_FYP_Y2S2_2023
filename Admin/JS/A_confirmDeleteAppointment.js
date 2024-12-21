const db_deleteDoctor = './A_Functions/db_deleteAppointment.php';

async function confirmDelete(id, status) {
    if (status === "Freed") {
        if (confirm("Are you sure you want to delete this data?")) {
            let deleteUrl = db_deleteDoctor + "?app_id=" + id;
            console.log(deleteUrl);
            try {
                const response = await fetch(deleteUrl, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                // Parse the response to JSON
                const data = await response.json();
                console.log(data);
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
                alert('Error: Not linked to database');
            }
        }
    } else {
        return false;
    }
}
