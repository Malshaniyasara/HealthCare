<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Medicine</title>
    <style>
        h1 {
            font-size: 50px;
            text-align: center;
            padding-top: 20px;
            color: #000066;
        }

        li {
            font-size: 24px;
        }

        ul {
            font-size: 28px;
        }

        ul h3 {
            font-size: 30px;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333333;
            color: white;
            text-align: center;
        }

        footer a {
            color: #f5f5f5;
        }

        footer a:hover {
            color: #FFFF33;
            text-decoration: none;
        }

        footer .glyphicon {
            font-size: 15px;
            margin-bottom: 0px;
            color: #f4511e;
        }

        body {
            font: 400 15px/1.8 Lato, sans-serif;
            color: #777;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            background-image: url('../pic/Doctor_Time.jpg');
            background-size: cover;
        }

        .container ul {
            padding-bottom: 70px;
        }
    </style>
</head>

<body class="container-fluid">
    <h1 class="text-capitalize text-center text-light">All The Doctor's Schedule List Of Orthopedic</h1>
    
    <div class="table-responsive">
        <table class="table table-hover table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Specialist</th>
                    <th scope="col">Qualification</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include("connection.php");
                include '../translate.php';

                $query = "SELECT * 
                          FROM doctor 
                          INNER JOIN schedule ON schedule.d_id = doctor.id  
                          WHERE (permission = 'approved' AND specialist LIKE 'o%') 
                             OR (permission = 'Added' AND specialist LIKE 'o%')";
                $run = mysqli_query($db, $query);

                while($row = mysqli_fetch_array($run)) {
                    echo "<tr>";
                    echo "<td><a href='../Admin/detail.php?s_id={$row['s_id']}'>{$row['f_name']} {$row['l_name']}</a></td>";
                    echo "<td>{$row['specialist']}</td>";
                    echo "<td>{$row['qualification']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="../doctor_list.php" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="cardiac_electrophysiologist.php" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <?php include 'footer.html'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>
