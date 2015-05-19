function CekUserUnit(id_level)
{
    
    if ((id_level=="2")||(id_level=="4"))
    {
        document.getElementById('user_unit').disabled = false;
    }
    else
    {
        document.getElementById('user_unit').selectedIndex =0;
        document.getElementById('user_unit').disabled = true;
    }
    
}

function CekUserUnitX(id_level, data)
{
    if (id_level=="1")
    {
        $('#user_unit').disabled = false;
    }
    else if (id_level=='2')
    {
        $('#unit').hide().slideUp();
    }
}

// function load detail role
function LoadDetailRole(id_level, id_user)
{
    if (id_level!='')
    {
        $('#id_role_user').empty();
        $('#id_role_user').load('maincontent/main_content.php?m=load_detail_role&id_level='+id_level+'&id_user='+id_user);   
    }
}
// END function load detail role