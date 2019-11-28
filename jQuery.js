jQuery(document).ready(function() {
  jQuery(".get-id").click(function() {
    const id = parseInt(jQuery(this).attr("id"));
    const url = document.location.href;

    jQuery.post(
      url,
      {
        id: id,
        security: 1
      },
      function(data, status) {
        if (status === "success") {
          jQuery("body:eq(0)").html(data);
          jQuery(".modal").css({ display: "block" });
        }
      }
    );
  });

  jQuery("#close-button").click(function() {
    jQuery(".modal").css({ display: "none" });
  });
});
