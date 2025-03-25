@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Assign Complaint</h2>

    <form action="{{ route('admin.assign_complaint', $complaint->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="support_id" class="block font-medium text-gray-700">Select Support Staff</label>
            <select name="support_id" id="support_id" class="w-full border-gray-300 rounded-lg">
                <option value="">-- Select Support --</option>
                @foreach($supportStaff as $support)
                    <option value="{{ $support->id }}" {{ $complaint->support_id == $support->id ? 'selected' : '' }}>
                        {{ $support->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Assign Complaint
        </button>
    </form>
</div>

@endsection
