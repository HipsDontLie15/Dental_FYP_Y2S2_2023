<?php 
    include './Functions/Function_ConnectSQL.php';
    include "./Functions/U_url.php";
    include $notLoggedIn;

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

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit Appointment History | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title> 
    <link rel="stylesheet" href="../CSS/U_appointmentHistoryEdit.css">
</head>


<body>
<?php
    include "U_NavBar.php";
?>
    <div class="border-container">
        <div class="form_wrapper">
            <div class="backSearch">
                <a class="arrow" href="javascript:history.back()">
                    <div class="al">
                        <i class="fas">&#xf060;</i> Go back
                    </div>
                </a>
            </div>
        <section class="apBox">
            <div class="apppple">
                <legend>
                <h1 class="h1NA">Edit Appointment' Details</h1>
                    <h3 class="h3NA">Change your appointment details here.</h3>
                </legend>
                <form class = "formBox" id="App_Form" action="./Functions/db_editAppointmentHistory.php" method="post">
            <section class="oldDetails">
                <?php 
                    if (isset($_GET['editID_app'])) {
                        $editID_app = $_GET['editID_app'];

                        // Fetch data from the database for the specified Treatment
                        $sql = "SELECT * FROM appointment_info WHERE app_id = '".$editID_app."'";
                        $result = mysqli_query($conn, $sql);

                        $checkMember = "SELECT * FROM doctors WHERE status = 'active' ";
                        $checkMember_result = mysqli_query($conn, $checkMember);

                        if ($result && mysqli_num_rows($result) > 0) {
                            // Fetch data
                            $row = mysqli_fetch_array($result);
                            $app_id = $row['app_id'];
                            $app_email = $row['app_email'];
                            $app_type = $row['app_type'];
                            $app_care = $row['app_care'];
                            $app_doc = $row['app_doc'];
                            $app_loc = $row['app_loc'];
                            $app_date = $row['app_date'];
                            $app_time = $row['app_time'];
                            $app_description = isset($row['app_description']) ? $row['app_description'] : '' ;
                            ?>
<ul class="admin-details">

                <!-- Previous Appointment details -->
                    <li>Appointment ID : <?php echo $editID_app ?></li>

                    <?php
                        if ($checkMember_result && mysqli_num_rows($checkMember_result) > 0) {
                        $data_rows = mysqli_fetch_all($checkMember_result, MYSQLI_ASSOC);
                    ?>

              <!-- Doctor -->
                    <li>
                        <label for="">Appointment Doctor : 
                            <select id="doctorSelect" name="doc_name" required>
                                <option value="">Select a doctor</option>
                                <?php
                                // Create an associative array of doctor names and station names
                                $doctorMap = [];
                                foreach ($data_rows as $row) {
                                    $doctorMap[$row['doc_name']] = $row['doc_station'];
                                }
                                
                                // Create an associative array of doctor names and their roles
                                $doctorRoleMap = [];
                                // Replace 'doc_role' with the actual column name in your database
                                foreach ($data_rows as $row) {
                                    $doctorRoleMap[$row['doc_name']] = $row['doc_role'];
                                }

                                foreach ($data_rows as $row) {
                                    $doctorName = $row['doc_name'];
                                    ?>
                                    <option value="<?php echo $doctorName; ?>">
                                        <?php echo $doctorName; ?>
                                        <?php if ($app_doc == $doctorName) { echo " : Previous Selected"; } ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </label>
                    </li>


                <!-- Dental Location -->
                    <li>
                        <label for="" id="apploc">Appointment Location : 
                            <!-- <select id="locationSelect" name="doc_station" disabled>
                                <option value="">Select a location</option>
                                <?php
                                // Create an associative array of doctor names and station names
                                $doctorStationMap = [];
                                foreach ($data_rows as $row) {
                                    $doctorStationMap[$row['doc_name']] = $row['doc_station'];
                                }

                                foreach ($data_rows as $row) {
                                    $location = $row['doc_station'];
                                    ?>
                                    <option value="<?php echo $location; ?>"
                                        <?php if ($app_loc == $location) { echo "selected"; } ?>>
                                        <?php echo $location; ?>
                                    </option>
                                <?php } ?>
                            </select> -->
                            <input type="text" id="locationSelect" name="doc_station" value="<?php echo $app_loc; ?>" readonly>

                        </label>
                    </li>

            <!-- Ser Type -->
                <li>
                    <label id="dentalCare">Appointment Dental Care Type :</label>
                    <div id="serviceTypeCheckbox">
                        <!-- Checkboxes will be dynamically added here -->
                    </div>
                </li>

            <!-- DOV -->
                    <li><label for="dateofvisit" class="dov">Appointment Date : 
                        <input type="date" id="dates" name="app_date"
                            min="<?php echo date('Y-m-d',strtotime('+1 day'));?>"
                            max="<?php echo date('Y-m-d',strtotime('+60 day'));?>"
                            placeholder="MM/DD/YYYY" value="<?php echo $app_date; ?>" required>
                    </label></li>

            <!-- Time -->
                    <li><label for="tov" class="tov">Appointment Period :
                        <select class="pickOptions" id="time-list" name="app_time" required>
                            <option value="">Pick a time</option>
                            <?php
                            for ($i = 10; $i < 20; $i++) {
                                $hour = $i;
                                if ($i >= 13) {
                                    $hour -= 12;
                                }
                                $timeValue = "$i:00";
                                $selected = ($app_time === $timeValue) ? "selected" : "";
                                echo "<option value='$timeValue' $selected>$hour:00 " . ($i >= 12 ? 'PM' : 'AM') . "</option>";
                            }
                            ?>
                        </select>
                    </label></li>
                    

            <!-- add-on description -->
                    <?php if ($app_description != '') {?>
                    <li>
                        <label class="Description">Add-On Description : 
                        <textarea onkeyup="countCharacters(this)" name="app_description" class="des" form="App_Form" maxlength="1000" placeholder="write your concerns here . . ."><?php echo $app_description; ?></textarea>
                        <?php $remaining = 1000 - strlen($app_description); ?>
                        <p class="OptMsgCRNote" id="charCount">Characters remaining: (<?php echo $remaining; ?> /1000)</p>
                        </label>
                    </li>
                    <?php } ?>
                    <input type="hidden" name="app_id" value="<?php echo $app_id ;?>" readonly>
                    <input type="hidden" name="app_email" value="<?php echo $app_email ;?>" readonly>
                </ul>
            </section>  <!-- end -->
                        <input type="submit" value="edit" name="edit" class="btnEdit"/>
                    </form>

            </div> <!-- end of appple -->

            <!-- doctor & location -->
                <section class="informationDoc">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th colspan="3">Doctor & Their Clinic Location with Their Specialty</th>
                            </tr>
                            <tr>
                                <th>Doctor</th>
                                <th>Clinic Location</th>
                                <th>Specialty</th>
                            </tr>
                        </thead>
                        <?php foreach ($data_rows as $row) {
                            $doctorName = $row['doc_name'];
                            $doctorStation = $row['doc_station'];
                            $doctorRole = $row['doc_role'];
                            ?>
                        <tr>
                            <td align="center" class="bigtext"><?php echo $doctorName; ?></td>
                            <td align="center" class="bigtext"><?php echo $doctorStation; ?></td>
                            <td align="center" class="bigtext"><?php echo $doctorRole; ?></td>
                        </tr>
                        
                        <?php } ?>
                    </table>
                </section>  <!-- end of informationDoc-->
            </section> <!-- end of apBox-->
                <?php } ?>
                    <?php
                        } else {
                            echo "Treatment not found or database error.";
                        }
                    } else {
                        echo "No Treatment ID specified.";
                    }
                    ?>
            </div>
        </div>
    </div>
<?php
    include 'U_Footer.php';
?>
</body>
<?php
// Fetch the service types from your database and organize them by doctor's role
$serviceTypeData = [];
$all_service_values_query = "SELECT DISTINCT ser_type, ser_name FROM services WHERE status = 'active' ";
$all_service_values_result = mysqli_query($conn, $all_service_values_query);

if ($all_service_values_result && mysqli_num_rows($all_service_values_result) > 0) {
    while ($service_row = mysqli_fetch_assoc($all_service_values_result)) {
        $doctorRole = $service_row['ser_type'];
        $serviceType = $service_row['ser_name'];
        
        if (!isset($serviceTypeData[$doctorRole])) {
            $serviceTypeData[$doctorRole] = [];
        }
        
        $serviceTypeData[$doctorRole][] = $serviceType;
    }
}
?>


<script src="../JS/textarea_maxLength1000.js"></script>


<script>
    const doctorSelect = document.getElementById('doctorSelect');
    const locationSelect = document.getElementById('locationSelect');
    const doctorStationMap = <?php echo json_encode($doctorStationMap); ?>;
    const doctorMap = <?php echo json_encode($doctorMap); ?>;

    doctorSelect.addEventListener('change', function() {
        const selectedDoctor = this.value;
        const matchedLocation = doctorStationMap[selectedDoctor];
        if (matchedLocation) {
            locationSelect.value = matchedLocation;
        } else {
            locationSelect.value = ''; // Reset to default value if no match found
        }
    });

    locationSelect.addEventListener('change', function() {
    const selectedLocation = this.value;
    const matchedDoctor = Object.keys(doctorMap).find(doctorName => doctorMap[doctorName] === selectedLocation);

    if (matchedDoctor) {
        doctorSelect.value = matchedDoctor;
    } else {
        doctorSelect.value = ''; // Reset to default value if no match found
    }
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


<script>
    const serviceTypeCheckbox = document.getElementById('serviceTypeCheckbox');
    const doctorRoleMap = <?php echo json_encode($doctorRoleMap); ?>;
    const serviceTypeData = <?php echo json_encode($serviceTypeData); ?>;
    // const serviceTypeData = {
    //     "General": [
    //         "Scaling And Polishing",
    //         "Extration",
    //         "Tooth-Coloured Fillings",
    //         "Denture",
    //         "Root Canal Treatment",
    //         "Dental Crown",
    //         "Implant",
    //         "Fluoride Treatment"
    //     ],
    //     "Specialist": [
    //         "Orthodontics",
    //         "Oral Surgery"
    //     ]
    // };

    // Update the service type checkboxes based on the selected doctor's role
    function updateServiceTypeCheckboxes(selectedDoctor) {
        serviceTypeCheckbox.innerHTML = '';

        const doctorRole = doctorRoleMap[selectedDoctor];
        const serviceTypes = serviceTypeData[doctorRole] || [];

        serviceTypes.forEach(type => {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'ser_type[]';
            checkbox.value = type;
            checkbox.id = 'serType_' + type;
            
            
            const label = document.createElement('label');
            label.setAttribute('for', 'serType_' + type);
            const labelText = document.createTextNode(type); // Create a text node for label content
        label.appendChild(checkbox); // Put the checkbox inside the label
        label.appendChild(labelText); // Put the text inside the label

        // Append the label to the container
        serviceTypeCheckbox.appendChild(label);
        serviceTypeCheckbox.appendChild(document.createElement('br')); // Add a line break
        });
    }

    // Event listener for doctor selection
    const typeSelect = document.getElementById('doctorSelect');
    typeSelect.addEventListener('change', function() {
        const selectedDoctor = this.value;
        updateServiceTypeCheckboxes(selectedDoctor);
    });

    // Initial update based on default selected doctor (if any)
    const initialSelectedDoctor = typeSelect.value;
    updateServiceTypeCheckboxes(initialSelectedDoctor);
</script>

<script>
    // Add an event listener to the form submission
    document.getElementById('App_Form').addEventListener('submit', function (event) {
        // Get all the checkboxes with the name 'ser_type[]'
        const checkboxes = document.querySelectorAll('input[name="ser_type[]"]');
        
        // Check if at least one checkbox is checked
        const atLeastOneChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        if (!atLeastOneChecked) {
            // Prevent form submission and provide a simple alert
            event.preventDefault();
            alert('Please select at least one service type.');
        }
    });
</script>

</html>
