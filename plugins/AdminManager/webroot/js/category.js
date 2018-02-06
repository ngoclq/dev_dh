$(document).ready(function() {
    $( window ).on( "click", ".btnAction", function() {

        var targeturl = $(this).attr('rel').val();
        if ( typeof pagetype === 'undefined') {
            return true;
        }
        $.ajax({
            type: 'post',
            url: targeturl,
            beforeSend: function(xhr) 
            {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) 
            {
                if (response.result) 
                {
                    var result = response.result;
                    $('#result').html(result.now);
                }
            },
            error: function(e) 
            {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    });
});

