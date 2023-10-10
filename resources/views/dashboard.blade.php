<!-- resources/views/merit.blade.php -->

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
                        <button type="button" onclick="searchStudent()" class="bg-blue-500 text-white p-2 rounded-md">Search</button>
                    </form>

                    <!-- Display Information -->
                    <div id="studentInfo" class="mt-4"></div>

                    <!-- Buttons for Normal Member and Committee Member -->
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('normal')" class="bg-green-500 text-white p-2 rounded-md">Normal Member (10 points)</button>
                        <button type="button" onclick="savePoints('committee')" class="bg-yellow-500 text-white p-2 rounded-md">Committee Member (15 points)</button>
                        <button type="button" onclick="removePoints()" class="bg-red-500 text-white p-2 rounded-md">Remove Points</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    function searchStudent() {
        const studentId = document.getElementById('studentId').value;

        // Make an AJAX request to fetch student information
        fetch(`/api/search-student?student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the #studentInfo div with the retrieved information
                    document.getElementById('studentInfo').innerHTML = `
                        <p><strong>Student ID:</strong> ${data.data.student_id}</p>
                        <p><strong>Student Name:</strong> ${data.data.student_name}</p>
                        <p><strong>Points:</strong> ${data.data.points}</p>
                    `;
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

    function removePoints() {
        const studentId = document.getElementById('studentId').value;

        // Make an AJAX request to remove points for the current student
        fetch(`/api/remove-points?student_id=${studentId}`)
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


</x-app-layout>
