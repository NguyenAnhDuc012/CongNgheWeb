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
    <div id="addEmployeeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('issues.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Issue</h4>
                    </div>
                    <div class="modal-body">
                        <div class=form-group">
                            <label for="computer_id" class="form-label">Computer Name</label>
                            <select class="form-control" id="computer_id" name="computer_id">
                                @foreach($computers as $computer)
                                <option value="{{ $computer->id }}" {{ $computer->id == old('computer_id') ? 'selected' : '' }}>{{ $computer->computer_name }}</option>
                                @endforeach
                            </select>
                            @error('computer_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=form-group">
                            <label for="reported_by" class="form-label">Reported Person</label>
                            <input value="{{ old('reported_by') }}" type="text" class="form-control" id="reported_by" name="reported_by">
                        </div>

                        <div class=form-group">
                            <label for="reported_date" class="form-label">Reported Date</label>
                            <input value="{{ old('reported_date') }}" type="date" class="form-control" id="reported_date" name="reported_date">
                            @error('reported_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=form-group">
                            <label for="description" class="form-label">Description</label>
                            <input value="{{ old('description') }}" type="text" class="form-control" id="description" name="description">
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=form-group">
                            <label for="urgency" class="form-label">Urgency</label>
                            <select class="form-control" id="urgency" name="urgency">
                                <option value="Low" {{ 'Low' == old('urgency') ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ 'Medium' == old('urgency') ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ 'High' == old('urgency') ? 'selected' : '' }}>High</option>
                            </select>
                            @error('urgency')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Open" {{ 'Open' == old('status') ? 'selected' : '' }}>Open</option>
                                <option value="In Progress" {{ 'In Progress' == old('status') ? 'selected' : '' }}>In Progress</option>
                                <option value="Resolved" {{ 'Resolved' == old('status') ? 'selected' : '' }}>Resolved</option>
                            </select>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>