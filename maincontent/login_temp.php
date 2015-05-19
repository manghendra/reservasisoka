<?php
	
/*
    == FORM UNTUK LOGIN == 
*/
    function Login_Form_x()
    {
        ?>
            <div id="loginlogo">
                <center>
                    <img src="images/logosanglah_login.png" />
                </center>
            </div>
			<div class="full_w">
				<form action="maincontent/main_content.php?m=cek_login" method="post" id="formID">
					<label for="login">Username:</label>
					<input id="login" name="username" placeholder="username" class="text validate[required] text-input" />
					<label for="pass">Password:</label>
					<input id="password" name="password" type="password" placeholder="*********" class="text validate[required] text-input" />
                    <label for="pass">Login As</label>
                    <select id="userlevel" name="userlevel" class="text validate[required] text-input">
                        <option value="">-</option>
                        <?php 
                            $sql = "SELECT * FROM tb_level_user";
                            $data_level = ReadDataManyRow($sql);
                            if ($data_level)
                            {
                                foreach($data_level as $data)
                                {
                                    echo "<option value='$data[id_level]'>$data[user_level]</option>";
                                }
                            }
                        ?>
                    </select>
					<div class="sep"></div>
                    <div style="text-align: center;">
					   <button type="submit" class="btn_black">Login</button> <a class="btn_red" href="" style="color: white; text-decoration: none;">Forgotten password?</a>
				    </div>
                </form>
			</div>
            <?php 
                if (isset($_GET['err']))
                {
                    ?>
                        <div class="n_error">
                            <p>Login Anda Salah!!</p>
                        </div>
                    <?php
                }
            ?>
        <?php
        
        
    }
/*
    == END FORM UNTUK LOGIN == 
*/
    function Login_Form()
    {
        ?>
            <div id="loginlogo">
                <center>
                    <img src="images/logosanglah_login.png" />
                </center>
            </div>
			<div class="full_w">
				<form action="?m=cek_login" method="post" id="formID">
					<label for="login">Username:</label>
					<input id="login" name="username" placeholder="username" class="text validate[required] text-input" />
					<label for="pass">Password:</label>
					<input id="password" name="password" type="password" placeholder="*********" class="text validate[required] text-input" />
					<div class="sep"></div>
                    <div style="text-align: center;">
					   <button type="submit" class="btn_black">Login</button> <a class="btn_red" href="" style="color: white; text-decoration: none;">Forgotten password?</a>
				    </div>
                </form>
			</div>
            <?php 
                if (isset($_GET['err']))
                {
                    ?>
                        <div class="n_error">
                            <?php 
                                $err = $_GET['err'];
                                if ($err=="inactive")
                                {
                                    $text = "Login anda tidak aktif, mohon kontak administrator!";
                                }
                                else
                                {
                                    $text = "Login anda salah";
                                }
                            ?>
                            <p><?php echo $text; ?></p>
                        </div>
                    <?php
                }
            ?>
        <?php
        
        
    }
/*
    == FORM UNTUK LOGIN == 
*/
    
/*
    == END FORM UNTUK LOGIN == 
*/

/*
    == SESSION CEK ==
    -> function untuk mengecek session user 
*/
    function Login_Session_Cek()
    {
        if ((!isset($_SESSION['login_user'])) & (!isset($_SESSION['user_level'])))
        {
            Login_Form();
        }
        else if ((isset($_SESSION['login_user'])) & (isset($_SESSION['user_level'])))
        {
            Login_Direct_User($_SESSION['login_user'], $_SESSION['user_level'], "1");
        }
    }
/*
    == END SESSION CEK ==
*/

