<h1>{form_title}</h1>
<div class="grid_12">
    
    <form class="normal-form" id="form-main" action="<?php echo $form_action ?>" method="post" autocomplete="off">
        <input type="hidden" name="form_data[UserID]" value="" />
        
            <p>
                <label for="username">ชื่อเข้าใช้งาน</label><input type="text" id="Username" name="form_data[Username]" value="" size="16" />
            </p>
            <p>
                <label for="password">รหัสผ่าน</label><input type="password" id="Password" name="form_data[Password]" value="" size="16" />
            </p>

            <input type="submit" value="ลงชื่อเข้าใช้งาน" />


    </form>
</div>

