<?php

namespace App;

class User
{
    function getUsers($conn)
    {
        $sql = "SELECT * FROM `users`";
        $users = $conn->query($sql);
        return $users;
    }

    function getUser($conn, $id)
    {

        $sql = "SELECT * FROM `users` WHERE `id` = '$id' ";
        $user = $conn->query($sql);
        if ($user->num_rows > 0) {
            // user id is correct and have one user 
            $row = $user->fetch_assoc();
            return $row;
        }
        // means no user found; 
        return null;
    }

    function getUserByUserName($conn, $userName)
    {

        $sql = "SELECT * FROM `users` WHERE `user_name` = '$userName' ";
        $user = $conn->query($sql);
        if ($user->num_rows > 0) {
            // user id is correct and have one user 
            $row = $user->fetch_assoc();
            return $row;
        }
        // means no user found; 
        return null;
    }

    function getUserQueue($conn, $id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = '$id' ";
        $user = $conn->query($sql);
        if ($user->num_rows > 0) {
            // user id is correct and have one user 
            $row = $user->fetch_assoc();
            $queue = explode(',', $row['queue']);
            return $queue;
        }
        // means no user found; 
        return null;
    }
}
