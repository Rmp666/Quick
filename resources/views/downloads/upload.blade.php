<form class="d-none" id="formUpload">
    @csrf
    
    <script src="{{ asset('js/upload.js') }}"></script>
    
    <div class="card mt-2 card-container">
        
        <div class="card main-card">
            <div class="card-header">
                <input class="full label-file" type="text" class="card-control" placeholder="Enter filename" name="upload['1'][fileName]" >
            </div>

            <div class="card-body">
                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group" aria-label="First group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="upload['1'][file]" id="customFile" placeholder="Enter filename">
                            <label class="custom-file-label" for="customFile">
                                Choose file
                            </label>
                        </div>
                    </div>
                    <div class="input-group">
                        <button class="btn btn-light pull-right d-none" data-file="1" type="button" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                            Remove file
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer text-center" id="addMoreFilesDiv">
            <button class="btn btn-light mt-1" type="button" id="addMoreFiles" >
                Add more files
            </button>
        </div>
        
        <div class="card-footer">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <button class="btn btn-light" type="button" id="download">Publish</button>
                </div>
                <div class="input-group">
                    <button class="btn btn-light pull-right" id="notFile" type="button" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                        Don't upload files
                    </button>
                </div>
            </div>
        </div>
        
        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"></input>
    </div>
</form>


