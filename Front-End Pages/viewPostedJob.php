<!DOCTYPE html>
    <html>
    <head>
        <title>View Job</title>
        <link rel="stylesheet" href="Cprofile.css">
        <?php
            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "Adbms2023#";
            $dbname = "mydb";

            $conn = new mysqli('localhost','root','Adbms2023#','mydb');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if (!isset($_SESSION['rid']))
            {
              header("location: Home.html");
            }  
            // Retrieve data from the session
            $username = $_SESSION['username'];
            $table = $_SESSION['table']; 
            $password = $_SESSION['password'];
            $rid = $_SESSION['rid'];
            $JobID = $_GET['varname'];
            
            $sql4 = "SELECT JobTitle, PayRate, PayPeriod, JobDomain, PostingDate, Deadline, Information FROM jobs WHERE JobID = $JobID";
            $result4 = mysqli_query($conn, $sql4);
            if ($result4->num_rows > 0)
            {
                $row4 = mysqli_fetch_array($result4);
            }

            $sql5 = "SELECT CityID FROM job_locations WHERE JobID = $JobID";
            $result5 = mysqli_query($conn, $sql5);
            if ($result5->num_rows > 0)
            {
                $row5 = mysqli_fetch_array($result5);
                $cityID = $row5['CityID'];
            }

            $sql6 = "SELECT CityName, StateName, CountryName FROM city WHERE CityID = $cityID";
            $result6 = mysqli_query($conn, $sql6);
            if ($result6->num_rows > 0)
            {
                $row6 = mysqli_fetch_array($result6);
            }

            $sql7 = "SELECT RoundID, RoundLink, Duration FROM job_round WHERE JobID = $JobID";
            $result7 = mysqli_query($conn, $sql7);
            if ($result7->num_rows > 0)
            {
                $row7 = mysqli_fetch_array($result7);
                $RoundID = $row7['RoundID'];
            }

            $sql8 = "SELECT RoundName FROM round_types WHERE RoundID = $RoundID";
            $result8 = mysqli_query($conn, $sql8);
            if ($result8->num_rows > 0)
            {
                $row8 = mysqli_fetch_array($result8);
                $RoundName = $row8['RoundName'];
            }

            $sql9 = "SELECT ApplicationID, CandidateID, ApplicationDate FROM applications WHERE JobID = $JobID";
            $result9 = mysqli_query($conn, $sql9);
            $flag = 0;
            if ($result9->num_rows > 0)
            {
                $flag = 1;
                $ApplicationIDs = [];
                $CandidateIDs = [];
                $ApplicationDates = [];
                $CFirstName = [];
                $CLastName = [];
                $EmailIDs = [];
                $EducationLevel = [];
                $Uni = [];
                $Nation = [];
                $MajorIDs = [];
                $MajorNames = [];
                while ($row9 = mysqli_fetch_array($result9))
                {   
                    array_push($ApplicationIDs, $row9['ApplicationID']);
                    array_push($CandidateIDs,$row9['CandidateID']);
                    array_push($ApplicationDates,$row9['ApplicationDate']);
                    $cid = $row9['CandidateID'];
                    
                    $sql10 = "SELECT CFirstName, CLastName, EmailAddress, EducationLevel, RecentUniversityName, Nationality, MajorID FROM candidate WHERE CandidateID = $cid";
                    $result10 = mysqli_query($conn, $sql10);
                    $row10 = mysqli_fetch_array($result10);
                    array_push($CFirstName,$row10['CFirstName']);
                    array_push($CLastName,$row10['CLastName']);
                    array_push($EmailIDs,$row10['EmailAddress']);
                    array_push($EducationLevel,$row10['EducationLevel']);
                    array_push($Uni,$row10['RecentUniversityName']);
                    array_push($Nation,$row10['Nationality']);
                    array_push($MajorIDs,$row10['MajorID']);
                    $mid = $row10['MajorID'];
                    
                    $sql11 = "SELECT MajorName FROM majors WHERE MajorID = $mid";
                    $result11 = mysqli_query($conn, $sql11);
                    $row11 = mysqli_fetch_array($result11);
                    array_push($MajorNames, $row11['MajorName']);
                }
            }

            $sql10 = "SELECT ApplicationID FROM active_rounds";
            $result10 = mysqli_query($conn, $sql10);
            if ($result10->num_rows > 0)
            {
                $ActiveApplications = [];
                while ($row10 = mysqli_fetch_array($result10))
                {
                    array_push($ActiveApplications, $row10['ApplicationID']);
                }
            }
        ?>
    </head>
    <body>
        <div class="background"></div>
        <div class="top-menu">
            <img src="NWlogo.png" class="nw" width="180" height="55">
            <a href="RProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
            <a href="RecDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
            <a href="Rnotifications.php?rid=<?php echo $rid?>"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
            <a href="RSettings.php"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
            <a href="../NetWork/RecLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
        </div>
        <div class="white2" style="width: 780px; margin-left:25px; color:white; height: 300px;">
            <div style="height:180px; margin-left:25px; font-size:23px; margin-top: 15px;">
                    Job ID: <?php echo $JobID;?><br>
                    Job Title: <?php echo $row4['JobTitle'];?><br>
                    Job Domain: <?php echo $row4['JobDomain'];?><br>
                    Location: <?php echo $row6['CityName'];?>, <?php echo $row6['StateName'];?>, <?php echo $row6['CountryName'];?>.<br>
                    Pay: $<?php echo $row4['PayRate'];?> <?php echo $row4['PayPeriod'];?><br>
                    Round Name: <?php echo $row8['RoundName'];?><br>
                    Round Link: <?php echo $row7['RoundLink'];?><br>
                    Duration: <?php echo $row7['Duration'];?> minutes<br>
                    Posting Date: <?php echo $row4['PostingDate'];?><br>
                    Application Deadline: <?php echo $row4['Deadline'];?><br>
            </div>
        </div>
        <div class="bottom-panel">
		<?php
            if ($flag == 1)
            {
			    for ($i = 0; $i < count($ApplicationIDs); $i++)
			    {
                    if (!in_array($ApplicationIDs[$i], $ActiveApplications))
                    {
		?>
        <h2>Applications</h2>
        <div class="white2" id = 'repeat'>
			<h2>
				<u>
					<?php echo $CFirstName[$i];?> <?php echo $CLastName[$i]?>
					<a href = "../NetWork/sendInvite.php?varname=<?php echo $ApplicationIDs[$i]?>&stat=1">
						<input type="submit" value="Invite" style = "margin-left: 125px; width: 100px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px; background-color: #3498db;" class="button">
                    </a>
                    <a href = "../NetWork/sendInvite.php?varname=<?php echo $ApplicationIDs[$i]?>&stat=0">
                        <input type="submit" value="Reject" style = "margin-left: 125px; width: 100px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px; background-color: #ff0000;" class="button">
                    </a>
				</u>
			</h2>
			<h4>Application ID: <?php echo $ApplicationIDs[$i]?>, Application Date: <?php echo $ApplicationDates[$i]?></h4>
            <h4>Education Level: <?php echo $EducationLevel[$i]?>, Major: <?php echo $MajorNames[$i]?></h4>
            <h4>University: <?php echo $Uni[$i]?>, Nationality: <?php echo $Nation[$i]?>, Email Address: <?php echo $EmailIDs[$i]?></h4>
		</div>
		<?php
                    }
                }
			}
            else
            {
		?>
        <h2>No Applications Yet!</h2>
        <?php
            }
        ?>
        <script type="text/javascript">
            let repeatElements = document.getElementsById("repeat");
            for (let i = 0; i < sizeof($JobTitles); i++) {
                console.log(repeatElements[i]);
            }
        </script>
    </div>
    </body>
</html>