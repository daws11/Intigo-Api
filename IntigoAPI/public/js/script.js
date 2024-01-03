$(document).ready(function() {
    // Show Add Creator Modal
    window.showAddCreatorModal = function() {
        clearCreatorForm();
        $('#creatorModal').find('.modal-title').text('Add Creator');
        $('#creatorModal').modal('show');
    };

    // Show Edit Creator Modal
    window.showEditCreatorModal = function(id) {
        clearCreatorForm();
        fetchCreatorData(id);
    };

    // Show Add Meeting Modal
    window.showAddMeetingModal = function() {
        clearMeetingForm();
        $('#meetingModal').find('.modal-title').text('Add Meeting');
        $('#meetingModal').modal('show');
    };

    // Show Edit Meeting Modal
    window.showEditMeetingModal = function(id) {
        clearMeetingForm();
        fetchMeetingData(id);
    };

    // Creator Form Submission
    $('#creatorForm').on('submit', function(e) {
        e.preventDefault();
        submitCreatorForm();
    });

    // Meeting Form Submission
    $('#meetingForm').on('submit', function(e) {
        e.preventDefault();
        submitMeetingForm();
    });

    // Delete Creator
    window.deleteCreator = function(id) {
        deleteItem('/api/creators/' + id, 'creator');
    };

    // Delete Meeting
    window.deleteMeeting = function(id) {
        deleteItem('/api/meetings/' + id, 'meeting');
    };
});

function clearCreatorForm() {
    $('#creatorForm').trigger('reset');
    $('#creatorId').val('');
}

function clearMeetingForm() {
    $('#meetingForm').trigger('reset');
    $('#meetingId').val('');
}

function fetchCreatorData(id) {
    $.ajax({
        url: '/api/creators/' + id,
        method: 'GET',
        success: function(response) {
            populateCreatorForm(response);
            $('#creatorModal').find('.modal-title').text('Edit Creator');
            $('#creatorModal').modal('show');
        },
        error: function(xhr) {
            console.error('Error fetching creator data:', xhr.responseText);
        }
    });
}

function populateCreatorForm(data) {
    $('#creatorId').val(data.id);
    $('#creatorName').val(data.name);
    $('#creatorUserName').val(data.username);
    // Populate other fields as needed
}

function fetchMeetingData(id) {
    $.ajax({
        url: '/api/meetings/' + id,
        method: 'GET',
        success: function(response) {
            populateMeetingForm(response);
            $('#meetingModal').find('.modal-title').text('Edit Meeting');
            $('#meetingModal').modal('show');
        },
        error: function(xhr) {
            console.error('Error fetching meeting data:', xhr.responseText);
        }
    });
}

function populateMeetingForm(data) {
    $('#meetingId').val(data.id);
    $('#meetingTitle').val(data.title);
    // Populate other fields as needed
}

function submitCreatorForm() {
    var formData = new FormData($('#creatorForm')[0]);
    var id = $('#creatorId').val();
    var url = id ? '/api/creators/' + id : '/api/creators';
    var method = id ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        method: method,
        processData: false,
        contentType: false,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function(response) {
            $('#creatorModal').modal('hide');
            updateCreatorTable(response, id);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}

function submitMeetingForm() {
    var formData = new FormData($('#meetingForm')[0]);
    var id = $('#meetingId').val();
    var url = id ? '/api/meetings/' + id : '/api/meetings';
    var method = id ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        method: method,
        processData: false,
        contentType: false,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function(response) {
            $('#meetingModal').modal('hide');
            updateMeetingTable(response, id);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}

function deleteItem(url, type) {
    if (confirm('Are you sure you want to delete this ' + type + '?')) {
        $.ajax({
            url: url,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                removeItemFromTable(url, type);
            },
            error: function(xhr) {
                console.error('Error deleting ' + type + ':', xhr.responseText);
            }
        });
    }
}

function updateCreatorTable(data, id) {
    var table = $('#creatorsTable'); // Replace with your actual table ID
    if (id) {
        // Update the existing row
        var row = table.find('tr[data-creator-id="' + id + '"]');
        row.find('.name').text(data.name);
        row.find('.username').text(data.username)
        // Update other fields similarly
    } else {
        // Add a new row
        var newRow = '<tr data-creator-id="' + data.id + '">' +
                     '<td class="name">' + data.name + '</td>' +
                     '<td class="username">' + data.username + '</td>' +
                     // Add other cells
                     '</tr>';
        table.append(newRow);
    }
}

function updateMeetingTable(data, id) {
    var table = $('#meetingsTable'); // Replace with your actual table ID
    if (id) {
        // Update the existing row
        var row = table.find('tr[data-meeting-id="' + id + '"]');
        row.find('.title').text(data.title);
        // Update other fields similarly
    } else {
        // Add a new row
        var newRow = '<tr data-meeting-id="' + data.id + '">' +
                     '<td class="title">' + data.title + '</td>' +
                     // Add other cells
                     '</tr>';
        table.append(newRow);
    }
}

function removeItemFromTable(url, type) {
    var id = url.split('/').pop(); // Assuming the ID is the last part of the URL
    var table = (type === 'creator') ? $('#creatorsTable') : $('#meetingsTable');
    table.find('tr[data-' + type + '-id="' + id + '"]').remove();
}
