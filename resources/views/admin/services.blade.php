@extends('admin.layouts.admin')

@section('content')
    <div class="admin-container">
        <h2>Services</h2>

        @if (session('success'))
            <div class="admin-alert success">{{ session('success') }}</div>
        @endif

        @foreach ($services as $service)
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3>Service #{{ $service->id }}</h3>
                    <form action="{{ url('/admin/services/' . $service->id) }}" method="POST"
                        onsubmit="return confirm('Delete this service?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>

                <form action="{{ url('/admin/services/' . $service->id) }}" method="POST" class="admin-card-form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="field-row">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $service->name }}" required>
                    </div>
                    <div class="field-row">
                        <label>Icon class</label>
                        <input type="text" name="icon" value="{{ $service->icon }}" required>
                    </div>
                    <div class="field-row">
                        <label>Description</label>
                        <textarea name="description" rows="3" required>{{ $service->description }}</textarea>
                    </div>
                    <div class="field-row">
                        <label>Details</label>
                        <textarea name="details" rows="4">{{ $service->details }}</textarea>
                    </div>
                    <div class="field-row">
                        <label>External link</label>
                        <input type="url" name="resource_link" value="{{ $service->resource_link }}"
                            placeholder="https://example.com/project-details">
                    </div>
                    <div class="field-row">
                        <label>Attach file (PDF / DOC / DOCX)</label>
                        <input type="file" name="resource_file" accept=".pdf,.doc,.docx">
                        @if ($service->resource_path)
                            <small>Current file: <a href="{{ asset($service->resource_path) }}"
                                    target="_blank">Download</a></small>
                        @endif
                    </div>
                    <div class="field-row">
                        <label>Gallery screenshots</label>
                        <div class="form-group mb-4">
                            <label>Upload Gallery Screenshots</label>
                            <input type="file" name="screenshots[]" class="form-control" multiple>
                            <small class="text-muted">You can select multiple images at once.</small>
                        </div>

                        @if ($service->screenshots)
                            <div class="current-screenshots mb-3 d-flex gap-2">
                                @foreach ($service->screenshots as $img)
                                    <img src="{{ asset($img) }}" width="80" class="img-thumbnail">
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn-save">Save</button>
                </form>

                <div class="works-section">
                    <h4>Works for this Service</h4>

                    @if ($service->works->count() > 0)
                        @foreach ($service->works as $work)
                            <div class="admin-card work-card">
                                <div class="admin-card-header">
                                    <h5>{{ $work->title }}</h5>
                                    <form action="{{ route('admin.services.works.destroy', ['serviceId' => $service->id, 'workId' => $work->id]) }}" method="POST"
                                        onsubmit="return confirm('Delete this work?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Delete</button>
                                    </form>
                                </div>

                                <form action="{{ route('admin.services.works.update', ['serviceId' => $service->id, 'workId' => $work->id]) }}" method="POST" class="admin-card-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="field-row">
                                        <label>Title</label>
                                        <input type="text" name="title" value="{{ $work->title }}" required>
                                    </div>
                                    <div class="field-row">
                                        <label>Description</label>
                                        <textarea name="description" rows="3">{{ $work->description }}</textarea>
                                    </div>
                                    <div class="field-row">
                                        <label>Link</label>
                                        <input type="url" name="link" value="{{ $work->link }}">
                                    </div>
                                    <div class="field-row">
                                        <label>Year</label>
                                        <input type="text" name="year" value="{{ $work->year }}">
                                    </div>
                                    <div class="field-row">
                                        <label>Screenshots</label>
                                        <input type="file" name="screenshots[]" accept="image/*" multiple>
                                        @if ($work->screenshots)
                                            <div class="current-screenshots mb-3 d-flex gap-2">
                                                @foreach ($work->screenshots as $img)
                                                    <img src="{{ asset($img) }}" width="80" class="img-thumbnail">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn-save">Update Work</button>
                                </form>
                            </div>
                        @endforeach
                    @endif

                    <div class="admin-card admin-card-add work-add">
                        <h5>Add New Work</h5>
                        <form action="{{ route('admin.services.works.store', $service->id) }}" method="POST" class="admin-card-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="field-row">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Work title" required>
                            </div>
                            <div class="field-row">
                                <label>Description</label>
                                <textarea name="description" rows="3" placeholder="Work description"></textarea>
                            </div>
                            <div class="field-row">
                                <label>Link</label>
                                <input type="url" name="link" placeholder="https://example.com/work">
                            </div>
                            <div class="field-row">
                                <label>Year</label>
                                <input type="text" name="year" placeholder="2023">
                            </div>
                            <div class="field-row">
                                <label>Screenshots</label>
                                <input type="file" name="screenshots[]" accept="image/*" multiple>
                            </div>
                            <button type="submit" class="btn-save">Add Work</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="admin-card admin-card-add">
            <h3>Add New Service</h3>
            <form action="{{ url('/admin/services') }}" method="POST" class="admin-card-form"
                enctype="multipart/form-data">
                @csrf
                <div class="field-row">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Service title" required>
                </div>
                <div class="field-row">
                    <label>Icon class</label>
                    <input type="text" name="icon" placeholder="fas fa-code" required>
                </div>
                <div class="field-row">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="Service description" required></textarea>
                </div>
                <div class="field-row">
                    <label>Details</label>
                    <textarea name="details" rows="4" placeholder="Full service details"></textarea>
                </div>
                <div class="field-row">
                    <label>External link</label>
                    <input type="url" name="resource_link" placeholder="https://example.com/project-details">
                </div>
                <div class="field-row">
                    <label>Attach file (PDF / DOC / DOCX)</label>
                    <input type="file" name="resource_file" accept=".pdf,.doc,.docx">
                </div>
                <div class="field-row">
                    <label>Gallery screenshots</label>
                    <input type="file" name="screenshots[]" accept="image/*" multiple>
                </div>
                <button type="submit" class="btn-save">Add Service</button>
            </form>
        </div>

        <a href="/" class="btn-back">Back to Site</a>
    </div>
@endsection
