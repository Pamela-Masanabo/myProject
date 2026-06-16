<h2>Register Staff</h2>

<form action="{{ route('staff.store') }}" method="POST">

@csrf

<input type="text" name="first_name" placeholder="First Name" required>

<br><br>
<input type="text" name="last_name" placeholder="Last Name" required>

<br><br>
<input type="text" name="employee_id" placeholder="Employee ID" required>

<br><br>
<input type="text" name="username" placeholder="Username" required>

<br><br>
<input type="text" name="phone" placeholder="Phone">

<br><br>
<input type="email" name="email" placeholder="Email" required>

<br><br>

<div class="grid">

    <div>
        <label>Role</label>

        <select id="role" name="role" required>

            <option value="">Select Role</option>

            <option value="ADMIN">Admin</option>

            <option value="RECEPTIONIST">Receptionist</option>

            <option value="STAFF_NURSE">Staff Nurse</option>

            <option value="PROFESSIONAL_NURSE">Professional Nurse</option>

            <option value="DOCTOR">Doctor</option>

        </select>
    </div>

</div>


<div id="specialtyContainer" style="display:none;">

    <label>Specialty</label>

    <select id="specialty" name="specialty">

        <option value="">Select Specialty</option>

    </select>

</div>

<br><br>

<input type="password" name="password" placeholder="Password" required>

<br><br>

<button type="submit">

Create Staff

</button>

</form>

<!-- Java Script to dynamically show/hide specialty options based on selected role -->
<script>

const role = document.getElementById('role');

const specialty = document.getElementById('specialty');

const specialtyContainer =
document.getElementById('specialtyContainer');

role.addEventListener('change', function() {

    specialty.innerHTML = '';

    specialtyContainer.style.display = 'none';


    if(this.value === 'STAFF_NURSE') {

        specialtyContainer.style.display = 'block';

        specialty.innerHTML = `

            <option value="GENERAL">General</option>

            <option value="PEDIATRIC">Pediatric</option>

        `;
    }


    else if(this.value === 'PROFESSIONAL_NURSE') {

        specialtyContainer.style.display = 'block';

        specialty.innerHTML = `

            <option value="GENERAL">General</option>

            <option value="PEDIATRIC">Pediatric</option>

            <option value="MATERNITY">Maternity</option>

            <option value="CHRONIC">Chronic</option>

        `;
    }

});

</script>