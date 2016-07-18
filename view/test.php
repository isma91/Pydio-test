<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="A tool to test your Pydio or a new one" />
    <title>Welcome to Pydio-test !!</title>
    <?php include "media.html" ?>
    <script src="media/js/test.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel">
            <h1 class="title">Welcome to Pydio-test !!</h1>
            <h2 class="title">You selected the Workspace <span id="workspace_name"></span> !!</h2>
        </div>
        <div class="row end_button">
            <button class="waves-effect btn-flat" id="logout">Logout</button>
        </div>
        <div class="row">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header"><span class="left"><i class='material-icons'>insert_drive_file</i> Create file</span></div>
                  <div class="collapsible-body">
                  <p><button class="waves-effect btn-flat" id="create_file_button"><i class='material-icons right'>send</i>Test The API</button></p>
                  <div class="row mui-panel" id="create_file_div"></div>
                  </div>
              </li>
              <li>
                  <div class="collapsible-header"><span class="left"><i class='material-icons'>create_new_folder</i> Create folder</span></div>
                  <div class="collapsible-body">
                  <p><button class="waves-effect btn-flat" id="create_folder_button"><i class='material-icons right'>send</i>Test The API</button></p>
                  <div class="row mui-panel" id="create_folder_div"></div>
                  </div>
              </li>
              <li>
                  <div class="collapsible-header"><span class="left"><i class='material-icons'>cached</i> Rename file</span></div>
                  <div class="collapsible-body">
                  <p><button class="waves-effect btn-flat" id="rename_file_button"><i class='material-icons right'>send</i>Test The API</button></p>
                  <div class="row mui-panel" id="rename_file_div"></div>
                  </div>
              </li>
              <li>
                  <div class="collapsible-header"><span class="left"><i class='material-icons'>content_copy</i> Copy file</span></div>
                  <div class="collapsible-body">
                  <p><button class="waves-effect btn-flat" id="copy_file_button"><i class='material-icons right'>send</i>Test The API</button></p>
                  <div class="row mui-panel" id="copy_file_div"></div>
                  </div>
              </li>
              <li>
                  <div class="collapsible-header"><span class="left"><i class='material-icons'>delete</i> Delete file</span></div>
                  <div class="collapsible-body">
                  <p><button class="waves-effect btn-flat" id="delete_file_button"><i class='material-icons right'>send</i>Test The API</button></p>
                  <div class="row mui-panel" id="delete_file_div"></div>
                  </div>
              </li>
              <li>
                  <div class="collapsible-header"><span class="left"><i class='material-icons'>near_me</i> Move file</span></div>
                  <div class="collapsible-body">
                  <p><button class="waves-effect btn-flat" id="move_file_button"><i class='material-icons right'>send</i>Test The API</button></p>
                  <div class="row mui-panel" id="move_file_div"></div>
                  </div>
              </li>
          </ul>
      </div>
  </div>
</body>
</html>