<?php
    
    // function view user
    function ViewUser()
    {
        // header title
        $text = "View User";
        HeaderTitle($text);
        
        // shortcut menu for user
        UserShortcutMenu();
        
        // user table
        ViewUserTable();
    }
    // END function view user
    
    // function view user table
    function ViewUserTable()
    {
        $sql = "SELECT a.Username, a.NamaLengkap, b.LevelUser, a.IsActive
                	FROM tb_user a
                	INNER JOIN tb_leveluser b ON a.IdLevelUser = b.IdLevelUser
                ORDER BY a.IsActive DESC, a.Username;
                ";
        
        ?>
            <div class="datagrid" style="margin: 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="width: 150px; text-align: center;">Nama Lengkap</th>
    				        <th style="width: 80px; text-align: center;">Username</th>
                            <th style="width: 60px; text-align: center;">Level</th>
                            <th style="width: 50px; text-align: center;">Status</th>
                            <th style="width: 30px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $dataUser = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataUser as $data)
                            {
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                        <td><?php echo $data["NamaLengkap"]; ?></td>
                                        <td style="text-align: center;"><?php echo $data["Username"]; ?></td>
                                        <td style="text-align: center;"><?php echo $data["LevelUser"]; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                                if($data["IsActive"]=="1")
                                                {
                                                    echo "<label style='color: #0ACB22;'>Active</label>";
                                                }
                                                else
                                                {
                                                    echo "<label style='color: #BB1109;'>Non Active</label>";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="?m=user&a=EditUser&Username=<?php echo $data["Username"]; ?>" class="table-icon edit" title="Edit User" style="margin-right: 10px;"></a>
                                            <?php 
                                                if($data["IsActive"]=="1")
                                                {
                                                    if($data["Username"]==$_SESSION['LoginUser'])
                                                    {
                                                        $IsUsername = "1";
                                                    }
                                                    else
                                                    {
                                                        $IsUsername = "0";
                                                    }
                                                    ?>
                                                        <a href="#" class="table-icon delete" title="Set User Nonactive" onclick="SetUserNonactive('<?php echo $data['Username']; ?>', '<?php echo $data['NamaLengkap']; ?>', '<?php echo $IsUsername; ?>')" style="margin-right: 10px;"></a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                        <a href="#" class="table-icon activate" title="Set User Active" onclick="SetUserActive('<?php echo $data['Username']; ?>', '<?php echo $data['NamaLengkap']; ?>')" style="margin-right: 10px;"></a>
                                                    <?php
                                                }
                                            ?>
                                            <a href="#" class="table-icon archive" title="Detail" onclick="DetailUser('<?php echo $data["Username"]; ?>')"></a>
                                        </td>
                                    </tr>
                                <?php
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
    // END function view user tale
    
    // =============== function menu user ===================
    function UserShortcutMenu()
    {
        ?>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <div style="text-align: center; display: table;" id="div">
                    <div id="div" style="display: table-cell;">
                        <button class="add" style="margin-right: 15px;" onclick="window.location.href='?m=user&a=NewUser'">Add New User</button> <button class="new_user" onclick="window.location.href='?m=user&a=ViewUser'">View User</button>
                    </div>
                    <div style="display: table-cell; padding-left: 50px;">
                        <form style="margin: 0px; display: table;" method="GET" action="index.php?m=user&a=view_user" id="formID2">
                            <input type="hidden" name="m" value="user" />
                            <input type="hidden" name="a" value="view_user" />
                            <b style="font-size: 14;">Search</b> <input type="text" name="search" id="search" class="text validate[required]" style="width: 180px; margin-left: 15px; margin-right: 10px;" /> <button class="search" type="submit" style="width: 90px;">Find</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
    // =============== END function menu user ================ 
    
    //========= FUNCTION NEW USER ==================
    function NewUser()
    {
        $text = "Tambah User Baru";
        HeaderTitle($text);
        UserShortcutMenu();
        NewUserForm();
    }
    //========= END FUNCTION NEW USER ==============
    
    //function add new user form
    function NewUserForm()
    {
        ?>
            <div style="padding: 0px 10px 20px 10px;">
                <div class="full_w">
                    <?php 
                        // mengecek apakah username sudah ada atau tidak
                        if (isset($_GET['e']))
                        {
                            ?>
                                <div class="n_warning">
                                    <p>Maaf Username Tidak Tersedia</p>
                                </div>
                            <?php
                        }
                    ?>
                    <form id="formID" method="post" action="?m=user&a=SaveUser">
                        <div class="element">
    						<label for="name">Username<span class="red">*</span></label>
    						<input id="username" name="username" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Password<span class="red">*</span></label>
    						<input id="password" name="password" type="password" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Repeat Password<span class="red">*</span></label>
    						<input id="rpassword" name="rpassword" type="password" class="text validate[required,equals[password]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Nama Lengkap<span class="red">*</span></label>
    						<input id="nama_lengkap" name="nama_lengkap" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Jenis Kelamin<span class="red">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="text validate[required]" style="width: 310px;">
                                <option value="">-</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
    					</div>
                        <div class="element">
    						<label for="name">Alamat</label>
    						<input id="alamat" name="alamat" class="text text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Telepon/Handphone</label>
    						<input id="telepon" name="telepon" class="text validate[custom[integer], required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="level_user">Level User<span class="red">*</span></label>
                            <select id="level_user" name="level_user" class="text validate[required]" style="width: 310px;">
                                <option value="">-</option>
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=user&a=ViewUser'">Cancel</button><button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END funciton new user form
    
    // function save user
    function SaveUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $namaLengkap = $_POST['nama_lengkap'];
        $jenisKelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $userLevel = $_POST['level_user'];
        
        //check available user
        if( CheckAvailableUser($username) )
        {
            $sqlSaveUser = "INSERT INTO tb_user (Username, Password, NamaLengkap, JenisKelamin, Alamat, NoHandphone, IdLevelUser) VALUE 
                            ('$username', '".md5($password)."', '$namaLengkap', '$jenisKelamin', '$alamat', '$telepon', '$userLevel');";
            
            if (ExecuteQuery($sqlSaveUser))
            {
                $js = "parent.window.location ='?m=user'";
                exec_js($js);
            }
        }
        else
        {
            $js = "parent.window.location = '?m=user&a=NewUser&e=NotAvailable'";
            exec_js($js);
        }
    }
    // END function save user
    
    // function cek available user
    function CheckAvailableUser($username)
    {
        $sql = "SELECT username FROM tb_user WHERE username='$username'";
        $cnn = new koneksi();
        $cnn->select($sql);
        if ($cnn->qty>0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    // END function cek available user
    
    
    // function set user nonaktiv
    function SetUserNonactive()
    {
        $Username = $_GET["Username"];
        
        $sql = "UPDATE tb_user SET IsActive = '0' WHERE Username='$Username'";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=user'";
            exec_js($js);
        }
    }
    // END
    
    // function set user active
    function SetUserActive()
    {
        $Username = $_GET["Username"];
        
        $sql = "UPDATE tb_user SET IsActive = '1' WHERE Username='$Username'";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=user'";
            exec_js($js);
        }
    }
    // END
    
    // function edit user
    function EditUser()
    {
        $text = "Edit User";
        HeaderTitle($text);
        UserShortcutMenu();
        EditUserForm();
    }
    // END function edit user
    
    // function edit user form
    function EditUserForm()
    {
        $Username = $_GET["Username"];
        $sql = "SELECT Username, NamaLengkap, JenisKelamin, 
                Alamat, NoHandphone, IdLevelUser, IsActive FROM tb_user 
                WHERE Username='$Username'";
        $data = ReadDataOneRow($sql);
        
        ?>
            <div style="padding: 0px 10px 20px 10px;">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=user&a=UpdateUser">
                        <input type="hidden" id="username" name="username" value="<?php echo $data["Username"]; ?>" />
                        <div class="element">
    						<label for="name">Username<span class="red">*</span></label>
    						<input class="text validate[required]" style="width: 300px;" value="<?php echo $data["Username"]; ?>" disabled="disabled" />
    					</div>
                        <div class="element">
    						<label for="name">Nama Lengkap<span class="red">*</span></label>
    						<input id="nama_lengkap" name="nama_lengkap" class="text validate[required]" style="width: 300px;" value="<?php echo $data["NamaLengkap"]; ?>" />
    					</div>
                        <div class="element">
    						<label for="name">Jenis Kelamin<span class="red">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="text validate[required]" style="width: 310px;">
                                <?php 
                                    if($data["JenisKelamin"]=="Laki-laki")
                                    {
                                        ?>
                                            <option value="Laki-laki" selected="selected">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan" selected="selected">Perempuan</option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="element">
    						<label for="name">Alamat</label>
    						<input id="alamat" name="alamat" class="text text validate[required]" style="width: 300px;" value="<?php echo $data["Alamat"]; ?>" />
    					</div>
                        <div class="element">
    						<label for="name">Telepon/Handphone</label>
    						<input id="telepon" name="telepon" class="text validate[custom[integer], required]" style="width: 300px;" value="<?php echo $data["NoHandphone"]; ?>" />
    					</div>
                        <div class="element">
    						<label for="level_user">Level User<span class="red">*</span></label>
                            <select id="level_user" name="level_user" class="text validate[required]" style="width: 310px;">
                                <?php
                                    if($data["IdLevelUser"]=="1")
                                    {
                                        ?>
                                            <option value="1" selected="">Administrator</option>
                                            <option value="2">User</option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value="1">Administrator</option>
                                            <option value="2" selected="selected">User</option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="entry">
						      <a href="?m=user&a=ViewUser" class="btn_black" style="text-decoration: none; margin-right: 20px;">Cancel</a>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END function edit user form
    
    // update user
    function UpdateUser()
    {
        $username = $_POST['username'];
        $namaLengkap = $_POST['nama_lengkap'];
        $jenisKelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $userLevel = $_POST['level_user'];
        
        $sql = "UPDATE tb_user SET 
                        NamaLengkap='$namaLengkap', 
                        JenisKelamin='$jenisKelamin', 
                        Alamat='$alamat', 
                        NoHandphone='$telepon', 
                        IdLevelUser='$userLevel' 
                WHERE Username='$username'";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=user'";
            exec_js($js);
        }
    }
    // END update user
    
    // function detail user
    function DetailUser()
    {
        include "../../globalfunction/ajax_include.php";
        $Username = $_GET['Username'];
        $sql = "SELECT Username, NamaLengkap, JenisKelamin, 
                Alamat, NoHandphone, IdLevelUser, IsActive FROM tb_user 
                WHERE Username='$Username'";
        $data = ReadDataOneRow($sql);
        ?>
            <div style="border: 1px solid #C5C5C5; padding: 10px; color: #1B1B1B; font-size: 13px;">
                <table>
                    <tr>
                        <td style="width: 100px;">Username</td>
                        <td style="width: 10px;">:</td>
                        <td><?php echo $data["Username"]; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $data["NamaLengkap"]; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data["Alamat"]; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo $data["JenisKelamin"]; ?></td>
                    </tr>
                    <tr>
                        <td>Level User</td>
                        <td>:</td>
                        <td>
                            <?php 
                                if($data["IdLevelUser"]=="1")
                                {
                                    echo "Administrator";
                                }
                                else
                                {
                                    echo "User";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <?php 
                                if($data["IsActive"]=="1")
                                {
                                    echo "<label style='color: #0ACB22;'>Active</label>";
                                }
                                else
                                {
                                    echo "<label style='color: #BB1109;'>Non Active</label>";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }
    // END function detail user
    
    // function reset user
    function ResetPassword()
    {
        HeaderTitle("Reset User Password");
        $Username = $_GET['Username'];
        $sql = "SELECT Username, NamaLengkap, JenisKelamin, 
                Alamat, NoHandphone, IdLevelUser, IsActive FROM tb_user 
                WHERE Username='$Username'";
        $data = ReadDataOneRow($sql);
        ?>
            <div class="full_w detailreservasi" style="margin: 10px; padding: 5px;">
                <table class="tbclear">
                    <tr>
                        <td style="width: 120px;">Username</td>
                        <td style="width: 15px;">:</td>
                        <td><?php echo $data["Username"]; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $data["NamaLengkap"]; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data["Alamat"]; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo $data["JenisKelamin"]; ?></td>
                    </tr>
                    <tr>
                        <td>Level User</td>
                        <td>:</td>
                        <td>
                            <?php 
                                if($data["IdLevelUser"]=="1")
                                {
                                    echo "Administrator";
                                }
                                else
                                {
                                    echo "User";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <?php 
                                if($data["IsActive"]=="1")
                                {
                                    echo "<label style='color: #0ACB22;'>Active</label>";
                                }
                                else
                                {
                                    echo "<label style='color: #BB1109;'>Non Active</label>";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="full_w" style="margin: 10px;">
                <form id="formID" method="post" action="?m=user&a=UpdateUserPassword">
                    <input type="hidden" name="Username" value="<?php echo $Username; ?>" />
                    <div class="element">
				        <label for="name">New Password<span class="red">*</span></label>
  						<input id="password" name="password" type="password" class="text validate[required]" style="width: 300px;" />
   					</div>
                    <div class="element">
  						<label for="name">Repeat Password<span class="red">*</span></label>
  						<input id="rpassword" name="rpassword" type="password" class="text validate[required,equals[password]]" style="width: 300px;" />
   					</div>
                    <div class="entry">
                        <a href="?m=user" class="btn_black" style="text-decoration: none; margin-right: 20px;">Cancel</a>
                        <button type="submit" class="btn_blue">Reset</button>
                    </div>
                </form>
            </div>
        <?php  
    }
    // END function reset user
    
    // function update user password
    function UpdateUserPassword()
    {
        $Username= $_POST["Username"];
        $Password = $_POST["password"];
        
        $sql = "UPDATE tb_user SET Password = '".md5($Password)."' WHERE Username='$Username'";
        
        
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=user'";
            exec_js($js);
        }
    }
    // END function update user password
?>