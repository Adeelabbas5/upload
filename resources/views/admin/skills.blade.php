@extends('admin.layouts.admin')

@section('content')
<div class="admin-container">
    <h2>Skills</h2>

    @if(session('success'))
        <div class="admin-alert success">{{ session('success') }}</div>
    @endif

    @foreach($skills as $skill)
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>Skill #{{ $skill->id }}</h3>
            <form action="{{ url('/admin/skills/' . $skill->id) }}" method="POST" onsubmit="return confirm('Delete this skill?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </div>

        <form action="{{ url('/admin/skills/' . $skill->id) }}" method="POST" class="admin-card-form">
            @csrf
            @method('PUT')
            <div class="field-row">
                <label>Name</label>
                <input type="text" name="name" value="{{ $skill->name }}" required>
            </div>
            <div class="field-row">
                <label>Percentage</label>
                <input type="number" name="percentage" value="{{ $skill->percentage }}" min="0" max="100" required>
            </div>
            <button type="submit" class="btn-save">Save</button>
        </form>
    </div>
    @endforeach

    <div class="admin-card admin-card-add">
        <h3>Add New Skill</h3>
        <form action="{{ url('/admin/skills') }}" method="POST" class="admin-card-form">
            @csrf
            <div class="field-row">
                <label>Name</label>
                <input type="text" name="name" placeholder="Skill name" required>
            </div>
            <div class="field-row">
                <label>Percentage</label>
                <input type="number" name="percentage" min="0" max="100" placeholder="90" required>
            </div>
            <button type="submit" class="btn-save">Add Skill</button>
        </form>
    </div>

    <a href="/" class="btn-back">Back to Site</a>
</div>
@endsection