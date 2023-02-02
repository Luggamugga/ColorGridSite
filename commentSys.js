let addComment = document.querySelector(".addCommentContainer")
let addCommentClick = document.querySelector(".NewCommentClick")
let hideButt = document.querySelector(".hide");
addComment.style.display = "none";
hideButt.style.display = "none"
addCommentClick.style.display = "block";
addCommentClick.addEventListener("click",(e)=>{
    addComment.style.display = "grid";
    hideButt.style.display = "block";
    addCommentClick.style.display = "none";
    hideButt.addEventListener("click",(e)=>{
        addComment.style.display = "none";
        hideButt.style.display = "none"
        addCommentClick.style.display = "block";
    })

})
