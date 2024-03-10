<?php 

include('middleware.php');
include('./db_connection.php');


include('./header.php'); 
?>

<!-- <div class="container">
<div class="card-body">
	<form action="" id="manage-task">
        <div class="form-group">
            <textarea class="form-control" name="your_summernote" id="your_summernote"></textarea>
        </div>
        <button type=”submit” class="btn btn-danger btn-block">Save</button>
	</form>
    </div>
</div> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-left font-weight-light ">New Task</h3></div>
                    <div class="card-body">
                        <form method="POST" action="create_project.php" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Task</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" type="text" name="name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Description</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id ="summernote" type="text" name="name" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height:200
            })
            $('.dropdown-toggle').dropdown();
        });
    </script>