<?php

require 'adminHeader.php';
?>
<div class="headp"></div>
<div class="bigbox">
    <img src="userimg2.png" class="userimg2">
    <div class="texts">

        <?php
        if (isset($_SESSION['name'])) {
            $userName = $_SESSION['name'];
            echo '<h2>' . $userName . '</h2></a>';
        }
        ?>


        <?php
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            echo '<h2>' . $id . '</h2></a>';
        }
        ?>
    </div><br>


    <div class="info"><h2> Basic Information</h2> </div>
<div class="containerInfo">
    <div class="info2">
        <h3>Full Name : </h3>

        <div class="info3">
            <?php
            if (isset($_SESSION['name'])) {
                $userName = $_SESSION['name'];
                echo '<h2>' . $userName . '</h2></a>';
            }
            ?>
        </div>
    </div>

    <div class="info4">
        <h3>Email Address: </h3>

        <div class="info5">
        <?php
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                echo '<h2>' . $email . '</h2></a>';
            }
            ?>
        </div>
    </div>

    <div class="info6">
        <h3>University ID: </h3>

        <div class="info7">
        <?php
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                echo '<h2>' . $id . '</h2></a>';
            }
            ?>
        </div>
    </div>
</div>
</div>