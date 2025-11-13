<!-- Modal -->
<div class="modal fade" id="sharemodal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-2" id="shareModalLabel">Share</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4> Share this link via </h4>
                <div class="p-2 d-flex justify-content-center" id="share_modal_body">
                </div>

                <h4 class="mt-3"> Or copy link </h4>

                <div class="input-group mb-3">
                    <div class="input-group-text"><i class="bi bi-link-45deg"
                            style="font-size:1.0rem; color: rgb(14, 88, 224);"></i>
                    </div>
                    <input type="text" class="form-control" id="share_modal_value" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <a class="btn btn-primary" href="javascript:void(0)" onclick="copy_link()"
                            data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
                            data-bs-content="Copied">Copy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
