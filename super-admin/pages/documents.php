<?php
session_start();
include('../includes/db_connection.php');


?>

    <title>Documents</title>
    <style>
        .content-wrapper .container{
            min-width: 20vw;
            height: 85vh;
            background: #f5f5f5;
        }

        .top-title{
            text-align: center;
            margin-bottom: 20px;
        }
        #teacher-img{
            width: 30px;
            height: 30;
            border-radius: 50%;
        }
        h3{
             padding: 20px;
        }
    </style>

<div class="content-wrapper">
        <div class="container">
            <div class="top-title">
                <h3>All Related documents of School</h3><hr>
            </div>
        </div>
    </div>