/*
    == DIRECT USER ==
    -> function untuk mendirect ke area kerjanya 
*/
    function Login_Direct_User($username, $userlevel, $is_login)
    {
        /*
            is_login = 1 -> sudah login
            is_login = 0 -> belum login
        */
        if ($is_login=="1")
        {
            switch($userlevel) 
            {
                case '1' :
                    $js= "parent.window.location = 'administrator/index.php'";
                    exec_js($js);
                break;
                
                case '2' :
                    $js = "parent.window.location = 'user/index.php'";
                    exec_js($js);
                break;
                
                case '3' :
                    $js = "parent.window.location = 'invenstaff/index.php'";
                    exec_js($js);
                break;
            }
        }
        else
        {
            switch($userlevel) 
            {
                case '1' :
                    $js= "parent.window.location = '../administrator/index.php'";
                    exec_js($js);
                break;
                
                case '2' :
                    $js = "parent.window.location = '../user/index.php'";
                    exec_js($js);
                break;
                
                case '3' :
                    $js = "parent.window.location = '../invenstaff/index.php'";
                    exec_js($js);
                break;
            }
        }
    }
/*
    == END DIRECT USER ==
*/


/*
    == LOGIN CEK ==
    -> function untuk mengecek login user 
*/
    function Login_Cek()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // query untuk mengecek user
        $sql = "SELECT id_user, username, is_active FROM tb_user WHERE username='$username' AND password='".md5($password)."'";
        $cnn = new koneksi();
        $cnn->select($sql);
        if (($cnn->status=="1") & ($cnn->qty>0))
        {
            $data = $cnn->baris[0];
            
            if ($data['is_active']=="1")
            {
                $_SESSION['login_user'] = $data['username'];
                $_SESSION['id_user'] = $data['id_user'];
                $js = "parent.window.location = 'index.php?m=change_role'";
                exec_js($js); 
            }
            else
            {
                $js = "parent.window.location = 'index.php?err=inactive'";
                exec_js($js);   
            }
        }
        else
        {
            $js = "parent.window.location = 'index.php?err=1'";
            exec_js($js);
        }
        // membuat koneksi
    }
/*
    == END LOGIN CEK ==
*/

/*
    == LOGOUT ==
    -> function untuk logout user
*/
    function Logout()
    {
        session_start();
        session_destroy();
        /*
        if (isset($_GET['p']))
        {
            $js= "parent.window.location = 'index.php'";
        }
        else
        {
            $js= "parent.window.location = '../index.php'";   
        }
        */
        $js= "parent.window.location = 'index.php'";
        exec_js($js);
    }
/*
    == END LOGOUT ==
*/


