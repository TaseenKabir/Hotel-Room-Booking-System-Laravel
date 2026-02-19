<div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="exampleModalLabel">Edit Room </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('room-type.update')}}" method="POST" id="room_type_update_form" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row justify-content-center">

                        <!-- Left Column -->
                         <div class="mb-3">
                            <input type="hidden" name="id">
                        </div>
                        <div class="col-md-6">
                            <div class="text-center mb-3">
                                <img id="editPreviewImage"
                                    src=""
                                    style="width:130px; height:130px; object-fit:cover; border-radius:6px; display:none;">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input name="image" class="form-control" type="file" id="editImageInput">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                                <span class="text-danger error-text name_error"></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="floatingTextarea2" style="height: 100px"></textarea>
                                <span class="text-danger error-text description_error"></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control">
                                <span class="text-danger error-text price_error"></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" name="max_capacity" class="form-control">
                                <span class="text-danger error-text price_error"></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-success">Save Changes</button>
                </div>

            </form>


        </div>
    </div>
</div>