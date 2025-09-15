<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sosial Media</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .auth-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .post-container {
            max-width: 600px;
            margin: 20px auto;
        }
        .post-card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .post-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .post-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .post-body img {
            width: 100%;
            height: auto;
        }
        .post-actions {
            padding: 10px 15px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 15px;
        }
        .post-actions button {
            background: none;
            border: none;
            color: #555;
            cursor: pointer;
        }
        .post-actions button:hover {
            color: #0d6efd;
        }
        .post-stats, .post-comments {
            padding: 0 15px 15px;
        }
        .comment {
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .dummy-user-pic {
            background-color: #ccc;
        }
    </style>
</head>
<body>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let activePostId = null;

            // Function to handle switching between forms
            $('#showRegister').click(function(e) {
                e.preventDefault();
                $('#loginForm').fadeOut(300, function() {
                    $('#registerForm').fadeIn(300);
                });
            });

            $('#showLogin').click(function(e) {
                e.preventDefault();
                $('#registerForm').fadeOut(300, function() {
                    $('#loginForm').fadeIn(300);
                });
            });

            // Handle login form submission
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                // Simple dummy login: hide auth form and show posts
                $('#authSection').fadeOut(500, function() {
                    $('#postsSection').fadeIn(500);
                });
            });
            
            // Dummy logic for 'like' button
            $('.like-btn').click(function() {
                let $this = $(this);
                let $icon = $this.find('i');
                let $likesCount = $this.closest('.card').find('.likes-count');
                let currentLikes = parseInt($likesCount.text().replace(/\D/g, ''));
                
                if ($icon.hasClass('fas')) {
                    // Already liked, unlike it
                    $icon.removeClass('fas').addClass('far');
                    $this.css('color', '#555');
                    $likesCount.text(`${currentLikes - 1} Suka`);
                } else {
                    // Not liked, like it
                    $icon.removeClass('far').addClass('fas');
                    $this.css('color', '#dc3545'); // Red color for liked state
                    $likesCount.text(`${currentLikes + 1} Suka`);
                }
            });

            // Logic to handle comment modal
            $('.comment-btn').click(function() {
                // Get the data-post-id of the clicked post
                activePostId = $(this).closest('.card').data('post-id');
            });

            // Logic to handle comment submission
            $('#submitComment').click(function() {
                const commentText = $('#comment-text').val().trim();
                if (commentText === '') {
                    // Do nothing if comment is empty
                    return;
                }

                // Get the correct post element using the stored activePostId
                const $targetPost = $(`.card[data-post-id='${activePostId}']`);

                // Create the new comment HTML
                const newCommentHtml = `<div class="comment"><b>Anda:</b> ${commentText}</div>`;

                // Append the new comment to the correct post's comment section
                $targetPost.find('.post-comments').append(newCommentHtml);

                // Update the comments count
                let $commentsCount = $targetPost.find('.comments-count');
                let currentCount = parseInt($commentsCount.data('comments-count'));
                currentCount++;
                $commentsCount.data('comments-count', currentCount);
                $commentsCount.text(`${currentCount} Komentar`);

                // Clear the textarea and close the modal
                $('#comment-text').val('');
                const commentModal = bootstrap.Modal.getInstance(document.getElementById('commentModal'));
                commentModal.hide();
            });
        });
    </script>

</body>
</html>
