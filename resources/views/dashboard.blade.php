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
                            <input type="text" id="studentId" name="student_id"
                                class="mt-1 p-2 border rounded-md w-full">
                        </div>

                        <!-- Programs Dropdown -->
                        {{-- <div class="mb-4">
                            <label for="programId" class="block text-sm font-medium text-gray-600">Select
                                Program:</label>
                            <select id="programId" name="program_id" class="mt-1 p-2 border rounded-md w-full">
                                <!-- Add default option -->
                                <option value="" disabled selected>Select Program</option> --}}

                                {{-- <!-- Add options for Football and Badminton -->
        <option value="football">Football</option>
        <option value="badminton">Badminton</option> --}}

                                {{-- @php
                                    $programs = \App\Models\Program::all();
                                @endphp
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @endforeach

                            </select>
                        </div> --}}







                        <button type="button" onclick="searchStudent()" class="bg-black-500 text-white p-2 rounded-md"
                            style="background-color: blue">Search</button>
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

                        <!-- Display Programs and Points -->
                        {{-- <div id="studentPrograms" class="mt-4"></div> --}}
                    </div>

                    <!-- Buttons for Normal Member and Committee Member -->
                    <div class="mt-4">
                        <button type="button" onclick="savePoints('normal')"
                            class="bg-red-500 text-white p-2 rounded-md" style="background-color: black;">Normal Member
                            (10 points)</button>
                        <button type="button" onclick="savePoints('committee')"
                            class="bg-red-500 text-white p-2 rounded-md" style="background-color: rgb(64, 0, 255);">Committee
                            Member (15 points)</button>
                        <button type="button" onclick="removePoints()" class="bg-red-500 text-white p-2 rounded-md"
                            style="background-color: red;">Remove Points</button>
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
                             // Update basic information
                document.getElementById('studentIdValue').innerText = data.data.student_id;
                document.getElementById('studentNameValue').innerText = data.data.student_name;
                document.getElementById('collegecodeValue').innerText = data.data.college_code;
                document.getElementById('hostelcodeValue').innerText = data.data.hostel_code;
                document.getElementById('dormcodeValue').innerText = data.data.dorm_code;
                document.getElementById('pointsValue').innerText = data.data.points;

                        // Update the #studentPrograms div with program information
                        // displayStudentPrograms(data.data.programs);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // function displayStudentPrograms(programs) {
        //     const studentProgramsDiv = document.getElementById('studentPrograms');
        //     studentProgramsDiv.innerHTML = ''; // Clear previous content

        //     if (programs.length > 0) {
        //         const programsList = document.createElement('ul');
        //         programs.forEach(program => {
        //             const listItem = document.createElement('li');
        //             listItem.innerText =
        //             `${program.program_name}: ${program.pivot.points} points`; // Adjusted this line
        //             programsList.appendChild(listItem);
        //         });
        //         studentProgramsDiv.appendChild(programsList);
        //     } else {
        //         studentProgramsDiv.innerText = 'This student has not joined any programs.';
        //     }
        // }



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
