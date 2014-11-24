
<title> ScumIT - Kanban </title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>


<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Kanban</small></h1>
        </div>
    </div><!-- /.row -->
</div>

<div id="card-container">
    <div id="inner-card-container">
        <?php 
            echo $backlogHtml;
            echo $inProgressHtml;
            echo $doneHtml;
        ?>
    </div>
</div>

<div id="card-container">
    <div id="inner-card-container">
        <?php 
            echo $backlogHtml;
            echo $inProgressHtml;
            echo $doneHtml;
        ?>
    </div>
</div>

<div class="modal fade" id="createCardModal" tabindex="-1" role="dialog" aria-labelledby="createCardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create-card">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="createBoardModalLabel">Create New Card</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name of Card</label>
                        <input class="form-control new-card-input" id="name" name="name" placeholder="Name of Card">
                    </div>

                    <div id="createCardErrorContainer" class="form-group error-container" style="display:none;margin-bottom:0px !important;">
                        <label id="createCardError"></label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="create-board-btn" data-role='create-card'>Create</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="inviteUserModal" tabindex="-1" role="dialog" aria-labelledby="inviteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="invite-user">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="createBoardModalLabel">Invite User to Board</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="detail-label">Name of User or Email (you can invite non-registered users too) </label>
                        <div id="invite-users-container" class="form-group">
                            <input type='hidden' id="invite-users-card" name="invite-users-card" style="width: 100%;" class="select2"  />
                        </div>
                    </div>

                    <div id="inviteUserMsgContainer" class="form-group" style="display:none;margin-bottom:0px !important;">
                        <label id="inviteUserMsg"></label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="invite-user-btn" data-role='invite-user'>Invite User</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="confirmDeleteCardModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteCardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-card">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="confirmDeleteCardModalLabel">Delete <label id="deleteCardName"></label></h4>
                    <input type="hidden" id="deleteCardData" />
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Are you sure you want to delete this card?</label>
                    </div>
                    <div class="form-group error-container">
                        <label id="deleteCardError"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete-card-btn">Delete</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="confirmDeleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-task">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="confirmDeleteTaskModalLabel">Delete <label id="deleteTaskName"></label></h4>
                    <input type="hidden" id="deleteTaskData" />
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Are you sure you want to delete this task?</label>
                    </div>
                    <div class="form-group error-container">
                        <label id="deleteTaskError"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#taskModal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete-task-btn" data-role="delete-task">Delete</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="settings-board">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Settings</h4>
                </div>
                <div class="modal-body settings-container">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" id="settingsBoardName" name="settingsBoardName" placeholder="Name of Board">
                    </div>

                    <div class="form-group">
                        <label>Board Users</label>
                        <div id="board-users-container" class="form-group">
                            <input type='hidden' id="boardUsers" name="boardUsers" style="width: 100%;" class="select2"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Admins</label>
                        <div id="admin-users-container" class="form-group">
                            <input type='hidden' id="adminUsers" name="adminUsers" style="width: 100%;" class="select2"  />
                        </div>
                    </div>

                    <div class="form-group private-settings">
                        <label>Is Private?</label>
                        <div class="form-group private-settings">
                            <input id="settingsBoardPrivate" name="settingsBoardPrivate" type="checkbox" value="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteBoardModal" tabindex="-1" role="dialog" aria-labelledby="deleteBoardModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-board">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteBoardModal">Delete <label id="deleteBoardName"></label></h4>
                    <input type="hidden" id="deleteBoardData" data-id="<?php echo '$boardId'; ?>" />
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Are you sure you want to delete this board?</label>
                    </div>
                    <div class="form-group error-container">
                        <label id="deleteBoardError"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete-board-btn">Delete</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModal" aria-hidden="true">
    <div class="modal-dialog">
        <span id="taskMetaData" data-taskId='' data-userId=''/>
        <div class="modal-content">
            <form id="modify-task-form">
                <div class="modal-header">
                    <div class="row">
                        <div class="task-title">
                            <h4 class="modal-title" id="taskNameLabelContainer" data-role="rename-task-name">
                                <label id="taskName"></label>
                            </h4>
                            <div id="renameTaskInputContainer" class="rename-task-input-container form-group">
                                <input type="text" class="rename-task-input popup-input" id="newTaskNameInput" placeholder="Task" data-role="rename-task-name-value">
                            </div>
                        </div>

                        <div class="btn-group pull-right" style="color: black">
                            <a href="javascript: void(0);" data-toggle="dropdown"><i class="fa fa-chevron-down fa-fw"></i></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#" data-toggle="modal" data-dismiss="modal" data-target="#confirmDeleteTaskModal">Delete Task</a></li>
                                <li class="divider"></li>
                                <li><a href="#" data-dismiss="modal">Close</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- turn this into requireJs.. -->
<script src="<?php echo base_url(); ?>js/libraries/require.js"></script>
<script src="<?php echo base_url(); ?>assets/app.js"></script>
<script type="text/javascript">
    require([
        '<?php echo $requirejs; ?>'
     ]);
</script>
<?php $this->load->view("template/footer_view");?>
