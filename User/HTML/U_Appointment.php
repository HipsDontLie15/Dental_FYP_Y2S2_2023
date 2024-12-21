<?php 
    include "./Functions/U_url.php";
    include $notLoggedIn;

    $stepsArray = array(
        1 => array(
            'title' => 'Type of appointment',
            'content' => 'Which type of care would you like to select?'
        ),
        2 => array(
            'title' => 'Select your preferred dental care / service',
            'content' => 'Which type of dental care / service?'
        ),
        3 => array(
            'title' => 'Select your preferred doctor with their residing clinic branch',
            'content' => 'Which doctor in your nearest location, would you like to have an appointment with?'
        ),
        4 => array(
            'title' => 'Select a clinic location',
            'content' => 'Which of our clinic is nearest to you?'
        ),
        5 => array(
            'title' => 'Select your preferred date',
            'content' => 'Which date would be suitable to you?'
        ),
        6 => array(
            'title' => 'Select your preferred time',
            'content' => 'Which time of selected date would suit you mostly?'
        )
    );


    $locationArray = array(
        1 => 'Cheras',
        2 => 'Desa Aman Puri',
        3 => 'Kepong',
        4 => 'Kepong Baru',
        5 => 'Petaling Jaya',
        6 => 'Rawang',
        7 => 'Sungai Buloh'
    );
?>

<?php
function doctorNames(){
    
    include './Functions/Function_ConnectSQL.php';
    $sql = "SELECT * FROM doctors WHERE status = 'active' ";
    $result = $conn->query($sql);
    $search_result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                while ($row = mysqli_fetch_array($search_result)) {
                    $doctorName = $row['doc_name'];
                    $doctorRole = $row['doc_role'];
                    $doctorStation = $row['doc_station'];
                    
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
                    
                    <label class="radio-image" for="rb_<?php echo $doctorName; ?>">
                        <input class="rb_doc" type="radio" id="rb_<?php echo $doctorName; ?>" name="app_doc" value="<?php echo $doctorName; ?>" required>
                        <div class="doc_imgName">
                            <img class="img_doc" src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>">
                            <div>Dr. <?php echo $doctorName; ?></div>
                            <div class="doctorRole"><?php echo $doctorRole; ?></div>
                            <div class="doctorStation">Location: <?php echo $doctorStation; ?></div>
                            <input type="hidden" name="app_loc" value="<?php echo $doctorStation; ?>">
                        </div>
                    </label>
                    <?php
                }
            }
        }
    }
?>

