<?php
$yf_list_setting_arr = get_option( 'yf_list_setting' );
?>
<div class="col-md-12">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Youtube Fetcher</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="row">
    <div class="col-md-4">
      <div class="mt-5 card">
        <div class="card-header bg-info text-light">
          <b>Youtube listting setting</b>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Channel Id</label>
            <input type="text" class="form-control" id="channel_id" placeholder="Channel Id" value="<?php echo $yf_list_setting_arr['channel_id']; ?>">
          </div>
          <div class="form-group">
            <label>Max Results</label>
            <input type="text" class="form-control" id="max_result" placeholder="Max Results" value="<?php echo $yf_list_setting_arr['max_result']; ?>">
          </div>
          <div class="form-group">
            <label>Api Key</label>
            <input type="text" class="form-control" id="api_key" placeholder="Api key" value="<?php echo $yf_list_setting_arr['api_key']; ?>">
          </div>
          <button class="btn btn-info btn-sm youtube_list_save">Submit</button>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="mt-5 card">
        <div class="card-header">
          Youtube Live Setting
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Channel Id</label>
            <input type="text" class="form-control" placeholder="Channel Id">
          </div>
          <div class="form-group">
            <label>Max Results</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Max Results">
          </div>
          <div class="form-group">
            <label>Api Key</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Api key">
          </div>
          <button class="btn btn-info btn-sm">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>