<title>Success</title>
<?php
include_once ('first.php');
?>
<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="myModal" class="modal fade show" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title"><?php  echo $modal_title ?></h2>
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</a> -->
        </div>
        <div class="modal-body">
          <h5><?php echo $modal_body ?></h5>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          <?php
          // if session exists
          if((isset($_SESSION['doctor_id']) && !empty($_SESSION['doctor_id']))) {
            if(basename($_SERVER['PHP_SELF']) == "index.php") {
              echo '<a href = "#" onclick="window.history.go(-1); return false;"><button type="button" class="btn btn-default">Close</button></a>';
            } else if(strtok(basename($_SERVER['PHP_SELF']), '?') == "edit_details.php") {
              echo '<a href = "#" onclick="window.history.go(-1); return false;"><button type="button" class="btn btn-default">Close</button></a>';
            } else if(strtok(basename($_SERVER['PHP_SELF']), '?') == "new_patient.php") {
              if($go_to_another_page == 0) {
                echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
              } else {
                echo '<a href = "#" onclick="window.history.go(-1); return false;"><button type="button" class="btn btn-default">Close</button></a>';
              }
            }
            else {
              echo '<a href = "#" onclick="window.history.go(-1); return false;"><button type="button" class="btn btn-default">Close</button></a>';
            }
          } else {
            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
          }
          ?>
        </div>
      </div>

    </div>
  </div>


  <?php
  include_once ('loader_alljs.php');
  ?>


  <script type="text/javascript">
    $(window).on('load',function(){
      $('#myModal').modal('show');
    });
  </script>