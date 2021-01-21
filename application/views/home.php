<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css' type='text/css' rel='stylesheet'>

    <title>PHP CODE TEST</title>
  </head>
  <body>
    <h1>PHP CODE TEST</h1>

    <form id="form" action="<?php echo base_url() ?>Home/register" method="POST">
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" placeholder="First Name" id="last_name" name="last_name">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="bod">Birth of Date:</label>
                    <input type="date" class="form-control" placeholder="" id="bod" name="bod">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" rows="3" placeholder="" id="address" name="address"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="repeater">
                    <!-- Repeater Heading -->
                    <div class="repeater-heading">
                        <h5 class="pull-left">Experiences</h5>
                        <input type="button" class="btn btn-primary pull-right repeater-add-btn" id="add" name="add" value="Add Experience">
                    </div>
                    <!-- Repeater Items -->
                    <div class="items" data-group="experience">
                        <!-- Repeater Content -->
                    
                        <div class="item-content">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company_name" control-label">Company Name:</label>
                                    <input type="text" class="form-control" id="company_name" placeholder="Company Name" data-name="company_name">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="description" control-label">Description:</label>
                                    <input type="text" class="form-control" id="description" placeholder="Description" data-name="description">
                                </div>
                            </div>
                        </div>
                        <!-- Repeater Remove Btn -->
                        
                        <div class="pull-right btn repeater-remove-btn btn-danger">
                            <label>Remove</label>
                            <input type="button" class="btn remove-btn" id="remove" name="remove" value="Remove">
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <form class="dropzone" id="myDropzone" action="<?php echo base_url() ?>Home/save_portfolio" method="POST" enctype="multipart/form-data">

    </form>

    <button type="submit" class="btn btn-primary" id="submit">Submit</button>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js' type='text/javascript'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.1.1/jquery.serializejson.min.js" integrity="sha512-czywXrb/msTMh+lhgSe/vQ0GT0OraNiD8Knd7A7fMqEjDmQxljn/b39skl45eu+iyG0wxC9SuqcaUatZ4S0kdA==" crossorigin="anonymous"></script>

    <script src="assets/js/repeater.js" type="text/javascript"></script>


    <script>
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });

        // myDropzone.on("complete", function(file){
        //     console.log(file);
        // });

        var myDropzone = new Dropzone(".dropzone", { 
            url: "<?php echo base_url() ?>Home/save_portfolio",
            uploadMultiple: true,
            autoProcessQueue: false,
            parallelUploads: 20,    
            maxFilesize: 2, 
            maxFiles: 20,
            acceptedFiles: "image/*"
        });
        Dropzone.autoDiscover = false;
        

        $('#submit').click(function(e){
            e.preventDefault();

            var form = $("form").serializeJSON();
            // var dataJson = JSON.stringify(form);

            // console.log(dataJson);
            // return;

            $.ajax({
                url: '<?php echo base_url(); ?>Home/register',
                type: 'POST',
                dataType : "json",
                data: form,
                success: function(d){
                    console.log(d);
                    // var response = JSON.parse(d);
                    if(d.status){
                        var last_id = d.last_id;
                        //trigger to save portfolio here
                        // Dropzone.autoDiscover = false;
                        // var myDropzone = new Dropzone(".dropzone", { 
                        //     url: "<?php echo base_url() ?>Home/save_portfolio",
                        //     uploadMultiple: true,
                        //     autoProcessQueue: false,
                        //     maxFilesize: 2,
                        //     acceptedFiles: "image/*",
                        //     init: function(){
                                // var _this = this;
                                myDropzone.on("sending", function(file, xhr, formData){
                                    formData.append("last_id", last_id);
                                });
                                // dzClosure = this;
                                // $("#submit").on("click", function(e){
                                //     e.preventDefault();
                                //     e.stopPropagation();
                                //     dzClosure.processQueue();
                                // });
                        //     }
                        // });
                        myDropzone.processQueue();
                    }
                },
                error: function(xhr, status, error){
                    console.log('err: '+error);
                }
            });
        });


        // $("#form").submit(function( event ) {
        //     myDropzone.processQueue();
        // });
    

    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>