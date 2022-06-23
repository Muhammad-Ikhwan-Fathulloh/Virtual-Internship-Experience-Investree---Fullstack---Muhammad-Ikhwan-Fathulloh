@extends('layouts.dashboard')

@section('content')

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post Category</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new PostCategory modal start --}}
<div class="modal fade" id="addPostCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Post Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_post_category_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">


          <div class="my-2">
            <label for="post_category_title">Category</label>
            <input type="text" name="post_category_title" class="form-control" placeholder="Input Category" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_post_category_btn" class="btn btn-primary">Add PostCategory</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new PostCategory modal end --}}

{{-- edit PostCategory modal start --}}
<div class="modal fade" id="editPostCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_post_category_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_category_id" id="post_category_id">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="post_category_title">Kategori</label>
                <input type="text" name="post_category_title" id="post_category_title" class="form-control" placeholder="Masukkan Kategori" required>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_post_category_btn" class="btn btn-success">Update PostCategory</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit PostCategory modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Post Category</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPostCategoryModal"><i
                class="bi-plus-circle me-2"></i>Add New Post Category</button>
          </div>
          <div class="card-body" id="show_all_post_categories">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {

      // add new PostCategory ajax request
      $("#add_post_category_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_post_category_btn").text('Adding...');
        $.ajax({
          url: '{{ route('storePostCategory') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Post Category Added Successfully!',
                'success'
              )
              fetchAllPostCategories();
            }
            $("#add_post_category_btn").text('Add Post Category');
            $("#add_post_category_form")[0].reset();
            $("#addPostCategoryModal").modal('hide');
          }
        });
      });

      // edit PostCategory ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editPostCategory') }}',
          method: 'get',
          data: {
            post_category_id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#post_category_title").val(response.post_category_title);
            $("#post_category_id").val(response.post_category_id);
          }
        });
      });

      // update PostCategory ajax request
      $("#edit_post_category_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_post_category_btn").text('Updating...');
        $.ajax({
          url: '{{ route('updatePostCategory') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Post Category Updated Successfully!',
                'success'
              )
              fetchAllPostCategories();
            }
            $("#edit_post_category_btn").text('Update Post Category');
            $("#edit_post_category_form")[0].reset();
            $("#editPostCategoryModal").modal('hide');
          }
        });
      });

      // delete PostCategory ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('deletePostCategory') }}',
              method: 'delete',
              data: {
                post_category_id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllPostCategories();
              }
            });
          }
        })
      });

      // fetch all PostCategorys ajax request
      fetchAllPostCategories();

      function fetchAllPostCategories() {
        $.ajax({
          url: '{{ route('fetchPostCategory') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_post_categories").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
</body>

@endsection
