
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
        <span class="pageTitle"><span class="icon-user-5"></span>Add User</span>
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
                <li>
                    <a href="<?php echo base_url(); ?>user/user" title="">Manage User</a>
                </li>
                <li class="current">
                    <a href="<?php echo base_url(); ?>user/user/add" title="">Add User</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Main content -->
    <div class="wrapper">
        
        <div class="fluid main-content">

            <?php if (isset($_SESSION['message']) && is_array($_SESSION['message'])) { ?>
            <?php foreach ($_SESSION['message'] as $key => $value) { ?>
            <div class="nNote <?php echo $value['type']; ?>">
                <p><?php echo $value['message']; ?></p>
            </div>
            <?php } ?>
            <?php unset($_SESSION['message']); ?>
            <?php } ?>

            <form id="usualValidate" class="main" method="post" action="<?php echo base_url(); ?>user/user_process/add">
                <fieldset>
                    <div class="widget">
                        <div class="whead"><h6>Add User Form</h6><div class="clear"></div></div>
                        <div class="formRow">
                            <div class="grid3"><label>Full Name:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" class="required" name="full_name" id="full_name" /></div><div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <div class="grid3"><label>Username:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" class="required" name="username" id="username" /></div><div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <div class="grid3"><label>password:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="password" class="required" name="password" id="password" /></div><div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <div class="grid3"><label>Email:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" class="required email" name="email" id="email" /></div><div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <div class="grid3"><label>Active:</label></div>
                            <div class="grid3 yes_no"><input type="checkbox" class="" name="status" id="status" /></div><div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <input type="submit" value="Submit" class="buttonM bBlack formSubmit" />
                            <input type="button" value="Back" class="buttonM bRed floatR marginR" onClick="location.href='<?php echo base_url(); ?>user/user';" />
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
    <!-- Main content ends -->
</div>