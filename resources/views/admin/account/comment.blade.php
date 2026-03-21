@if(count($comments) > 0 )
<h4 class="box-title exist-comment">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Existing Comments</h4>
<div class="form-group col-sm-12">
  <table class="account table table-bordered table-striped dataTable col-sm-12" class="">
    <thead>
      <tr>
        <th>Case ID</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($comments as $key=>$comment)
      <tr role="row" class="odd">
        <td>{{$comment['id']}}</td>
        <td>{{$comment['subject']}}</td>
        <td>{{$comment['comment']}}</td>
        <td>{{$comment['status']}}</td>
        <td>
          <button type="button" class="btn btn-sm btn-info view-comment"
            data-id="{{$comment['id']}}"
            data-subject="{{$comment['subject']}}"
            data-comment="{{$comment['comment']}}"
            data-status="{{$comment['status']}}"
            data-created="{{$comment['created_at'] ?? 'N/A'}}"
            data-updated="{{$comment['updated_at'] ?? 'N/A'}}"
            data-createdby="{{(!empty($comment['admin']['name']))?$comment['admin']['name']:'N/A'}}"
            onclick="openViewModal(this)">
            <i class="fa fa-eye"></i> View
          </button>
          @if(strtolower($comment['status']) !== 'closed')
          <button type="button" class="btn btn-sm btn-warning update-comment"
            data-id="{{$comment['id']}}"
            data-status="{{$comment['status']}}"
            onclick="openUpdateModal(this)">
            <i class="fa fa-edit"></i> Update Status
          </button>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewCommentModal" tabindex="-1" role="dialog" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewCommentModalLabel">View Comment Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label><strong>Case ID:</strong></label>
          <p id="view_comment_id"></p>
        </div>
        <div class="form-group">
          <label><strong>Subject:</strong></label>
          <p id="view_subject"></p>
        </div>
        <div class="form-group">
          <label><strong>Message:</strong></label>
          <p id="view_comment"></p>
        </div>
        <div class="form-group">
          <label><strong>Status:</strong></label>
          <p id="view_status"></p>
        </div>
        <div class="form-group">
          <label><strong>Created By:</strong></label>
          <p id="view_created_by"></p>
        </div>
        <div class="form-group">
          <label><strong>Created At:</strong></label>
          <p id="view_created"></p>
        </div>
        <div class="form-group">
          <label><strong>Updated At:</strong></label>
          <p id="view_updated"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateCommentModal" tabindex="-1" role="dialog" aria-labelledby="updateCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateCommentModalLabel">Update Comment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateCommentForm" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label><strong>Case ID:</strong></label>
            <p id="update_comment_id"></p>
          </div>
          <div class="form-group">
            <label for="update_status"><strong>Status:</strong></label>
            <select class="form-control" id="update_status" name="status" required>
              <option value="">Select Status</option>
              <option value="Open">Open</option>
              <option value="Pending">Pending</option>
              <option value="In Progress">In Progress</option>
              <option value="Closed">Closed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Status</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Status mapper - converts database values to display values
  const statusMapper = {
    'open': 'Open',
    'Open': 'Open',
    'pending': 'Pending',
    'Pending': 'Pending',
    'in_progress': 'In Progress',
    'In Progress': 'In Progress',
    'In_Progress': 'In Progress',
    'closed': 'Closed',
    'Closed': 'Closed'
  };

  // Reverse mapper - converts display values to database values
  const reverseStatusMapper = {
    'Open': 'open',
    'Pending': 'pending',
    'In Progress': 'in_progress',
    'Closed': 'closed'
  };

  function mapStatus(dbStatus) {
    return statusMapper[dbStatus] || dbStatus;
  }

  function openViewModal(button) {

    var id = button.getAttribute('data-id');
    var subject = button.getAttribute('data-subject');
    var comment = button.getAttribute('data-comment');
    var status = button.getAttribute('data-status');
    var created = button.getAttribute('data-created');
    var updated = button.getAttribute('data-updated');
    var createdBy = button.getAttribute('data-createdby');

    document.getElementById('view_comment_id').textContent = id;
    document.getElementById('view_subject').textContent = subject;
    document.getElementById('view_comment').textContent = comment;
    document.getElementById('view_status').textContent = status;
    document.getElementById('view_created_by').textContent = createdBy;
    document.getElementById('view_created').textContent = created;
    document.getElementById('view_updated').textContent = updated;

    // Try both jQuery and Bootstrap native
    if (typeof $ !== 'undefined') {
      $('#viewCommentModal').modal('show');
    } else if (typeof bootstrap !== 'undefined') {
      var modal = new bootstrap.Modal(document.getElementById('viewCommentModal'));
      modal.show();
    }
  }

  function openUpdateModal(button) {
    var id = button.getAttribute('data-id');
    var dbStatus = button.getAttribute('data-status');
    var mappedStatus = mapStatus(dbStatus);

    document.getElementById('update_comment_id').textContent = id;
    document.getElementById('update_status').value = mappedStatus;

    // Store the comment ID for form submission
    document.getElementById('updateCommentForm').dataset.commentId = id;

    // Try both jQuery and Bootstrap native
    try {
      if (typeof $ !== 'undefined') {
        $('#updateCommentModal').modal('show');
      } else if (typeof bootstrap !== 'undefined') {
        var modal = new bootstrap.Modal(document.getElementById('updateCommentModal'), {
          backdrop: 'static',
          keyboard: true
        });
        modal.show();
      } else {
        // Fallback: manually show modal
        var modalElement = document.getElementById('updateCommentModal');
        modalElement.style.display = 'block';
        modalElement.classList.add('show');
        document.body.classList.add('modal-open');
      }
    } catch (error) {
      console.error('Error opening modal:', error);
      alert('Error opening modal. Please try again.');
    }
  }

  // Handle form submission
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('updateCommentForm');
    if (form) {
      // Remove any existing listeners before adding
      var newForm = form.cloneNode(true);
      form.parentNode.replaceChild(newForm, form);
      form = newForm;

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        var commentId = this.dataset.commentId;
        var displayStatus = document.getElementById('update_status').value;
        var dbStatus = reverseStatusMapper[displayStatus] || displayStatus;

        if (!commentId || !displayStatus) {
          alert('Please fill all required fields');
          return;
        }

        // Send AJAX request to update status
        fetch('/admin/comments/' + commentId + '/updateCommentStatus', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
              status: dbStatus
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Status updated successfully!');
              // Close modal
              try {
                if (typeof $ !== 'undefined') {
                  $('#updateCommentModal').modal('hide');
                } else if (typeof bootstrap !== 'undefined') {
                  var modal = bootstrap.Modal.getInstance(document.getElementById('updateCommentModal'));
                  if (modal) {
                    modal.hide();
                  }
                } else {
                  document.getElementById('updateCommentModal').style.display = 'none';
                  document.getElementById('updateCommentModal').classList.remove('show');
                  document.body.classList.remove('modal-open');
                }
              } catch (err) {
                console.error('Error closing modal:', err);
              }
              // Reload page to see updated data
              setTimeout(function() {
                location.reload();
              }, 500);
            } else {
              alert('Error: ' + (data.message || 'Failed to update status'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status');
          });
      }, {
        once: false
      });
    }
  });
</script>

@else
{{-- <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} No Existing Comments</h4> --}}
@endif