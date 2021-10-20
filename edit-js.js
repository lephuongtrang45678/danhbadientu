$(document).ready(function(e) {
    $("#fileToUpload").on('change', (function() {
        var img = $("#fileToUpload")[0].files[0];
        var DL = new FormData();
        DL.append("fileToUpload", img)
        $.ajax({
            url: "ajax-upload.php",
            type: "POST",
            data: DL,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function(data) {
                if (data == 'invalid') {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                } else {
                    // view uploaded file.
                    $("#preview").html(data).fadeIn();
                    // $("#form")[0].reset();
                }
            },
            error: function(e) {
                $("#err").html(e).fadeIn();
            }
        });
    }));
    $('#upload_csv').on("submit", function(e) {
        e.preventDefault(); //form will not submitted  
        $.ajax({
            url: "import.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, // The content type used when sending data to the server.  
            cache: false, // To unable request pages to be cached  
            processData: false, // To send DOMDocument or non processed data file it is set to false  
            success: function(data) {
                if (data == 'Error1') {
                    alert("Invalid File");
                } else if (data == "Error2") {
                    alert("Please Select File");
                } else {
                    $('#table-nhanvien').html(data);
                }
            }
        })
    });
});