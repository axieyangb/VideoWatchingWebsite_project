function logoutHP()
{      
setcookie('isHome',1,time()+3600);
/*logout();
window.history.back(-1);
*/
}
	
function login()
{
window.open ('login.php', 'newwindow', 'height=100, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no') 
}
function register()
{
window.open ('Register.php', 'newwindow', 'height=600, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no') 
}
function logout()
{
window.open ('logout.php','','resizable=0,scrollbars=0,status=no,toolbar=no,location=no,menu=no,titlebar=no,height=1,width=1,left=-1000px,top=-1000px');
}
// JavaScript Document