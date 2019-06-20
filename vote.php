<?php
$link = mysqli_connect("", "", "", "");
$id = $_REQUEST['postid'];
$username = $_REQUEST['username'];
$points = $_REQUEST['vote'];
// validates voting points value
if (!($points >= -1 && $points <= 1)) {
    $points = 0;
}
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$vote = "INSERT INTO t164053_pluses (username, newsid, score)
                    VALUES ('$username', '$id', $points)";
$check = "SELECT * FROM t164053_pluses
                    WHERE newsid='$id' AND username='$username'";
// finds row where given user has voted for given news article
$result = mysqli_query($link, $check);
$row = mysqli_fetch_array($result);
// checks if user has already voted
if($result->num_rows === 0) {
    // not yet voted, will vote for first time
    echo "New vote";
    mysqli_query($link, $vote);
    if ($points == 1) {
        $updatenews = "UPDATE t164053_news SET score=$points, upvotes=upvotes+1 WHERE id='$id'";
    } elseif ($points == -1) {
        $updatenews = "UPDATE t164053_news SET score=$points, downvotes=downvotes-1 WHERE id='$id'";
    }
    mysqli_query($link, $updatenews);
//user has already voted
} elseif ($result->num_rows > 0) {
    $currentvote = $row['score'];
    // if user hasn't already voted in this manner, new score will be added
    if ($currentvote != $points) {
        $update = "UPDATE t164053_pluses SET score=score + $points WHERE newsid='$id' AND username='$username'";
        if ($points == 1 && $currentvote == -1) {
            $updatenews = "UPDATE t164053_news SET score=score + $points, downvotes=downvotes-1 WHERE id='$id'";
        } elseif ($points == -1 && $currentvote == 1) {
            $updatenews = "UPDATE t164053_news SET score=score + $points, upvotes=upvotes-1 WHERE id='$id'";
        } elseif ($points == -1 && $currentvote == 0) {
            $updatenews = "UPDATE t164053_news SET score=score + $points, downvotes=downvotes+1 WHERE id='$id'";
        } elseif ($points == 1 && $currentvote == 0) {
            $updatenews = "UPDATE t164053_news SET score=score + $points, upvotes=upvotes+1 WHERE id='$id'";
        }
        mysqli_query($link, $update);
        mysqli_query($link, $updatenews);
        echo "Vote changed";
    } else {
        echo "Already voted this way";
    }
} else {
    echo "ERROR: Could not able to execute $up. " . mysqli_error($link);
}
