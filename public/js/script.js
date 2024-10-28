$(document).on('click','.go_to_email_step', function(){
    $(".first_step_login").removeClass('flex').addClass('hidden');
    $(".email_step_login").removeClass('hidden').addClass('flex');
    });
    $(document).on('click','.go_to_username_step', function(){
        $(".first_step_login").removeClass('flex').addClass('hidden');
        $(".username_step_login").removeClass('hidden').addClass('flex');
        });
    $(document).on('click','.back_login', function(){
        $(".email_step_login").removeClass('flex').addClass('hidden');
        $(".username_step_login").removeClass('flex').addClass('hidden');
        $(".first_step_login").removeClass('hidden').addClass('flex');
        });
        $("#categorySearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".cat_boxes").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });