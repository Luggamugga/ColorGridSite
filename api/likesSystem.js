let prevUrl = window.location.href;

$(".likeButt").on("click", function (e) {
    e.preventDefault();
    let url = "likesProcess.php";
    let conVal = $(this).val();
    let val = conVal.split(".");

    console.log(val);
    $.ajax({
            url: url,
            type: 'post',
            method: 'POST',
            data: {
                'like': val[0],
                'userid': val[1]
            },
            success: function (data) {
                window.location.href = "index.php";
            },
            error: function (data) {
                console.log("didnt work");
            }
        }
    )
})
$(".dislikeButt").on("click", function (e) {
    e.preventDefault();
    let url = "likesProcess.php";
    let conVal = $(this).val();
    let val = conVal.split(".");
    console.log(val);
    $.ajax({
        url: url,
        type: 'post',
        data: {
            'dislike': val[0],
            'userid': val[1]
        },
        success: function (data) {
            window.location.href = "index.php";
        },
        error: function (data) {
            console.log("err")
        }
    })
})

let staticLikesDiv = document.getElementsByClassName("staticLikesDiv");
for (let i = 0; i < staticLikesDiv.length; i++) {
    staticLikesDiv[i].addEventListener("click", (e) => {
        alert("you need to be logged in to like/dislike a grid!")
    });
}

