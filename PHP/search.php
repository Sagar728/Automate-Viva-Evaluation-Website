<!DOCTYPE html>
<html>
<head>
    <title>Check Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }
        input[type="submit"] {
            padding: 8px 15px;
            border-radius: 5px;
            border: 1px solid #007bff;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        nav {
            position: sticky;
            top: 0;
            left: 0;
            height: 70px;
            width: 100%;
            background-color: rgba(0, 123, 255, 0.8); /* Transparent blue */
            z-index: 100;
        }
        nav .nav-bar {
            position: relative;
            height: 100%;
            max-width: 1000px;
            width: 100%;
            background-color: rgba(0, 123, 255, 0.8); /* Transparent blue */
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        nav .nav-bar .sidebarOpen {
            color: #fff;
            font-size: 25px;
            padding: 5px;
            cursor: pointer;
            display: none;
        }
        nav .nav-bar .logo a {
            font-size: 25px;
            font-weight: 500;
            color: #fff;
            text-decoration: none;
        }
        .menu .logo-toggle {
            display: none;
        }
        .nav-bar .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-bar .nav-links li {
            margin: 0 5px;
            list-style: none;
        }
        .nav-links li a {
            position: relative;
            font-size: 17px;
            font-weight: 400;
            color: #fff;
            text-decoration: none;
            padding: 10px;
        }
        .nav-links li a::before {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            height: 6px;
            width: 6px;
            border-radius: 50%;
            background-color: #fff;
            opacity: 0;
            transition: all 0.3s ease;
        }
        .nav-links li:hover a::before {
            opacity: 1;
        }


        #v
{
    position: absolute;
    left: 350px;
    font-family: sans-serif;
  text-transform: uppercase;
  font-size: 2.3em;
  letter-spacing: 4px;
  overflow: hidden;
  background: linear-gradient(90deg, #000, #fff, #000);
  background-repeat: no-repeat;
  background-size: 80%;
  animation: animate 3s linear infinite;
  -webkit-background-clip: text;
  -webkit-text-fill-color: rgba(1, 149, 67, 0);
}

@keyframes animate {
  0% {
    background-position: -500%;
  }
  100% {
    background-position: 500%;
  }
}

img
{

width: 10%;
height: 100%;
position: absolute;
left: 0px;
top: 0px;

}


    </style>
</head>
<body>

<nav>
    <div class="nav-bar">
        <i class='bx bx-menu sidebarOpen'></i>
        <span class="logo navLogo"><a href="#"><img src="1c.png" alt=""></a></span> 
        <div class="menu">
            <div class="logo-toggle">
                <span class="logo"><a href="#">CodingLab</a></span>
                <i class='bx bx-x siderbarClose'></i>
            </div>
            <ul class="nav-links">
                <li><a href="demo.html"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="search.php"><i class="fas fa-table"></i> Gread Sheet</a></li>
                <li id="v">VIVA-EVAL </li>
            </ul>
        </div>
    </div>
</nav>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form method="get">
    <label for="search">Search by ID:</label>
    <input type="text" id="search" name="search">
    <button type="submit"><i class="fas fa-search"></i> Search</button>
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Branch</th>
        <th>Subject</th>
        <th>Mark</th>
        <th>Image</th>
        
    </tr>
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the 'check' table
    $sql = "SELECT * FROM `check`";

    // If search is provided, add a WHERE clause to filter by ID
    if(isset($_GET['search']) && $_GET['search'] != '') {
        $search_id = $_GET['search'];
        $sql .= " WHERE id = $search_id";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["branch"]. "</td><td>"
                . $row["subject"]. "</td><td>" . $row["marks"]."</td><td><a href=".$row["image"]." target='_blank'>".$row["image"]. "</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</table>


</body>
</html>
