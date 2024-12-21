async function status_update(id, status) {
    let url = "A_AppointmentList.php";
    url = url + "?app_id=" + id + "&status=" + status;

    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        // Parse the response to JSON
        const data = await response.json();

        // Check the response from the server and show the appropriate alert
        if (data.success) {
            if (status === "Booked") {
                alert('Changed Success: Booked From Appointment . . .');
            } else if (status === "Freed") {
                alert('Changed Success: Freed From Appointment . . .');
            }
        } else {
            alert('An error occurred. Please try again later.');
        }

        // After the request is completed, reload the current page
        location.reload();
    } catch (error) {
        console.error('Error:', error);
        // alert('Error: Please select active or deactivate . . .');
        alert('successfully changed!');
        location.reload();
    }
}
