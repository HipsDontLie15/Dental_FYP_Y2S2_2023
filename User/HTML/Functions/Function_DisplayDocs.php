<?php
function generateDoctorBoxes()
{
    include './Functions/Function_ConnectSQL.php';
	$sql = "SELECT * FROM doctors WHERE status = 'active' ";
	$result = $conn->query($sql);	//execute query connection
	$search_result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Fetch the blob image data from the database
            $imageData = $row["doc_image"];
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
            <a class="aLinkEachDocBox" href="#" onclick="toggleDescription(event, <?php echo $row['id_doc']; ?>)">
            <div class="eachDocBox">
                <div class="docImageBox">
                    <img src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>">
                    <div class="docNR">
                        <div class="docName" id="doc_Name">Dr. <?php echo $row['doc_name']; ?></div>
                        <div class="docRole"><?php echo $row['doc_role']; ?></div>
                    </div>
                </div>
                <div class="docTextBox">
                    <div class="docDes" id="doc_description_<?php echo $row['id_doc']; ?>" style="display: none;">
                        <p><?php echo $row['doc_description']; ?></p>
                    </div>
                </div>
            </div>
            </a>
        <?php
        } //end while loop
    }
}
?>
