<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntigoAPI Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <header class="my-4">
            <h1>IntigoAPI Management</h1>
        </header>

        <!-- Creators Section -->
        <section class="creator-section mb-4">
            <h2>Creators</h2>
            <button onclick="showAddCreatorModal()" class="btn btn-primary mb-2">Add Creator</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($creators as $creator)
                        <tr>
                        <td>
                            <img src="{{ asset($creator->profile_photo) }}" alt="Profile Photo" style="width: 50px; height: 50px; border-radius: 50%;">
                        </td>
                            <td>{{ $creator->name }}</td>
                            <!-- Tampilkan atribut lain -->
                            <td>
                            <button onclick="showEditCreatorModal({{ $creator->id }})" class="btn btn-sm btn-secondary">Edit</button>
                                <button onclick="deleteCreator({{ $creator->id }})" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Meetings Section -->
        <section class="meeting-section">
            <h2>Meetings</h2>
            <button onclick="showAddMeetingModal()" class="btn btn-primary mb-2">Add Meeting</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meetings as $meeting)
                        <tr>
                            <td>{{ $meeting->title }}</td>
                            <!-- Tampilkan atribut lain -->
                            <td>
                                <button onclick="showEditMeetingModal({{ $meeting->id }})" class="btn btn-sm btn-secondary">Edit</button>
                                <button onclick="deleteMeeting({{ $meeting->id }})" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>  
    
<!-- Modal for Add/Edit Creator -->
<div class="modal fade" id="creatorModal" tabindex="-1" role="dialog" aria-labelledby="creatorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creatorModalLabel">Add/Edit Creator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="creatorForm" method="POST" enctype="multipart/form-data">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="creatorId" name="id">

                    <div class="form-group">
                        <label for="creatorName">Name</label>
                        <input type="text" class="form-control" id="creatorName" name="name" placeholder="Enter name" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="creatorEmail">Email</label>
                        <input type="email" class="form-control" id="creatorEmail" name="email" placeholder="Enter email" required>
                    </div> -->

                    <div class="form-group">
                        <label for="creatorUsername">Username</label>
                        <input type="text" class="form-control" id="creatorUsername" name="username" placeholder="Enter username" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="creatorProfilePhoto">Profile Photo</label>
                        <input type="file" class="form-control-file" id="creatorProfilePhoto" name="profile_photo">
                    </div> -->

                    <button type="submit" class="btn btn-primary">Save Creator</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Meeting -->
<div class="modal fade" id="meetingModal" tabindex="-1" role="dialog" aria-labelledby="meetingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetingModalLabel">Add/Edit Meeting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="meetingForm" method="POST">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="meetingId" name="id">
                    
                    <div class="form-group">
                        <label for="meetingTitle">Title</label>
                        <input type="text" class="form-control" id="meetingTitle" name="title" placeholder="Enter title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="meetingDescription">Description</label>
                        <textarea class="form-control" id="meetingDescription" name="description" placeholder="Enter description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="meetingPrice">Price</label>
                        <input type="number" class="form-control" id="meetingPrice" name="price" placeholder="Enter price" required>
                    </div>

                    <div class="form-group">
                        <label for="meetingSlots">Slots</label>
                        <input type="number" class="form-control" id="meetingSlots" name="slots" placeholder="Enter number of slots" required>
                    </div>

                    <div class="form-group">
                        <label for="meetingStartAt">Start At</label>
                        <input type="datetime-local" class="form-control" id="meetingStartAt" name="start_at" required>
                    </div>

                    <div class="form-group">
                        <label for="meetingEndAt">End At</label>
                        <input type="datetime-local" class="form-control" id="meetingEndAt" name="end_at" required>
                    </div>

                    <div class="form-group">
                        <label for="meetingPrivate">Private</label>
                        <input type="checkbox" id="meetingPrivate" name="is_private">
                        <label for="meetingPrivate">Yes, it's private</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Meeting</button>
                </form>
            </div>
        </div>
    </div>
</div>


</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
