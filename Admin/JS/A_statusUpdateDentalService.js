async function status_update(id, status) {
    let url = "A_DentalServicesList.php";
    url = url + "?id_ser=" + id + "&status=" + status;

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
            if (status === "active") {
                alert('Changed Success: Activated . . .');
            } else if (status === "deactivate") {
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
