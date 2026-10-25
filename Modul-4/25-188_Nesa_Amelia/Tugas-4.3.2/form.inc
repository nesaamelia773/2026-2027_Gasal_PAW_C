<h2>Register</h2>

<form action="processData_form.php" method="POST">
<fieldset>
<legend>Person Details</legend>
<table>
<tr>
    <td>Surname</td>
    <td><input type="text" name="surname"
value="<?php echo htmlspecialchars($_POST['surname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></td>
</tr>
<tr>
    <td>Email address</td>
    <td><input type="text" name="email"
value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></td>
</tr>
<tr>
    <td>Password</td>
    <td><input type="password" name="password"></td>
</tr>
<tr>
    <td>Street Address</td>
    <td><textarea name="address"><?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>></td>
</tr>
<tr>
    <td>State</td>
    <td>
        <select name="state">
            <option value="">Choose your state</option>
            <option value="NSW">New South Wales</option>
            <option value="VIC">Victoria</option>
            <option value="QLD">Queensland</option>
            <option value="WA">Western Australia</option>
            <option value="SA">South Australia</option>
            <option value="TAS">Tasmania</option>
            <option value="NT">Northern Territory</option>
            <option value="ACT">Australian Capital Territory</option>
        </select>
    </td>
</tr>
<tr>
    <td><input type="hidden" name="country" value="Australia"></td>
    <td>
        Gender:
        <input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="Female"> Female
    </td>
</tr>
<tr>
    <td>Vegetarian?</td>
    <td><input type="checkbox" name="vegetarian" value="Yes"></td>
</tr>
<tr>
    <td colspan="2" class="buttons">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </td>
</tr>
</table>
</fieldset>
</form>