<?php
function treatmentNames(){
    
    include './Functions/Function_ConnectSQL.php';
    $sql = "SELECT * FROM services WHERE status = 'active' ";
    $result = $conn->query($sql);
    $search_result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                while ($row = mysqli_fetch_array($search_result)) {
                    $ser_name = $row['ser_name'];
                    $ser_type = $row['ser_type'];
                    
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
                    
                    <label class="radio-service" for="rb_<?php echo $ser_name; ?>">
                        <input class="rb_doc" type="checkbox" id="rb_<?php echo $ser_name; ?>" name="app_care[]" value="<?php echo $ser_name; ?>" >
                        <div class="rb_serBox">
                            <img class="img_ser" src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>">
                            <div><?php echo $ser_name; ?></div>
                            <div class="serType"><?php echo $ser_type; ?></div>
                        </div>
                    </label>
                    <?php
                }
            }
        }
    }
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const appointmentTypeSelect = document.getElementById("appointmentTypeSelect");
    const doctorBoxes = document.querySelectorAll(".rb_docBox .radio-image");
    const treatmentCheckboxes = document.querySelectorAll(".radio-service");
    const clinicLocationSelect = document.getElementById("clinicLocationSelect");
    
    appointmentTypeSelect.addEventListener("change", function() {
        const selectedOption = appointmentTypeSelect.value;

        // clear all checked checkboxes
        treatmentCheckboxes.forEach(function(treatmentCheckbox) {
            treatmentCheckbox.querySelector(".rb_doc").checked = false;
        });

        // clear all checked radiobutton
        doctorBoxes.forEach(function(doctorBox) {
            const doctorCheckbox = doctorBox.querySelector(".rb_doc");
            doctorCheckbox.checked = false;
        });
        

        doctorBoxes.forEach(function(doctorBox) {
            const doctorRole = doctorBox.querySelector(".doctorRole").textContent;

            if (selectedOption === "" || doctorRole === selectedOption) {
                doctorBox.style.display = "block"; // Show matching doctors or if no option is selected
            } else {
                doctorBox.style.display = "none"; // Hide non-matching doctors
            }
        });

        treatmentCheckboxes.forEach(function(treatmentCheckbox) {
            const treatmentType = treatmentCheckbox.querySelector(".serType").textContent;

            if (selectedOption === "" || treatmentType.toLowerCase().includes(selectedOption.toLowerCase())) {
                treatmentCheckbox.style.display = "block"; // Show matching treatments or if no option is selected
            } else {
                treatmentCheckbox.style.display = "none"; // Hide non-matching treatments
            }
        });
    });

    doctorBoxes.forEach(function(doctorBox) {
        const doctorName = doctorBox.querySelector(".doc_imgName > div").textContent;
        const doctorRole = doctorBox.querySelector(".doctorRole").textContent;

        doctorBox.addEventListener("click", function() {
            appointmentTypeSelect.value = doctorRole;

            doctorBoxes.forEach(function(box) {
                const boxDoctorRole = box.querySelector(".doctorRole").textContent;

                if (doctorRole === boxDoctorRole) {
                    box.style.display = "block"; // Show the selected doctor type's doctors
                } else {
                    box.style.display = "none"; // Hide other doctor types' doctors
                }

            });

            treatmentCheckboxes.forEach(function(treatmentCheckbox) {
                const treatmentType = treatmentCheckbox.querySelector(".serType").textContent;

                if (doctorRole === "" || doctorRole === treatmentType) {
                    treatmentCheckbox.style.display = "block"; // Show matching treatments for selected doctor type
                } else {
                    treatmentCheckbox.style.display = "none"; // Hide non-matching treatments for other doctor types
                }

                if(treatmentType.checked === doctorRole){

                }else {}

                
            });
        });
    });
});
</script>

<script>
    //date & time
    document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById("dates");
    const timeSelect = document.getElementById("time-list");

    dateInput.addEventListener("change", function() {
        const selectedDate = new Date(dateInput.value);
        const dayOfWeek = selectedDate.getDay(); // 0 (Sunday) to 6 (Saturday)

        if (dayOfWeek === 0 || dayOfWeek === 6) {
            // It's a weekend, set max time to 19:00
            timeSelect.innerHTML = "";
            for (let i = 10; i < 20; i++) {
                let hour = i;
                if (i >= 13) {
                    hour -= 12;
                }
                const option = document.createElement("option");
                option.value = i + ":00";
                option.textContent = hour + ":00 " + (i >= 12 ? "PM" : "AM");
                timeSelect.appendChild(option);
            }
        } else {
            // It's a weekday, set max time to 20:00
            timeSelect.innerHTML = "";
            for (let i = 10; i < 21; i++) {
                let hour = i;
                if (i >= 13) {
                    hour -= 12;
                }
                const option = document.createElement("option");
                option.value = i + ":00";
                option.textContent = hour + ":00 " + (i >= 12 ? "PM" : "AM");
                timeSelect.appendChild(option);
            }
        }
    });
});

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_appointment.css">
    <title>Appointment | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>

<script src="../JS/textarea_maxLength1000.js"></script>

<body>
<?php
    include "U_NavBar.php";
?>
<section class = "bkTop">
    <div class = "bkTitle">
        <div class = "groupTitle">
            <h4>Appointment</h4>
            <h2>Easy Online Appointment Scheduling</h2>
        </div>
        <p>Ready to smile bright? Scheduling an appointment at Qualiteeth Dental Clinic is quick and easy! 
            Our friendly team will help you find the perfect time that fits your busy schedule. <br><br>Whether it's a routine check-up, cleaning, or any dental treatment, we've got you covered. 
            Make an appointment with us today and experience top-notch care for your radiant smile!</p>
    </div>
    <div class = "bkTitle_bg">
        <img src="../Images/appointment_1.jpeg" alt="appointment_1">
    </div>
