<div class="page-heading">
    <h3>Add Proposal</h3>
    <hr>
</div>

<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">

            <section class="panel">

                <header class="panel-heading">
                    Add Proposal

                    <span class="mb-5 pull-right" style="margin-top:-6px;">
                        <a onclick="window.history.back();"
                           class="btn btn-danger btn-sm">

                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </span>
                </header>

                <div class="panel-body">

                    <form class="form-horizontal adminex-form"
                          id="form-proposal"
                          method="post"
                          enctype="multipart/form-data"
                          action="<?= base_url('super-admin/proposal/save_proposal') ?>">

                        <!-- CSRF -->
                        <input type="hidden"
                               name="<?= $this->security->get_csrf_token_name(); ?>"
                               value="<?= $this->security->get_csrf_hash(); ?>">

                        <!-- Proposal ID -->
                        <input type="hidden"
                               name="proposal_id"
                               value="<?= $result->id ?? 0; ?>">

                        <div class="col-md-12">

                            <!-- Document Name -->
                            <div class="form-group row">
                                <label class="control-label col-lg-3">
                                    Name of the document *
                                </label>

                                <div class="col-lg-9">
                                    <input type="text"
                                           name="title"
                                           class="form-control"
                                           value="<?= $result->title ?? ''; ?>"
                                           required>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group row">
                                <label class="control-label col-lg-3">
                                    Description of document *
                                </label>

                                <div class="col-lg-9">
                                    <textarea name="description"
                                              class="form-control"
                                              required><?= $result->description ?? ''; ?></textarea>
                                </div>
                            </div>

                            <!-- File Source -->
                            <div class="form-group row">
                                <label class="control-label col-lg-3">
                                    Document source *
                                </label>

                                <div class="col-lg-9">

                                    <label class="radio-inline mr-3">
                                        <input type="radio"
                                               name="file_source"
                                               value="upload"
                                               checked>

                                        Upload Files
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio"
                                               name="file_source"
                                               value="url">

                                        Document URLs
                                    </label>

                                </div>
                            </div>

                            <!-- FILE UPLOAD SECTION -->
                            <div class="form-group row file-upload-section">

                                <label class="control-label col-lg-3">
                                    Upload Files
                                </label>

                                <div class="col-lg-9">

                                    <div id="file-wrapper"
                                         class="file-upload-box">
                                    </div>

                                    <button type="button"
                                            id="add-file"
                                            class="btn btn-primary btn-sm mt-2">

                                        <i class="fa fa-plus"></i> Add File
                                    </button>

                                    <small class="text-muted d-block mt-2">
                                        Allowed: PDF, DOC, DOCX (Max 5MB each)
                                    </small>

                                </div>
                            </div>

                            <!-- URL SECTION -->
                            <div class="form-group row file-url-section"
                                 style="display:none;">

                                <label class="control-label col-lg-3">
                                    Document URLs
                                </label>

                                <div class="col-lg-9">

                                    <div id="url-wrapper"
                                         class="file-upload-box">
                                    </div>

                                    <button type="button"
                                            id="add-url"
                                            class="btn btn-info btn-sm mt-2">

                                        <i class="fa fa-plus"></i> Add URL
                                    </button>

                                    <small class="text-muted d-block mt-2">
                                        Add multiple document URLs
                                    </small>

                                </div>
                            </div>

                            <!-- PROPOSER DETAILS -->
                            <div class="page-heading row">
                                <h5>Details of Proposer</h5>
                                <hr>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">

                                <label class="control-label col-lg-3">
                                    Proposer's name *
                                </label>

                                <div class="col-lg-9">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="<?= $result->name ?? ''; ?>"
                                           required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">

                                <label class="control-label col-lg-3">
                                    Proposer's email *
                                </label>

                                <div class="col-lg-9">
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="<?= $result->email ?? ''; ?>"
                                           required>
                                </div>
                            </div>

                            <!-- Designation -->
                            <div class="form-group row">

                                <label class="control-label col-lg-3">
                                    Designation *
                                </label>

                                <div class="col-lg-9">
                                    <input type="text"
                                           name="designation"
                                           class="form-control"
                                           value="<?= $result->designation ?? ''; ?>"
                                           required>
                                </div>
                            </div>

                            <!-- Organisation -->
                            <div class="form-group row">

                                <label class="control-label col-lg-3">
                                    Organisation *
                                </label>

                                <div class="col-lg-9">
                                    <input type="text"
                                           name="organisation"
                                           class="form-control"
                                           value="<?= $result->organisation ?? ''; ?>"
                                           required>
                                </div>
                            </div>

                            <!-- BUTTONS -->
                            <div class="form-group row">

                                <div class="pull-right">

                                    <button class="btn btn-danger btn-sm"
                                            type="button"
                                            onclick="window.history.back();">

                                        <i class="fa fa-arrow-left"></i> Back
                                    </button>

                                    <button class="btn btn-success btn-sm"
                                            type="submit">

                                        Save changes
                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </section>

        </div>
    </div>
