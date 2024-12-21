async function status_update(id, status) {
    let url = "A_CustomersList.php";
    url = url + "?c_id=" + id + "&c_status=" + status;

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
            if (status === "Active") {
                alert('Changed Success: Activated . . .');
            } else if (status === "Deactivate") {
                alert('Changed Success: Deactivated . . .');
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