</section>
<section class = "bkBottom">
        <!-- <form class = "formBox" id="App_Form" action="./Functions/Function_Appointment.php" method="post"> -->
        <form class = "formBox" id="App_Form" action="U_AppointmentPayment.php" method="post">
            <h2 class="formTitle">Make an Appointment</h2>
            <fieldset>
                <legend><h5>Fill in the Details</h5></legend>
                <div class="appDetails">
                    <div class="step1">
                        <h3><?php echo $stepsArray[1]['title']; ?></h3>
                        <p class="OptMsgSmallNote"><?php echo $stepsArray[1]['content']; ?></p>
                        <select class="pickOptions" id="appointmentTypeSelect" name="app_type" required onchange="updateDoctorOptions(this.value)">
                            <option value="">Select General or Specialist</option>
                            <option value="General" name="General">General</option>
                            <option value="Specialist" name="Specialist">Specialist</option>
                        </select>
                    </div>
                    <div>
                        <h3><?php echo $stepsArray[5]['title']; ?></h3>
                        <p class="OptMsgSmallNote"><?php echo $stepsArray[5]['content']; ?></p>
                        <label for="dateofvisit" class="dov">Date of Visit:
                            <input type="date" id="dates" name="app_date"
                                min="<?php echo date('Y-m-d',strtotime('+1 day'));?>"
                                max="<?php echo date('Y-m-d',strtotime('+60 day'));?>"
                                placeholder="MM/DD/YYYY" required>
                        </label>
                    </div>
                    <div>
                        <h3><?php echo $stepsArray[6]['title']; ?></h3>
                        <p class="OptMsgSmallNote"><?php echo $stepsArray[6]['content']; ?></p>
                        <label for="tov" class="tov">Time of Visit:
                            <select class="pickOptions" id="time-list" name="app_time" required>
                                <option value="">Pick a time</option>
                                <?php
                                for ($i = 10; $i < 20; $i++) {
                                    $hour = $i;
                                    if ($i >= 13) {
                                        $hour -= 12;
                                    }
                                    echo "<option value='$i:00'>$hour:00 " . ($i >= 12 ? 'PM' : 'AM') . "</option>";
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div>
                        <h3><?php echo $stepsArray[2]['title']; ?></h3>
                        <p class="OptMsgSmallNote"><?php echo $stepsArray[2]['content']; ?></p>
                        <div class="cb_serBox">
                        <?php
                        treatmentNames();
                        ?>
                        </div>
                    </div>
                    <div>
                        <h3><?php echo $stepsArray[3]['title']; ?></h3>
                        <p class="OptMsgSmallNote"><?php echo $stepsArray[3]['content']; ?></p>
                            <div class="rb_docBox">
                            <?php
                            doctorNames();
                            ?>
                            </div>
                    </div>
                </div>
                <div class="OptMessageBox">
                    <h4>Optional: Write a message</h4>
                    <textarea onkeyup="countCharacters(this)" name="app_description" form="App_Form" maxlength="1000" placeholder="write your concerns here . . ."></textarea>
                    <?php $remaining = 1000; ?>
                    <p class="OptMsgCRNote" id="charCount">Characters remaining: (<?php echo $remaining; ?> /1000)</p>
                </div>
                <div class="cb_depositBox">
                    <label for="depositBox">
                    <input type="checkbox" id="depositBox" name="depositBox" required>
                    Do note there is a deposit fee of RM20 required to make this appointment.
                    </label>
                </div>
                <div class = "Sub-row">
                    <button type="submit" class="button" name="Submit">Place Booking</button>
                </div>
            </fieldset>
                
        </form>
            
</section>

<?php
    include 'U_Footer.php';
?>
</body>
</html>


