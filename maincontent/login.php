<?php
    
    // function login session check
    function LoginSessionCheck()
    {
        if( (!isset($_SESSION["LoginUser"])) & (!isset($_SESSION["UserLevel"])) )
        {
            FormLogin();
        }
        else if ( (isset($_SESSION["LoginUser"])) & (isset($_SESSION["UserLevel"])) )
        {
            DirectUser($_SESSION["UserLevel"]);
        }
        else
        {
            Logout();
        }
    }
    // END function login session check
    
    // function direct user
    function DirectUser($userLevel)
    {
        // level 1 = administrator
        // level 2 = user
        if($userLevel=="1")
        {
            $js= "parent.window.location = 'administrator/index.php?m=home'";
            exec_js($js);
        }
        else if($userLevel=="2")
        {
            $js= "parent.window.location = 'user/index.php?m=home'";
            exec_js($js);
        }
    }
    // END function direct user
    
    // function form login
    function FormLogin()
    {
        ?>
            <div id="loginlogo" style="text-align: center;">
                <img src="images/sokaindah_login.png" />
            </div>
            <div class="full_w">
                <form action="?m=CheckLogin" method="post" id="formID">
    				<label for="login">Username:</label>
    				<input id="login" name="username" placeholder="username" class="text validate[required] text-input" />
    				<label for="pass">Password:</label>
    				<input id="password" name="password" type="password" placeholder="*********" class="text validate[required] text-input" />
                    <label for="userlevel">User Level</label>
					<select id="userlevel" name="userlevel" class="text validate[required] text-input">
                        <option value="">--Pilih User Level--</option>
                        <?php 
                            
                            $sql = "SELECT * FROM tb_leveluser ORDER BY IdLevelUser ASC";
                            $dataLevelUser = ReadDataManyRow($sql);
                            foreach($dataLevelUser as $data)
                            {
                                ?>
                                    <option value="<?php echo $data['IdLevelUser']; ?>"><?php echo $data['LevelUser']; ?></option>
                                <?php
                            }
                            
                        ?>
                    </select>
                    <div class="sep"></div>
                    <div style="text-align: right;">
					   <button type="submit" class="btn_black">Login</button>
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
    // END 
    
    // function logout
    function Logout()
    {
        session_start();
        session_destroy();
        $js = "parent.window.location = 'index.php'";
        exec_js($js);
    }
    // END function logout
    
    // function CheckLogin
    function CheckLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userlevel = $_POST['userlevel'];
        
        $sql = "SELECT Username, NamaLengkap, IdLevelUser FROM tb_user WHERE Username='$username' AND PASSWORD ='".md5($password)."' AND IdLevelUser='$userlevel' AND IsActive='1'";
        $cnn = new koneksi();
        $cnn->select($sql);
        if (($cnn->status=="1") & ($cnn->qty>0))
        {
            $data = $cnn->baris[0];
            
            $_SESSION["LoginUser"] = $username;
            $_SESSION["UserLevel"] = $userlevel;
            $_SESSION["NamaLengkap"] = $data["NamaLengkap"];
            DirectUser($userlevel);
        }
        else
        {
            $js = "parent.window.location = 'index.php?err=1'";
            exec_js($js);
        }
    }
?>