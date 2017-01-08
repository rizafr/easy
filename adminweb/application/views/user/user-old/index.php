
    <!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">
            
            <!-- Tabs container -->
            <div id="tab-container" class="tab-container">
                <ul class="iconsLine ic1 etabs">
                    <li><a href="#general" title=""><span class=""></span></a></li>
                </ul>

                <div id="general">
                    <ul class="subNav">
                        <li><a href="<?php echo base_url(); ?>user/user" title="" class="this"><span class="icos-list"></span>Manage User</a></li>
                        <li><a href="<?php echo base_url(); ?>user/user/password" title="" class=""><span class="icos-list"></span>Change Password</a></li>
                    </ul>
                </div>
                             
                <div class="divider"><span></span></div>
                          
            </div>
            
       </div> 
       <div class="clear"></div>
   </div>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-grid-view"></span>Manage User</span>
        <div class="clear">
        </div>
    </div>
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li>
                    <a href="<?php echo base_url(); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>user/user">User</a>
                </li>
                <li class="current">
                    <a href="<?php echo base_url(); ?>user/user" title="">Manage User</a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>user/user/add" title="">Add User</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- Main content -->
    <div class="wrapper main-content">

        <?php if (isset($_SESSION['message']) && is_array($_SESSION['message'])) { ?>
        <?php foreach ($_SESSION['message'] as $key => $value) { ?>
        <div class="nNote <?php echo $value['type']; ?>">
            <p><?php echo $value['message']; ?></p>
        </div>
        <?php } ?>
        <?php unset($_SESSION['message']); ?>
        <?php } ?>

        <ul class="middleNavR">
            <li>
                <a href="<?php echo base_url(); ?>user/user/add" title="Add User" class="tipN">
                <img src="<?php echo base_url(); ?>assets/images/icons/middlenav/add.png" alt="" />
                </a>
            </li>
        </ul>
        
        <!-- Table with opened toolbar -->
        <div class="widget">
            <div class="whead">
                <h6>User List</h6>
                <div class="clear">
                </div>
            </div>
            <div id="user-list" class="dynamic shownpars">
                <a class="tOptions act" title="Options">
                    <img src="<?php echo base_url(); ?>assets/images/icons/options.png" alt="" />
                </a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable">
                    <thead>
                        <tr>
                            <th width="20"><div>No<span></span></div></th>
                            <th width="140"><div>Full Name<span></span></div></th>
                            <th width="100"><div>Username<span></span></div></th>
                            <th width="120"><div>Email<span></span></div></th>
                            <th width="120"><div>Date Created<span></span></div></th>
                            <th width="40"><div>Status<span></span></div></th>
                            <th width="60">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="item-list">
                        <?php if(isset($user) && ! empty($user)) { ?>
                        <?php $i = 1; ?>
                        <?php foreach ($user as $key => $value) { ?>
                        <tr id="item-<?php echo $value->user_id; ?>">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value->full_name; ?></td>
                            <td><?php echo $value->username; ?></td>
                            <td><?php echo $value->email; ?></td>
                            <td><?php echo $value->created_date; ?></td>
                            <td><?php echo $value->status ? 'active' : 'inactive'; ?></td>
                            <td class="tableActs">
                                <a href="<?php echo base_url(); ?>user/user/edit/<?php echo $value->user_id; ?>" class="tablectrl_small bDefault tipS" title="Edit"><span class="iconb" data-icon="&#xe1db;"></span></a>
                                <a href="#" class="tablectrl_small bDefault tipS deleteAct" title="Remove" data-message="Delete User <strong><?php echo $value->username; ?> (<em><?php echo $value->full_name; ?></em>) </strong>?" data-action="<?php echo base_url(); ?>user/user_process/delete/<?php echo $value->user_id; ?>" data-id="<?php echo $value->user_id; ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id="delete-dialog-modal" title="Delete User Confirmation">
                <p>Delete User?</p>
            </div>
            <div class="clear">
            </div>
        </div>
        
    </div>
    <!-- Main content ends -->
</div>