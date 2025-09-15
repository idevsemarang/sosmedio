<script>
    $(document).ready(function() {

        getPosts();
        getHashtagOptions();

    });

    function getPosts() {
        const elementId = "#list-posts";
        const mUrlPost = baseUrlApi + "/post-list.php";
        const mUrlHashtag = baseUrlApi + "/hashtag-by-posts.php";
        const params = {};

        $(elementId).css("filter", "blur(4px)");

        $.ajax({
            url: mUrlPost,
            type: "GET",
            data: params,
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
            success: function(response) {
                $(elementId).removeAttr("style");
                var mHtml = ""
                let postIds = []
                $.each(response, function(index, data) {
                    postIds.push(data.id);
                    const initial = getInitial(data.user_name);
                    const bgColor = getColorForInitial(initial);

                    mHtml += `
                    <div class="card post-card border-0" data-post-id="1">
                        <div class="post-header">
                            <div class="avatar" style="background:${bgColor};">${initial}</div>
                            <div class="fw-bold mx-2">${data.user_name}</div>
                        </div>
                        <div class="post-body">
                            <img src="${data.image_url}" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <p class="card-text">${data.content} </p>
                                <div class="hashtag-by-post-${data.id}"></div>
                            </div>
                        </div>
                        <div class="post-stats">
                            <span class="likes-count fw-bold">${data.total_like} Suka</span> • <span class="comments-count" data-comments-count="5">${data.total_comment} Komentar</span>
                        </div>
                        <div class="post-actions">
                            <button class="like-btn"><i class="fas fa-heart"></i> Suka</button>
                            <button class="comment-btn" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comment"></i> Komentar</button>
                        </div>
                    </div>
                   `
                });

                $(elementId).html(mHtml)

                $.get(mUrlHashtag + "?post_ids=" + JSON.stringify(postIds), function(response, status) {
                    $.each(response, function(index, data) {
                        const mHashtag = `<a href="${baseUrl}/post.php?hashtag_id=${data.id}" style="text-decoration:none;">${data.hashtag_title}</a> `
                        $(".hashtag-by-post-" + data.post_id).append(mHashtag)
                    })
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $(elementId).removeAttr("style");
            },
        });
    }


    function getHashtagOptions() {
        const mUrlHashtag = baseUrlApi + "/hashtags.php";

        $.get(mUrlHashtag, function(response, status) {
            var mHtml = ""
            $.each(response, function(index, data) {
                mHtml += `<option value="${data.id}">${data.title}</option>`
            })

            $("#select-hashtag").html(mHtml)

            $('.support-live-select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(), // fix select2 search input focus bug
                })
            })

        });
    }

    function getInitial(name) {
        return name ? name.charAt(0).toUpperCase() : "?";
    }

    // assign background colors based on initial
    function getColorForInitial(initial) {
        const colors = {
            A: "#e74c3c", // red
            B: "#3498db", // blue
            C: "#27ae60", // green
            D: "#8e44ad", // purple
            E: "#f39c12", // orange
            F: "#1abc9c", // teal
            G: "#d35400", // pumpkin
            H: "#2ecc71", // emerald
            I: "#9b59b6", // amethyst
            J: "#16a085", // dark cyan
            K: "#c0392b", // dark red
            L: "#2980b9", // dark blue
            M: "#27ae60", // green
            N: "#f1c40f", // yellow
            O: "#34495e", // navy
            P: "#e67e22", // carrot
            Q: "#8e44ad", // purple
            R: "#2c3e50", // midnight
            S: "#d35400", // orange dark
            T: "#7f8c8d", // gray
            U: "#16a085", // dark teal
            V: "#c0392b", // crimson
            W: "#2980b9", // ocean blue
            X: "#27ae60", // fresh green
            Y: "#f39c12", // orange bright
            Z: "#8e44ad" // violet
        };

        const key = initial ? initial.toUpperCase() : "";
        return colors[key] || "#95a5a6"; // default light gray
    }


    function handlePosting(endpoint, formId) {
        $("#post-user_id").val(localStorage.getItem("id"));
        const myModalElement = document.getElementById('newPostModal'); 
        const myModal = bootstrap.Modal.getOrCreateInstance(myModalElement);
        myModal.hide();

        softSubmit(endpoint, formId, function(response) {
            getPosts();
        });
    }
</script>