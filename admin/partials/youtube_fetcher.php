<?php
$yf_list_setting_arr = get_option( 'yf_list_setting' );
?>
<div class="col-md-12">
  <nav class="navbar navbar-info bg-info">
    <a class="navbar-brand text-white" href="#"><img class="pr-3" src="<?php echo plugin_dir_url( __FILE__ ) ?>../img/iconfinder_youtube.png" />Youtube Fetcher</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="row">
    <div class="col-md-6">
      <div class="shadow-sm mt-5">
        <div class="card-header bg-info text-light">
          <b>Youtube Set Api</b>
        </div>
        <div class="card-body shadow">
          <div class="form-group">
            <label>Api Key</label>
            <input type="text" class="form-control" id="api_key" placeholder="Api key" value="<?php echo $yf_list_setting_arr['api_key']; ?>">
          </div>
          <button class="btn btn-info btn-sm youtube_list_save">Save api </button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="shadow-sm mt-5">
        <div class="card-header bg-info text-light">
          <b>Set Video List Shortcode</b>
        </div>
        <div class="card-body shadow">
          <div class="form-group">
            <label>Channel Id</label>
            <input type="text" class="form-control" id="channel_id" placeholder="Channel Id">
          </div>
          <div class="form-group">
            <label>Max Results</label>
            <input type="text" class="form-control" id="max_result" placeholder="Max Results">
          </div>
          <button class="btn btn-info btn-sm set_shortcode">Set Shortcode</button>
        </div>
      </div>
    </div>
  </div>
</div>