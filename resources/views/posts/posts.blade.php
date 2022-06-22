<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new Post modal start --}}
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_post_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">

          <div class="my-2">
            <label for="post_category_id">Category</label>
            {{-- <input type="text" name="post_category_id" class="form-control" placeholder="Input Category" required> --}}
            <select class="form-control" name="post_category_id"
                                        id="post_category_id">
                                        <option value="">- Select Category -</option>
                                        @if(sizeof($PostCategories) > 0)
                                        @foreach($PostCategories as $PostCategory)
                                        <option value="{{ $PostCategory->post_category_id }}">
                                            {{ $PostCategory->post_category_title }}</option>
                                        @endforeach
                                        @endif
                                    </select>
        </div>

          <div class="my-2">
            <label for="post_title">Title</label>
            <input type="text" name="post_title" class="form-control" placeholder="Input Title" required>
          </div>

          <div class="my-2">
            <label for="post_content">Content</label>
            <input type="text" name="post_content" class="form-control" placeholder="Input Content" required>
          </div>

          <div class="my-2">
            <label for="post_image">Image</label>
            <input type="text" name="post_image" class="form-control" placeholder="Input Image" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_post_btn" class="btn btn-primary">Add Post</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Post modal end --}}

{{-- edit Post modal start --}}
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_post_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" id="post_id">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="post_category_id">Category</label>
                {{-- <input type="text" name="post_category_id" id="post_category_id" class="form-control" placeholder="Input Category" required> --}}
                <select class="form-control" name="post_category_id"
                                        id="post_category_id">
                                        <option value="">- Select Category -</option>
                                        @if(sizeof($PostCategories) > 0)
                                        @foreach($PostCategories as $PostCategory)
                                        <option value="{{ $PostCategory->post_category_id }}">
                                            {{ $PostCategory->post_category_title }}</option>
                                        @endforeach
                                        @endif
                                    </select>
            </div>

              <div class="my-2">
                <label for="post_title">Title</label>
                <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Input Title" required>
              </div>

              <div class="my-2">
                <label for="post_content">Content</label>
                <input type="text" name="post_content" id="post_content" class="form-control" placeholder="Input Content" required>
              </div>

              <div class="my-2">
                <label for="post_image">Image</label>
                <input type="text" name="post_image" id="post_image" class="form-control" placeholder="Input Image" required>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_post_btn" class="btn btn-success">Update Post</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Post modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Post</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPostModal"><i
                class="bi-plus-circle me-2"></i>Add New Post</button>
          </div>
          <div class="card-body" id="show_all_posts">
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

      // add new Post ajax request
      $("#add_post_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_post_btn").text('Adding...');
        $.ajax({
          url: '{{ route('storePost') }}',
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
                'Post Added Successfully!',
                'success'
              )
              fetchAllPosts();
            }
            $("#add_post_btn").text('Add Post');
            $("#add_post_form")[0].reset();
            $("#addPostModal").modal('hide');
          }
        });
      });

      // edit Post ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editPost') }}',
          method: 'get',
          data: {
            post_id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#post_category_id").val(response.post_category_id);
            $("#post_title").val(response.post_title);
            $("#post_content").val(response.post_content);
            $("#post_image").val(response.post_image);
            $("#post_id").val(response.post_id);
          }
        });
      });

      // update Post ajax request
      $("#edit_post_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_post_btn").text('Updating...');
        $.ajax({
          url: '{{ route('updatePost') }}',
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
                'Post Updated Successfully!',
                'success'
              )
              fetchAllPosts();
            }
            $("#edit_post_btn").text('Update Post');
            $("#edit_post_form")[0].reset();
            $("#editPostModal").modal('hide');
          }
        });
      });

      // delete Post ajax request
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
              url: '{{ route('deletePost') }}',
              method: 'delete',
              data: {
                post_id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllPosts();
              }
            });
          }
        })
      });

      // fetch all Posts ajax request
      fetchAllPosts();

      function fetchAllPosts() {
        $.ajax({
          url: '{{ route('fetchPost') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_posts").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
</body>

</html>