/*
    == CEK LEVEL ==
    -> function untuk logout user
*/
    function FormCekLevel($id_user)
    {
        
        $sql_level_user = "SELECT a.id_level_user, c.user_level
                            	FROM tb_detail_lvl_user a 
                            	INNER JOIN tb_user b ON a.id_user=b.id_user
                            	INNER JOIN tb_level_user c ON a.id_level_user=c.id_level
                            WHERE a.id_user='$id_user' ORDER BY a.id_level_user ASC";
        
        $cnn = new koneksi();
        
        $data_level_user = ReadDataManyRow($sql_level_user);
        
        ?>
            <div id="loginlogo">
                <center>
                    <img src="images/logosanglah_login.png" />
                </center>
            </div>
			<div class="full_w">
				<form action="?m=direct_user" method="post" id="formID">
                    <label for="user_level">User Level</label>
					<select id="user_level" name="user_level" class="text validate[required] text-input" onchange="LoadDetailRole($('#user_level').val(), '<?php echo $id_user; ?>')">
                        <option value="">--Pilih User Level--</option>
                        <?php 
                            foreach($data_level_user as $data)
                            {
                                ?>
                                    <option value="<?php echo $data['id_level_user']; ?>"><?php echo $data['user_level']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <div id="id_role_user">
                    </div>
                    <label for="lokasi">Lokasi</label>
                    <select id="user_location" name="user_location" class="text validate[required] text-input">
                        <option value="sanglah">Rumah Sakit Sanglah</option>
                        <option value="">--Pilih Lokasi--</option>
                    </select>
					<div class="sep"></div>
                    <div style="text-align: center;">
					   <a class="btn_black" href="?m=logout&p=ori" style="color: white; text-decoration: none;">Cancel</a> <button type="submit" class="btn_blue" style="margin-left: 20px;">Login</button>
				    </div>
                </form>
			</div>
        <?php
    }
/*
    == END CEK LEVEL==
*/

/*
    == DIRECT USER ==
    -> function untuk logout user
*/
    function Login_Direct()
    {
        $user_level = $_POST['user_level'];
        $_SESSION['user_level'] = $user_level;
        switch($user_level)
        {
            case '1' :
                $_SESSION['user_bidang'] = false;
                $_SESSION['user_direksi'] = false;
                $_SESSION['user_unit'] = false;
            break;
            
            case '2' :
                if (isset($_POST['user_unit']))
                {
                    $user_unit = $_POST['user_unit'];
                    $_SESSION['user_unit'] = $user_unit;
                    
                    // empty other session
                    $_SESSION['user_bidang'] = false;
                    $_SESSION['user_direksi'] = false;
                }
            break;
            
            case '3' :
                $_SESSION['user_bidang'] = false;
                $_SESSION['user_direksi'] = false;
                $_SESSION['user_unit'] = false;
            break;
            
            case '4' :
                if (isset($_POST['user_unit']))
                {
                    $user_unit = $_POST['user_unit'];
                    $_SESSION['user_unit'] = $user_unit;
                    
                    // empty other session
                    $_SESSION['user_bidang'] = false;
                    $_SESSION['user_direksi'] = false;
                }
            break;
            
            case '5' :
                if (isset($_POST['user_bidang']))
                {
                    $user_bidang = $_POST['user_bidang'];
                    $_SESSION['user_bidang'] = $user_bidang;
                    
                    // empty other session
                    $_SESSION['user_unit'] = false;
                    $_SESSION['user_direksi'] = false;
                }
            break;
            
            case '6' :
                if (isset($_POST['user_direksi']))
                {
                    $user_direksi = $_POST['user_direksi'];
                    $_SESSION['user_direksi'] = $user_direksi;
                    
                    $_SESSION['user_unit'] = false;
                    $_SESSION['user_bidang'] = false;
                }
            break;
            
            case '7' :
                $_SESSION['user_bidang'] = false;
                $_SESSION['user_direksi'] = false;
                $_SESSION['user_unit'] = false;
            break;
            
            case '8' :
                $_SESSION['user_bidang'] = false;
                $_SESSION['user_direksi'] = false;
                $_SESSION['user_unit'] = false;
            break;
        }
        $root_folder = GetRootLocation($user_level);
        $js= "parent.window.location = '".$root_folder."'";
        exec_js($js);
    }

/*
    == END DIRECT USER==
*/


    function ChangeRole()
    {
        if (isset($_SESSION['login_user']) & (isset($_SESSION['id_user'])))
        {
            $id_user = $_SESSION['id_user'];
            FormCekLevel($id_user);
        }
        else
        {
            $js= "parent.window.location = 'index.php'";
            exec_js($js);
        }
    }
    
    function GetRootLocation($id_level_user)
    {
        $sql = "SELECT root_folder FROM tb_level_user WHERE id_level='$id_level_user'";
        $data = ReadDataOneRow($sql);
        return $data['root_folder'];
    }
    
    // function load level role
    function LoadDetailRole($id_level, $id_user)
    {
        include "../globalfunction/ajax_include.php";
        switch($id_level)
        {
            case '1' :
                // blank don't load anything
            break;
            
            case '2' :
                LoadDetailRole_Unit($id_level, $id_user);
            break;
            
            case '3' :
                // blank don't load anything'
            break;
            
            case '4' :
                LoadDetailRole_KaUnit($id_level, $id_user);
            break;
            
            case '5' :
                LoadDetailRole_KaBidang($id_level, $id_user);
            break;
            
            case '6' :
                LoadDetailRole_Direksi($id_level, $id_user);
            break;
        }
    }
    // END function load level role
    
    // function load detail unit
    function LoadDetailRole_Unit($id_level, $id_user)
    {
        $sql_unit_user = "SELECT a.id_unit, c.nama_unit
                        	FROM tb_detail_unit_user a 
                        	INNER JOIN tb_user b ON a.id_user=b.id_user
                        	INNER JOIN tb_unit c ON a.id_unit=c.id_unit
                        WHERE a.id_user='$id_user' ORDER BY a.id_detail_unit_user ASC 
                        ";
        
        $data_unit_user = ReadDataManyRow($sql_unit_user);
        
        ?>
            <label for="user_unit">Unit/Divisi</label>
            <select id="user_unit" name="user_unit" class="text validate[required] text-input">
                <option value="">--Pilih User Unit--</option>
                <?php 
                    foreach($data_unit_user as $data)
                    {
                        ?>
                            <option value="<?php echo $data['id_unit']; ?>"><?php echo $data['nama_unit']; ?></option>
                        <?php
                    }
                ?>
            </select>
        <?php
    }
    // END function load detail unit
    
    
    // function load detail kepala unit
    function LoadDetailRole_KaUnit($id_level, $id_user)
    {
        $sql_unit_user = "SELECT a.id_unit, c.nama_unit
                        	FROM tb_detail_kaunit_user a 
                        	INNER JOIN tb_user b ON a.id_user=b.id_user
                        	INNER JOIN tb_unit c ON a.id_unit=c.id_unit
                        WHERE a.id_user='$id_user' ORDER BY a.id_detail_kaunit_user ASC 
                        ";
        
        $data_unit_user = ReadDataManyRow($sql_unit_user);
        
        ?>
            <label for="user_unit">Unit/Divisi</label>
            <select id="user_unit" name="user_unit" class="text validate[required] text-input">
                <option value="">--Pilih User Unit--</option>
                <?php 
                    foreach($data_unit_user as $data)
                    {
                        ?>
                            <option value="<?php echo $data['id_unit']; ?>"><?php echo $data['nama_unit']; ?></option>
                        <?php
                    }
                ?>
            </select>
        <?php
    }
    // END function load detail kepala unit
    
    // function load detail kepala unit
    function LoadDetailRole_KaBidang($id_level, $id_user)
    {
        $sql_bidang_user = "SELECT a.id_bagian, b.nama_bagian
                            	FROM tb_detail_kabid_user a 
                            	INNER JOIN tb_str_bagian b ON a.id_bagian=b.id_bagian
                            WHERE a.id_user='$id_user' ORDER BY a.id_detail_kabid_user ASC";
        
        $data_bidang_user = ReadDataManyRow($sql_bidang_user);
        
        ?>
            <label for="user_unit">Bidang/Bagian</label>
            <select id="user_bidang" name="user_bidang" class="text validate[required] text-input">
                <option value="">--Pilih Bidang/Bagian--</option>
                <?php 
                    foreach($data_bidang_user as $data)
                    {
                        ?>
                            <option value="<?php echo $data['id_bagian']; ?>"><?php echo $data['nama_bagian']; ?></option>
                        <?php
                    }
                ?>
            </select>
        <?php
    }
    // END function load detail kepala unit
    
    
    // function load detail direksi
    function LoadDetailRole_Direksi($id_level, $id_user)
    {
        $sql_direksi_user = "SELECT a.id_direktorat, b.nama_direktorat
                            	FROM tb_detail_direksi_user a 
                            	INNER JOIN tb_str_direktorat b ON a.id_direktorat=b.id_direktorat
                            WHERE a.id_user='$id_user' ORDER BY a.id_detail_kabid_user ASC";
        
        $data_direksi_user = ReadDataManyRow($sql_direksi_user);
        
        ?>
            <label for="user_unit">Direksi</label>
            <select id="user_direksi" name="user_direksi" class="text validate[required] text-input">
                <option value="">--Pilih Direksi--</option>
                <?php 
                    foreach($data_direksi_user as $data)
                    {
                        ?>
                            <option value="<?php echo $data['id_direktorat']; ?>"><?php echo $data['nama_direktorat']; ?></option>
                        <?php
                    }
                ?>
            </select>
        <?php
    }
    // END function load detail direksi
    
?>