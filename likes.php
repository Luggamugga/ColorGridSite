<?php
if (isset($_SESSION["userid"])):
    echo "<form class='likesForm'><div class='likesFormContainer'>";
    if (checkIfUsrLiked($gridId, $sessUsrId)) {
        echo "<div class='likesDiv'><button><img class='like' src='img/like.jpeg'></button>";
    } else {
        echo "<div class='likesDiv'><button class='likeButt' type='submit'  name='like' value='" . $gridId . "." . $sessUsrId . "'><img class='like' src='img/like.jpeg'></button>";
    }
    echo showLikes($gridId) . "</div>";
    if (checkIfUsrDisliked($gridId, $sessUsrId)) {
        echo "<div class='dislikesDiv'><button><img class='dislike' src='img/dislike.jpeg'></button>";
    } else {
        echo "<div class='dislikesDiv'><button class='dislikeButt' type='submit' name='dislike' value='" . $gridId . "." . $sessUsrId . "'><img class='dislike' src='img/dislike.jpeg'></button>";
    }
    echo showDislikes($gridId) . "</div>";
    echo "</div></form>";
else:
    echo "<div class='staticLikesDiv'><div class='likesFormContainer'>";
    echo "<div class='likesDiv'><button><img class='like' src='img/like.jpeg'></button>";
    echo showLikes($gridId) . "</div>";
    echo "<div class='dislikesDiv'><button><img class='dislike' src='img/dislike.jpeg'></button>";
    echo showDislikes($gridId) . "</div></div></div>";
endif;
?>