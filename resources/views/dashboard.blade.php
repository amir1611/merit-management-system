<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PEKA MERIT MANAGEMENT SYSTEM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Search Form -->
                    <form id="searchForm">
                        <div class="mb-4">
                            <label for="studentId" class="block text-sm font-medium text-gray-600">Student ID:</label>
                            <input type="text" id="studentId" name="student_id" class="mt-1 p-2 border rounded-md w-full">
                        </div>

                        <button type="button" onclick="searchStudent()" class="bg-black-500 text-white p-2 rounded-md" style="background-color: blue">Search</button>
                    </form>

                    <!-- Display Information -->
                    <div id="studentInfo" class="mt-4">
                        <p><strong>ID:</strong> <span id="studentIdValue"></span></p>
                        <p><strong>Name:</strong> <span id="studentNameValue"></span></p>
                        <p><strong>College:</strong> <span id="collegecodeValue"></span></p>
                        <p><strong>Hostel:</strong> <span id="hostelcodeValue"></span></p>
                        <p><strong>Dorm:</strong> <span id="dormcodeValue"></span></p>
                        <br>
                        <p><strong>Total Points:</strong> <span id="pointsValue"></span></p>
                    </div>

                    <!-- Buttons for Award and Remove Points -->
                    <hr class="mt-4">
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('attendance')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: black;">Attendance (10 points)</button>
                        <button type="button" onclick="removePoints('attendance')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: red;">Remove Attendance (10 points)</button>
                    </div>
                    <hr class="mt-4">
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('committee')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: black;">Committee Member (20 points)</button>
                        <button type="button" onclick="removePoints('committee')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: red;">Remove Committee Member (20 points)</button>
                    </div>
                    <hr class="mt-4">
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('university_level')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: black;">University Level (30 points)</button>
                        <button type="button" onclick="removePoints('university_level')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: red;">Remove University Level (30 points)</button>
                    </div>
                    <hr class="mt-4">
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('national_level')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: black;">National Level (40 points)</button>
                        <button type="button" onclick="removePoints('national_level')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: red;">Remove National Level (40 points)</button>
                    </div>
                    <hr class="mt-4">
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('international_level')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: black;">International Level (50 points)</button>
                        <button type="button" onclick="removePoints('international_level')" class="bg-red-500 text-white p-2 rounded-md" style="background-color: red;">Remove International Level (50 points)</button>
                    </div>
                    <hr class="mt-4">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function searchStudent() {
        const studentId = document.getElementById('studentId').value;

        // Make an AJAX request to fetch student information
        fetch(`/api/search-student?student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('studentIdValue').innerText = data.data.student_id;
                    document.getElementById('studentNameValue').innerText = data.data.student_name;
                    document.getElementById('collegecodeValue').innerText = data.data.college_code;
                    document.getElementById('hostelcodeValue').innerText = data.data.hostel_code;
                    document.getElementById('dormcodeValue').innerText = data.data.dorm_code;
                    document.getElementById('pointsValue').innerText = data.data.points;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function savePoints(pointsType) {
        const studentId = document.getElementById('studentId').value;

        // Make an AJAX request to save points for the selected pointsType
        fetch(`/api/save-points?student_id=${studentId}&points_type=${pointsType}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Optionally, update the displayed points in #studentInfo
                    searchStudent();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function removePoints(pointsType) {
        const studentId = document.getElementById('studentId').value;

        // Make an AJAX request to remove points for the selected pointsType
        fetch(`/api/remove-points?student_id=${studentId}&points_type=${pointsType}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Optionally, update the displayed points in #studentInfo
                    searchStudent();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
