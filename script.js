// Function to fetch comments and display them
function fetchComments() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "show_comment.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var commentsDiv = document.querySelector(".comments");
            commentsDiv.innerHTML = xhr.responseText;
            // Attach event listeners for edit and delete buttons
            attachEditCommentListeners();
            attachDeleteCommentListeners();
        }
    };
    xhr.send();
}
// Function to attach event listeners for editing comments
function attachEditCommentListeners() {
    var editButtons = document.querySelectorAll(".edit-comment");
    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var commentId = button.getAttribute("data-comment-id");
            var updatedComment = prompt("Enter updated comment:");
            if (updatedComment !== null) {
                updateComment(commentId, updatedComment);
            }
        });
    });
}
// Function to attach event listeners for deleting comments
function attachDeleteCommentListeners() {
    var deleteButtons = document.querySelectorAll(".delete-comment");
    deleteButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var commentId = button.getAttribute("data-comment-id");
            if (confirm("Are you sure you want to delete this comment?")) {
                deleteComment(commentId);
            }
        });
    });
}
// Function to update a comment
function updateComment(commentId, updatedComment) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_comment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            fetchComments(); // Refresh comments after updating
        }
    };
    xhr.send("comment_id=" + commentId + "&updated_comment=" + updatedComment);
}
// Function to delete a comment
function deleteComment(commentId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete_comment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            fetchComments(); // Refresh comments after deleting
        }
    };
    xhr.send("comment_id=" + commentId);
}
// Fetch comments when the page loads
window.onload = function () {
    fetchComments();
};
// Event listener for comment form submission
document.querySelector(".comment-box form").addEventListener("submit", function (event) {
    event.preventDefault();
    var username = document.getElementById("username").value;
    var comment = document.getElementById("comment").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "comment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            fetchComments(); // Refresh comments after posting
            document.getElementById("username").value = "";
            document.getElementById("comment").value = "";
        }
    };
    xhr.send("username=" + username + "&comment=" + comment);
});






