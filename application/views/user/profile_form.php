<h1>{form_title}</h1>
<div class="grid_12">
    <?php
    $form_error = $this->session->flashdata('form_error');
    if (!empty($form_error)) {
        foreach ($form_error as $error) {
            echo '<p class="form-error">';
            echo $error;
            echo '</p>';
        }
    }
    ?>

    <form class="normal-form" id="form-main" action="<?php echo $form_action ?>" method="post" autocomplete="off">
        <input type="hidden" name="form_data[UserID]" value="" />

        <p>
            <label for="username">ชื่อเข้าใช้</label><input type="text" id="Username" name="form_data[Username]" value="<?php echo $form_data['Username']; ?>" size="16" />
        </p>

        <p>
            <label for="FirstName">ชื่อ</label><input type="text" id="FirstName" name="form_data[FirstName]" value="<?php echo $form_data['FirstName']; ?>" />
        </p>
        <p>
            <label for="LastName">นามสกุล</label><input type="text" id="LastName" name="form_data[LastName]" value="<?php echo $form_data['LastName']; ?>" />
        </p>
        <p>
            <label for="StudentNumber">รหัสนักศึกษา</label><input type="text" id="StudentNumber" name="form_data[StudentNumber]" value="<?php echo $form_data['StudentNumber']; ?>" />
        </p>
        <input type="submit" value="บันทึก" />


    </form>
</div>

