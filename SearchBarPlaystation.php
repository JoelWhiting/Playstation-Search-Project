<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Playstation.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playstation Search Bar</title>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <a href="https://www.sony.com/en/"><img src="SonyLogo.png" width="70"></a>
    </div>

    <!-- Navigation Menu -->
    <div class="navbar">
        <a href="Playstation.com"> <img src="PlaystationLogo.jpeg" width="30px" text-align="left"></a>
        <a href="PlaystationSearchEngine.html">Home page</a>
        <a href="#">Search</a>
        <a href="#">About Us</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </div>
    <br><br>

    <div class="banner-card">
        <img src="BackDivPic.jpeg" width="100%" >
        <div class="banner-text"> 
            <img src="psss.png" width="100px" height="100px" class="centered-image"> 
            <h1> Playstation Game Search Engine</h1>
            <h2>Search your favorite games below !!</h2>
        </div>
    </div>
    <br><br>

    <form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h3>Please enter a Playstation exclusive <img src="Pointer.gif" width="15px" height="25px"></h3>
        <input type="text" placeholder="Submit a game name ...." class="searchbar" style="background-color:aliceblue; margin-left: 150px; " name="search">
        <input type="Submit" name="submit">
        <p>Games include The Last of Us 2, God of War, etc...</p>
    </form>

    <?php
        $servername = "localhost";
        $username = "Jwhi2308";
        $password = "1234";
        $dbname = "Playstation Games";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["search"])) { // Check if the search parameter is set
                $search = $_POST["search"];
                $search = mysqli_real_escape_string($conn, $search);

                $sql = "SELECT * FROM PlaystationGames WHERE Name LIKE '%$search%'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="result-container">';
                    while ($row = $result->fetch_assoc()) {
                        echo "Name: " . $row["Name"] . " <br> " . "System: " . $row["System"] . " <br> " . "Date Released: " .
                            $row["DateR"] . " <br> " . "Genre: "  . $row["Genre"] . '<br><img src="' . $row["PicPath"] . '" alt="Game Image" style="max-width: 300px; max-height: 300px;"><br>' . "<hr>";
                    }
                    echo '</div>';
                } else {
                    echo '<div class="result-container">No results</div>';
                } 
            } else {
                echo '<div class="result-container">Please enter a search term</div>';
            }
        }
    ?>
    
    <br><br><br>
    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Responsive Web Page. All rights reserved.</p>
    </div>
</body>
</html>
