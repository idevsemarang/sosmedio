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
            <div class="dropdown">
                <button class="btn btn-danger rounded-4 dropdown-toggle float-end" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><button class="dropdown-item text-danger" onclick="doLogout()" type="button">Logout</button></li>
                </ul>
            </div>
            
        </div>
    </div>
</div>

<div id="postsSection" class="container post-container">
    <div id="list-posts"></div>
</div>

<button id="button-new-post" class="btn btn-success rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#newPostModal"> <i class="fas fa-pencil"></i> New Post</button>

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
                <h5 class="modal-title text-white" id="commentModalLabel">Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="commentForm">
                    <div class="mb-3">
                        <textarea class="form-control" name="content" placeholder="Komentar Anda..." id="comment-text" rows="2" required></textarea>
                    </div>

                    <input type="hidden" name="user_id" id="cmn-user_id">
                    <input type="hidden" name="post_id" id="cmn-post_id">

                    <button type="button" id="btn-for-commentForm" class="btn btn-success" onclick="handleComment('comment-create.php', 'commentForm')">Kirim</button>
                </form>

                <hr>
                <div id="list-comment" class="p-2">
                    <div class="rounded-4 bg-gray mb-3 bg-smooth-green py-2 px-3">
                        <b>Johny Elyas</b> <small class="float-end">2025-09-16 10:20:22</small><br>
                        <p class="mb-1">Wow mantap man</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$pushScripts = "extends/post-scripts.php";

include "footer.php";
?>