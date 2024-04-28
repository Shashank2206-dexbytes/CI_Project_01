<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome TO OUR PORTAL</h1>
    <?php 
        if($this->session->userdata('UserLoginSession'))
        {
            
            $udata = $this->session->userdata('UserLoginSession');
            echo 'Welcome'.' '.$udata['username'];
        }
        else
        {
            redirect(base_url('welcome/login'));
        }
    ?>
</body>
</html>