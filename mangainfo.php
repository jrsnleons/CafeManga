<?php

$connect = mysqli_connect('localhost', 'root', '', 'manga');

if (!$connect) 
{
    echo 'Error Code: ' . mysqli_connect_errno() . '<br>';
    echo 'Error Message: ' . mysqli_connect_error() . '<br>';
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
        <link href="popup.css" rel="stylesheet">
        <!-- Font  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Crete+Round&display=swap" rel="stylesheet">
        <!-- icons -->
        <script src="https://kit.fontawesome.com/0cfc5249e3.js" crossorigin="anonymous"></script>
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="jquery.autocomplete.js"></script>
        <script>
            // Auto Complete Search Bar
            jQuery(function(){ 
                $("#search").autocomplete("search.php");
            });
        </script>
        <script type="text/javascript" src="main.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-xl navbar-light ">
            <div class="container-fluid">
                <img alt="logo" src="logo.png" class="img-fluid img-logo" style="width: 2rem;">
                <a class="navbar-brand" href="Home.php">Café Manga</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBasic" aria-controls="navbarBasic" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse show" id="navbarBasic">
                    <ul class="navbar-nav me-auto mb-2 mb-xl-0" >
                        <li class="nav-item nav-btn">
                            <a class="nav-link" href="a-z.php">A - Z</a>
                        </li>
                    </ul>
                    <!-- Search Bar -->
                    <div class="search_input">
                        <form action="Home.php" method="get">
                            <input type="text" name="q" id="search" placeholder="Type to search..">
                            <?php
                                if(!empty($_GET['q'])){
                                    $id = $_GET['q'];
                                    $titleQuery = "SELECT manga_id FROM manga WHERE title = '".$id."'";
                                    $result2 = mysqli_query($connect, $titleQuery);
                                    $result = mysqli_fetch_assoc($result2);

                                    $test =  "Location: mangainfo.php?varname='".$result['manga_id']."'";
                                    header($test); exit();
                                }
                            ?>
                        </form>
                    </div>


                    <!-- Profile Button -->
                    <div class="profile">
                        <li class="fa-solid fa-circle-user user-logo" onclick="openNav()"></li>
                        <div class="profile_dropdown" id="profile-drop">
                            <a onclick="togglePopup()" class="login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-xl big-area">
            <div class="main-info container">
                <div class="row manga-info-area">
                    <div class="col-md-12 col-lg-5 manga-cover-area">
                        <?php
                            $manga_id = $_GET['varname'];
                            $query = 'SELECT manga_id, title, cover, description
                            FROM manga
                            WHERE manga_id='.$manga_id.''; 
        
                            $result = mysqli_query($connect, $query);
        
                            if (!$result){
                                echo 'Error Message: ' . mysqli_error($connect) . '<br>';
                                exit;
                            }
                            $record = mysqli_fetch_assoc($result);
                            echo '<img class="manga-cover" src="'.$record['cover'].'"alt="'.$record['title'].'-cover">';
                        ?>
                    </div>
                    <div class="col-md-12 col-lg-7 text-info">
                        <?php
                            echo '<h1 class="manga-title">'.$record['title'].'</h1>';
                            echo '<p class="manga-info-p">'.$record['description'].'</p>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="chapter-list-area">
                    <h4 class="chapter-title">Chapter list:</h4>
                    <div class="list-area container">
                        <?php
                            $query2 = 'SELECT chap_id, chap_no, manga_id, chapter_title
                            FROM manga_chapter
                            WHERE manga_id='.$manga_id.'
                            ORDER BY chap_no'; 
        
                            $result2 = mysqli_query($connect, $query2);
                            while($record2 = mysqli_fetch_assoc($result2)){
                                echo '<div class="chapter-line">
                                        <a href="mangareader.php?varname='.$record2['chap_id'].'" class="chapter-num">
                                            <h5>Chapter '.$record2['chap_no'].' - '.$record2['chapter_title'].'</h5>
                                        </a>
                                      </div>';
                            }
                        ?>
                    </div>
            </div>
        </div>

        <!-- POPUP LOGIN FORM -->              
        <form method="post">

            <div class="popup" id="popup-1">

                <div class="content">

                    <div class="close-btn" onclick="togglePopup()">×</div>
                    <h1 style="color: white">Sign in</h1>
                    <div class="input-field"><input type="test" id="email" placeholder="User Name" class="validate" name="userName" required></div>
                    <div class="input-field"><input type="password" id="password" placeholder="Password" class="validate" name="accPass"></div>
                    <button class="second-button" type="submit" name="submit">Sign in</button>
                    <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
                </div>
            </div>
        </form>

        <?php
            include 'acclog.php';
            $crude = new acclog();
            if(isset($_POST['submit'])){
            $crude->login($_POST['userName'],$_POST['accPass']);
            }
        ?>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>