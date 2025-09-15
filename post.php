<?php include "header.php" ?>

<div class="bg-white p-2 shadow-sm m-2 rounded-3">
    <div class="row">
        <div class="col-lg-4 col-2">
            <b style="font-size: 26px;" class="text-success mx-2">S</b><span class="d-lg-inline d-none">osmedio</span>
        </div>
        <div class="col-lg-4 col-8">
            <input type="text" name="" class="form-control" placeholder="Cari apapun..." id="">
        </div>
        <div class="col-lg-4 col-2">
            <div class="avatar float-end" id="initial-username" style="background:red;">J</div>
        </div>
    </div>
</div>

<div id="postsSection" class="container post-container">
    <div id="list-posts"></div>
</div>

<button id="button-new-post" class="btn btn-success rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#newPostModal">New Post</button>

<!-- Modal untuk Menambah Komentar -->

<div class="modal fade" id="newPostModal" tabindex="-1" aria-labelledby="newPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="commentModalLabel">Postingan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="postingForm">
                    <div class="mb-3">
                        <label for="comment-text" class="col-form-label">Gambar</label>
                        <input type="text" class="form-control" name="image_url">
                    </div>
                    <div class="mb-3">
                        <label for="comment-text" class="col-form-label">Content</label>
                        <textarea class="form-control" name="content" id="comment-text" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="comment-text" class="col-form-label">Hashtag</label>
                        <select name="hashtag_ids[]" class="form-control support-live-select2" id="select-hashtag" multiple="multiple"></select>
                    </div>
                    <input type="hidden" name="user_id" id="post-user_id">
                    <button type="button" id="btn-for-postingForm" class="btn btn-success w-100" onclick="handlePosting('post-create.php', 'postingForm')">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="commentModalLabel">Tambahkan Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="commentForm">
                    <div class="mb-3">
                        <label for="comment-text" class="col-form-label">Komentar:</label>
                        <textarea class="form-control" id="comment-text" rows="3" required></textarea>
                    </div>

                    <button type="button" class="btn btn-success" id="submitComment">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$pushScripts = "extends/post-scripts.php";

include "footer.php";
?>