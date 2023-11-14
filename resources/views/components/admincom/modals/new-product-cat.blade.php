<!-- Modal -->
<div>
    <div class="modal fade" id="newProductCat" tabindex="-1" aria-labelledby="newProductCatlabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('admin.productcategories.store')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newProductCat">Add a new product category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="File">
                            <label class="custom-file-label" for="File">Choose file</label>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" name="desc" id="desc" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
