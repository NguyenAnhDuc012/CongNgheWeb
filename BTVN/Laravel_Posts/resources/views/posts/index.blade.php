<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Posts Crud</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Posts</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('posts.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Post</span></a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="edit"><i class="material-icons">&#xE254;</i></a>
                                <a href="#deletePostModal" data-id="{{ $post->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix d-flex justify-content-start">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deletePostModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deletePostForm" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Post</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this post?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Khi nhấn vào nút xóa
            $('.delete').on('click', function() {
                var postId = $(this).data('id'); // Lấy ID từ thuộc tính data-id
                var actionUrl = "{{ route('posts.destroy', ':id') }}"; // URL của action delete, :id sẽ thay thế bằng ID cụ thể

                // Thay thế :id trong URL với postId
                actionUrl = actionUrl.replace(':id', postId);

                // Cập nhật lại action của form trong modal
                $('#deletePostForm').attr('action', actionUrl);
            });
        });
    </script>
</body>

</html>