</div>

<style>
    .file-upload-box {
        border: 2px dashed #dcdcdc;
        padding: 15px;
        border-radius: 10px;
        background: #fafafa;
    }

    .file-row {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        padding: 8px 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .file-row input {
        flex: 1;
    }

    .file-name {
        font-size: 13px;
        color: #28a745;
    }

    .remove-file,
    .remove-url {
        border-radius: 50%;
        padding: 4px 8px;
    }
</style>

<script>
$(document).ready(function () {

    // Toggle sections
    function toggleFileSource(source) {

        if (source === 'url') {

            $('.file-upload-section').hide();
            $('.file-url-section').show();

            $('input[name="file_urls[]"]')
                .first()
                .prop('required', true);

            $('input[name="files[]"]')
                .prop('required', false);

        } else {

            $('.file-upload-section').show();
            $('.file-url-section').hide();

            $('input[name="file_urls[]"]')
                .prop('required', false);

            $('#file-wrapper input[type=file]')
                .first()
                .prop('required', true);
        }
    }

    // Change source
    $('input[name="file_source"]').change(function () {

        toggleFileSource($(this).val());
    });

    // ADD FILE
    $("#add-file").click(function () {

        let html = `
            <div class="file-row">

                <input type="file"
                       name="files[]"
                       class="form-control">

                <span class="file-name"></span>

                <button type="button"
                        class="btn btn-danger btn-sm remove-file">

                    <i class="fa fa-times"></i>
                </button>

            </div>
        `;

        $("#file-wrapper").append(html);

        toggleFileSource(
            $('input[name="file_source"]:checked').val()
        );
    });

    // REMOVE FILE
    $(document).on("click", ".remove-file", function () {

        $(this).closest(".file-row").remove();

        toggleFileSource(
            $('input[name="file_source"]:checked').val()
        );
    });

    // FILE VALIDATION
    $(document).on("change", "input[name='files[]']", function () {

        let file = this.files[0];

        if (file) {

            let size = file.size / 1024 / 1024;
            let ext = file.name.split('.').pop().toLowerCase();

            // Size check
            if (size > 5) {

                alert("Max file size is 5MB");

                $(this).val('');

                return;
            }

            // Extension check
            if (!['pdf', 'doc', 'docx'].includes(ext)) {

                alert("Only PDF, DOC, DOCX files allowed");

                $(this).val('');

                return;
            }

            $(this)
                .siblings(".file-name")
                .text(file.name);
        }
    });

    // ADD URL
    $("#add-url").click(function () {

        let html = `
            <div class="file-row">

                <input type="url"
                       name="file_urls[]"
                       class="form-control"
                       placeholder="https://example.com/document.pdf">

                <button type="button"
                        class="btn btn-danger btn-sm remove-url">

                    <i class="fa fa-times"></i>
                </button>

            </div>
        `;

        $("#url-wrapper").append(html);

        toggleFileSource(
            $('input[name="file_source"]:checked').val()
        );
    });

    // REMOVE URL
    $(document).on("click", ".remove-url", function () {

        $(this).closest(".file-row").remove();

        toggleFileSource(
            $('input[name="file_source"]:checked').val()
        );
    });

    // INITIALIZE
    toggleFileSource(
        $('input[name="file_source"]:checked').val()
    );

    // Add first rows automatically
    $("#add-file").trigger("click");
    $("#add-url").trigger("click");

});
</script>

<script src="<?= base_url('ajax/proposal.js') ?>"></script>