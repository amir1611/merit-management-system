<div class="mb-4">
    <label for="programId" class="block text-sm font-medium text-gray-600">Select Program:</label>
    <select id="programId" name="program_id" class="mt-1 p-2 border rounded-md w-full">
        @foreach($programs as $program)
            <option value="{{ $program->id }}">{{ $program->program_name }}</option>
        @endforeach
    </select>
</div>
