<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">   
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="mdi mdi-gauge"></i><span class="hide-menu"> Dashboard</span></a>                  
                </li>
                <li>
                    <a href="<?php echo base_url('main'); ?>"><i class="mdi mdi-comment-processing-outline"></i><span class="hide-menu"> ChatBot</span></a>                  
                </li>
                <li>
                    <a href="<?php echo base_url('training'); ?>"><i class="icon-graduation"></i><span class="hide-menu"> Training</span></a>                  
                </li>
                <li>
                    <a href="<?php echo base_url('broadcast'); ?>"><i class="fa fa-bullhorn"></i><span class="hide-menu"> Broadcast</span></a>                  
                </li>
                <li>
                    <a href="<?php echo base_url('uploads'); ?>"><i class="icon-cloud-upload"></i><span class="hide-menu"> Uploads</span></a>                  
                </li>
                <?php
                $role_id = $this->session->userdata('role_id');
                $group_menu = $this->accesscontrol->getGroupMenuByRole($role_id);
                if ($group_menu->num_rows() > 0) {
                    foreach ($group_menu->result_array() as $g) {
                        ?>
                        <li <?php echo ($g['group_menu_id'] == $group_id ? 'class="active"' : ''); ?>>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="<?php echo $g['group_menu_icon'] ?>"></i><span class="hide-menu"><?php echo $g['group_menu_name']; ?></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <?php
                                $menu = $this->accesscontrol->getMenuByGroup($g['group_menu_id'], $role_id);
                                if ($menu->num_rows() > 0) {
                                    foreach ($menu->result_array() as $m_m) {
                                        ?>
                                        <li <?php echo ($m_m['menu_id'] == $menu_id ? 'class="active"' : ''); ?>>
                                            <a <?php echo ($m_m['menu_id'] == $menu_id ? 'class="active"' : ''); ?> href="<?php echo ($m_m['menu_status_id'] == 3 ? 'javascript:void(0);' : ($m_m['menu_link'] != '#' ? $url = base_url() . $m_m['menu_link'] : '#')); ?>" <?php echo ($m_m['menu_openlink'] == 1 ? 'target="_blank"' : ''); ?> >
                                                <?php echo $m_m['menu_name']; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>    
            </ul>
        </nav>
    </div>
</aside>

<div class="page-wrapper">
    <div class="container-fluid">   
