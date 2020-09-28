var Event = function () {

    this.__construct = function () {

      this.adminForm();

      this.logout();

      this.commonForm();

      this.docsForm();

      this.wrapper();

    //   this.deleteItem();

    //   this.blockuser();

    //   this.finalDeactive();

    //   this.changeStatus();

    //   this.sendNotificationSubmit();

    };

    

    this.adminForm = function(){

        $(document).on('submit', '#login-form, #forgot-form, #reset-form', function(e){

            e.preventDefault();

            var url = $(this).attr("action");

            var postdata = $(this).serialize();

            $.post(url, postdata, function (out) {

                $(".wrap-input100 > .error").remove();

                if (out.result === 0) {

                    var a = 1;

                    for (var i in out.errors) {

                        $("#" + i).parents(".wrap-input100").append('<span class="error text-danger">' + out.errors[i] + '</span>');

                        if(a == 1){

                            $("#" + i).focus();

                        }

                        a++;

                    }

                }

                if (out.result === -1) {

                    var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';

                    $("#error_msg").removeClass('alert-warning alert-success admin_chk_suc').addClass('alert alert-danger alert-dismissable admin_chk_dng').show();

                    $("#error_msg").html(message + out.msg);

                    $("#error_msg").fadeOut(2000);

                }

                if (out.result === 1) {

                    var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';

                    $("#error_msg").removeClass('alert-danger alert-danger admin_chk_dng').addClass('alert alert-success alert-dismissable admin_chk_suc').show();

                    $("#error_msg").html(message + out.msg);

                    $("#error_msg").fadeOut(2000);

                    window.setTimeout(function () {

                        window.location.href = out.url;

                    }, 1000);

                }

            });

        })

    }



    this.logout = function(){

        $(document).on('click', '#logout', function (evt) {

            evt.preventDefault();

            var url = $(this).attr('href');

            swal({

                title: "Logout.?",

                text: "Are you sure you want to Logout?",

                icon: "warning",

                buttons: true,

                dangerMode: true,

            })

            .then((willDelete) => {

                if (willDelete) {

                    $.post(url, '', function (out) {

                        if (out.result === 1) {

                            window.location.href = out.url;

                        } else if (out.result === -1) {

                            swal(out.msg);

                        }

                    });

                } 

                else {

                    swal("You are safe in dashboard panel!!");

                }

            });

        });

    }



    this.commonForm = function(){

        $(document).on('submit', '#common-form', function(e){

            e.preventDefault();

            var url = $(this).attr("action");

            var err = $(this).prepend("<div id='error_msg'></div>");

            var postdata = $(this).serialize();

            $.post(url, postdata, function (out) {

                $(".form-group > .error").remove();

                if (out.result === 0) {

                    var a = 1;

                    for (var i in out.errors) {

                        $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');

                        if(a == 1){

                            $("#" + i).focus();

                        }

                        a++;

                    }

                }

                if (out.result === -1) {

                    var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';

                    $("#error_msg").removeClass('alert-warning alert-success admin_chk_suc').addClass('alert alert-danger alert-dismissable admin_chk_dng').show();

                    $("#error_msg").html(message + out.msg);

                    $("#error_msg").fadeOut(2000);

                }

                if (out.result === 1) {

                    var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';

                    $("#error_msg").removeClass('alert-danger alert-danger admin_chk_dng').addClass('alert alert-success alert-dismissable admin_chk_suc').show();

                    $("#error_msg").html(message + out.msg);

                    $("#error_msg").fadeOut(2000);

                    window.setTimeout(function () {

                        window.location.href = out.url;

                    }, 1000);

                }

            });

        })

    }

    this.docsForm = function(){
        $("#fileupload-form").submit(function (evt) {
            evt.preventDefault();
            $.ajax({

                url: $(this).attr("action"),

                type: "post",

                data: new FormData(this),

                processData: false,

                contentType: false,

                cache: false,

                async: true,

                success: function (out) {
                    $(".form-group > .error").remove();

                    if (out.result === 0) {

                        for (var i in out.errors) {

                            $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');

                            $("#" + i).focus();

                        }

                    }

                    if (out.result === -1) {

                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();

                        $("#error_msg").html(message + out.msg);

                        $("#error_msg").fadeOut(2000);

                    }

                    if (out.result === 1) {

                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

                        $("#error_msg").removeClass('alert-warning alert-danger').addClass('alert alert-success alert-dismissable').show();

                        $("#error_msg").html(message + out.msg);

                        $("#error_msg").fadeOut(5000);

                        window.setTimeout(function () {

                            window.location.href = out.url;

                        }, 3000);

                    }

                }

            });

        });

    }

    this.wrapper = function(){
        $(document).on('click', '#content-wrapper', function (evt) {
            evt.preventDefault();

            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#loadcontent_wrapper').html(out.content_wrapper);
                    $('#myModal').modal('show');
                }
            });
            
        });

        $(document).on('submit', '#crdits-form', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .text-danger").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="text-danger">' + out.errors[i] + '</span>');
                    }
                }
                if (out.result === 1) {
                    window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 1000);
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $(".error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(2000);
                }
            });
        });
    }



    this.deleteItem = function(){

        $(document).on('click', '.delete-item', function(e){

            e.preventDefault();  

            var url = $(this).attr("href");

            swal({

                title: "Do you really want to Delete?",

                icon: "warning",

                buttons: true,

                dangerMode: true,

                closeOnClickOutside: false,

            }) 

            .then((willDelete) => {

                if (willDelete) {

                    $.post(url, '', function (out) {

                        if (out.result === 1) {

                            window.location.href = out.url;

                        }

                    });

                }

            });

        });

    };

 

    this.blockuser = function(){

        $(document).on('change', '.seller_status',function (e){

            e.preventDefault();

            let name = $(this).val();

            let url = $(this).data('url');

            $.post(url, {name: name}, function (out) {

                if(out.result === 1){

                    swal(out.msg);

                }

                if(out.result === -1){

                    swal(out.msg);

                }

            });

        });   

    }

  

    this.finalDeactive = function(){

        $(document).on('click', '.finalDeactive', function(e){

            e.preventDefault();

            var url = $(this).attr("href");

            swal({

                title: "Do you really want to Delete?",

                icon: "warning",

                buttons: true,

                dangerMode: true,

                closeOnClickOutside: false,

            })

            .then((willDelete) => {

                if (willDelete) {

                    $.post(url, '', function (out) {

                        $(".form-group > .error").remove();

                        if (out.result === 0) {

                        var a = 1;

                        for (var i in out.errors) {

                            $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');

                            if(a == 1){

                                $("#" + i).focus();

                            }

                            a++;

                        }

                    }

                    if (out.result === -1) {

                        var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';

                        $("#error_msg").removeClass('alert-warning alert-success admin_chk_suc').addClass('alert alert-danger alert-dismissable admin_chk_dng').show();

                        $("#error_msg").html(message + out.msg);

                        $("#error_msg").fadeOut(2000);

                    }

                    if (out.result === 1) {

                        var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';

                        $("#error_msg").removeClass('alert-danger alert-danger admin_chk_dng').addClass('alert alert-success alert-dismissable admin_chk_suc').show();

                        $("#error_msg").html(message + out.msg);

                        $("#error_msg").fadeOut(2000);

                        window.setTimeout(function () {

                            window.location.href = out.url;

                        }, 1000);

                    }

                });

                }

            });

        });

    }
 
    this.changeStatus = function () {

        $(document).on('click', '.change-status', function (e) {

            e.preventDefault();

            var url = $(this).attr("href");

            $.post(url, function (out) {

                if (out.result === 0) {

                    for (var i in out.errors) {

                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');

                        $("#" + i).focus();

                    }

                }

                if (out.result === -1) {

                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();

                    $("#error_msg").html(message + out.msg);

                    $("#error_msg").fadeOut(2000);

                }

                if (out.result === 1) {

                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

                    $("#error_msg1").removeClass('alert-warning alert-danger').addClass('alert alert-success alert-dismissable').show();

                    $("#error_msg1").html(message + out.msg);

                    $("#error_msg1").fadeOut(5000);

                    window.setTimeout(function () {

                        window.location.href = out.url;

                    }, 3000);

                }

            });

        });

    };

      

    this.sendNotificationSubmit = function () {

        $(document).on('click', '.notify', function (evt) {

            evt.preventDefault();

            if ($('.user_id:checked').length > 0) {

                var url = $(this).attr('href');

                var user_id = [];

                $.each($(".user_id:checked"), function () {

                    user_id.push($(this).val());

                });

                $.post(url, {user_id: user_id}, function (out) {

                    if (out.result === 1) {

                        $('#send-notification-wrapper').html(out.notification_wrapper);

                        $('#notificationModal').modal('show');

                    }

                });

            } else {

                swal("Please select ...", "A user to send Message!");

            }

        });

        $(document).on('click', '.check', function () {

            if($(this).prop("checked") === true){

                $(".user_id").prop("checked", true);

            }

            else if($(this).prop("checked") === false){

                $(".user_id").prop("checked", false);

            }

        });

          

        $(document).on('submit', '#send-notification', function (evt) {

            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {

                $(".form-group > .text-danger").remove();

                if (out.result === 0) {

                    for (var i in out.errors) {

                        $("#" + i).parents(".form-group").append('<span class="text-danger">' + out.errors[i] + '</span>');

                    }

                }

                if (out.result === 1) {

                    $('#notificationModal').modal('hide');

                    swal( out.msg);

                    // var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

                    // $(".error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();

                    // $(".error_msg").html(message + out.msg);

                    // $(".error_msg").fadeOut(2000);

                }

                if (out.result === -1) {

                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

                    $(".error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();

                    $(".error_msg").html(message + out.msg);

                    $(".error_msg").fadeOut(2000);

                }

            });

        });

    };

       

    this.__construct();
};

  

  var obj = new Event();