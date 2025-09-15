<script>
    $(document).ready(function() {
        getCountryOptions();

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

    });


    function getCountryOptions() {
        const mUrlHashtag = baseUrlApi + "/countries.php";

        $.get(mUrlHashtag, function(response, status) {
            var mHtml = ""
            $.each(response, function(index, data) {
                mHtml += `<option value="${data.id}">${data.name}</option>`
            })

            $("#select-country").html(mHtml)

            $('.support-live-select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(), // fix select2 search input focus bug
                })
            })

        });
    }


    function handleRegister(endpoint, formId) {
        softSubmit(endpoint, formId, function(response) {

            window.setTimeout(function() {
                location.reload();
            }, 3000);
        });
    }


    function handleLogin(endpoint, formId) {
        softSubmit(endpoint, formId, function(response) {
            const body = response.data;
            localStorage.setItem("id", body.id);
            localStorage.setItem("email", body.email);
            localStorage.setItem("name", body.name);

            window.setTimeout(function() {
                location.replace(baseUrl+"/post.php");
            }, 3000);
        });
    }
</script>