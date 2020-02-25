<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Delete item</div>
            <div class="modal-body">Are you sure?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').on('click', function () {
            $('form#form_' + $(e.relatedTarget).data('id')).submit();
        });
    });
</script>