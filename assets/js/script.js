const baseUrl = "http://localhost/workshop/sosmedio";
const baseUrlApi = baseUrl+"/api";


function initializePage() {
  const currentUrl = window.location.href;
  const authUrl = baseUrl + "/auth.php";
  const postId = localStorage.getItem("id");

  if (postId && currentUrl === authUrl) {
    window.location.replace(baseUrl + "/post.php");
  } 
  else if (!postId && currentUrl !== authUrl) {
    window.location.replace(authUrl);
  }
}


function initializeIndexPage() {
  if (localStorage.getItem("id")) {
    window.location.replace(baseUrl + "/post.php");
  } else{
    window.location.replace(baseUrl + "/auth.php");
  }
}


function softSubmit(endpoint, formId, callback = false) {
  var initText = $("#btn-for-" + formId).html();

  var prefix = $("#btn-for-" + formId).attr("prefix");
  $("#btn-for-" + formId).html("Processing...");
  $("#btn-for-" + formId).attr("disabled", "disabled");

  var formData = new FormData($("#" + formId)[0]);
  var url = baseUrlApi + "/" + endpoint;
  $(".alert-message").remove();

  $.ajax({
    type: "POST",
    url: url,
    data: formData,
    headers: {
      Authorization: "Bearer " + localStorage.getItem("token"),
    },
    contentType: false,
    processData: false,
    success: function (response) {
      $("#btn-for-" + formId).removeAttr("disabled");
      $("#btn-for-" + formId).html(initText);

      if (response.success) {
        messageAlertGeneral("#" + formId, response.message, "success");

        if (typeof callback === "function") {
          callback(response);
        }
      } else {
        var typeAlert = response.alert ? response.alert : "danger";
        messageAlertGeneral("#" + formId, response.message, typeAlert);
      }
    },
    error: function (xhr, status, error) {
      $("#btn-for-" + formId).html(initText);
      $("#btn-for-" + formId).removeAttr("disabled");

      var messageErr = "Something Went Wrong";
      if (xhr.responseJSON) {
        messageErr = xhr.responseJSON.message;
      }
      messageAlertGeneral("#" + formId, messageErr);

      $.each(xhr.responseJSON.data, function (index, error) {
        var currentID = $("#" + prefix + "-" + index);
        $(currentID).css({
          border: "1px solid #c74266",
        });
        messageErrorForm(currentID, error);
      });
    },
  });
}


function messageAlertGeneral(currentID, message, type = "danger") {
  $("<div class='alert-message alert alert-" + type + "'>" + message + "</div>")
    .insertBefore(currentID)
    .hide()
    .show("medium");

  window.setTimeout(function () {
    $(".alert")
      .fadeTo(500, 0)
      .slideUp(500, function () {
        $(this).remove();
      });
  }, 6000);
}

function messageErrorForm(currentID, message) {
  $(
    "<div class='alert-message' style='color:#c74266; float:right; font-size:12px;'>" +
      message +
      "</div>"
  )
    .insertBefore(currentID)
    .hide()
    .show("medium");
}