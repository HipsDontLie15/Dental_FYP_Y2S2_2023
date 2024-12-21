<?php
function displayServices_S()
{
    ?>
        <h2 class="ser_title">Specialist Treatmeant</h2>
        <div class="ser_Box">
    <?php
    include './Functions/Function_ConnectSQL.php';
	$sql = "SELECT * FROM services WHERE ser_type = 'Specialist' AND status = 'active' ";
	$result = $conn->query($sql);
	$search_result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            while ($row = mysqli_fetch_array($search_result)) {

                // Fetch the blob image data from the database
                $imageData = $row["ser_image"];
                // Determine the image extension based on the MIME type
                $imageMIMEType = mime_content_type("data://text/plain;base64," . base64_encode($imageData));
                $imageExtension = '';
                if ($imageMIMEType === 'image/jpeg') {
                    $imageExtension = 'jpg';
                } elseif ($imageMIMEType === 'image/png') {
                    $imageExtension = 'png';
                }
                // Convert the blob image data into base64 encoding
                $base64Image = base64_encode($imageData);
?>
            
                <div class="eachSerBox">
                    <div class="serImageBox"><img src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>"></div>
                    <div class="serTextBox">
                        <div class="serName"><?php echo $row['ser_name']; ?></div>
                        <div class="serDP">
                            <div class="serDuration"><?php echo $row['ser_duration']; ?> minutes</div>
                            <div class="serPrice">RM <?php echo $row['ser_price']; ?></div>
                        </div>
                        <div class="serDes"><?php echo $row['ser_description']; ?></div>
                    </div>
                </div>
                <?php
            } //end inner while loop
        } //end outer while loop
    }

    ?>
</div>

<?php

}
?>