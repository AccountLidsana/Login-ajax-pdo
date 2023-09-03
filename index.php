<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center" style="height:100vh">
            <div class="card" style="width:40rem">
                <div class="card-body">
                    <h2 class="text-center">Register</h2>
                    <form id="formlogin">
                        <div class="mb-3">
                            <label for="" class="form-label">first name :</label>
                            <input type="text" class="form-control" id="u_firstname" name="u_firstname">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">last name :</label>
                            <input type="text" class="form-control" id="u_lastname" name="u_lastname">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">user name :</label>
                            <input type="text" class="form-control" id="u_username" name="u_username">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password :</label>
                            <input type="password" class="form-control" id="u_password" name="u_password">
                        </div>
                        <a href="login.php">ມີບັນຊີແລ້ວ</a>
                        <button type="submit" class="btn btn-primary w-100" name="submit" id="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        $(document).ready(function() {

            $(document).on("submit", "#formlogin", function(e) {

                e.preventDefault();

                var login = new FormData(this);
                login.append("register", true);

                $.ajax({

                    url: "check.php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: login,
                    success: function(data) {

                        var res = JSON.parse(data);

                        if (res.status == "success") {
                         

                            Swal.fire({
                                title: "ສະມັກບັນຊີສຳເລັດ",
                                text: res.msg,
                                icon: res.status,
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonText: false
                            })

                        } else if (res.status == "warning") {
                          
                            Swal.fire({
                                title: "ຜິດຜາດ",
                                text: res.msg,
                                icon: res.status,
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonText: false
                            })

                        } else if (res.status == 202) {
                            console.log(res.msg, res.status);
                            alert(res.msg, res.status);
                        }

                    }

                })
            })

        })
        </script>
    </body>

</html>