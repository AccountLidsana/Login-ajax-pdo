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
                    <h2 class="text-center">Login</h2>
                    <form id="formlogin">
                        <div class="mb-3">
                            <label for="" class="form-label">Username :</label>
                            <input type="text" class="form-control" id="u_username" name="u_username">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password :</label>
                            <input type="password" class="form-control" id="u_password" name="u_password">
                        </div>
                        <a href="index.php">ຍັງບໍ່ມີບັນຊີ ?</a>
                        <button type="submit" class="btn btn-primary w-100" name="submit" id="submit">Login</button>
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

                var login_user = new FormData(this);
                login_user.append("login_user", true);

                $.ajax({

                    url: "check.php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: login_user,
                    success: function(data) {

                        var res = JSON.parse(data);

                        if (res.status == "admin") {

                            Swal.fire({
                                title: res.msg,
                                text: "ເຂົ້າສູ່ລະບົບແອດມິນ",
                                icon: res.status,
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonText: false
                            }).then((result) => {
                                window.location.href = "admin.php";

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

                        } else if (res.status == "user") {

                            Swal.fire({
                                title: res.msg,
                                text: "ເຂົ້າສູ່ລະບົບແອດມິນ",
                                icon: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonText: false
                            }).then((result) => {
                                window.location.href = "user.php";

                            })

                        }
                    }
                })
            })

        })
        </script>
    </body>

</html>